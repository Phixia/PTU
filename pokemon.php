<?php require_once 'classes/loader.php';

$required_css = array('pokemon');
$required_js = array('pokemon');
require_once 'inc/header.php';
	if(isset($_POST['random']) && is_numeric($_POST['number']) && $_POST['number'] > 0 && $_POST['number'] <= 20 && is_numeric($_POST['level_from']) && is_numeric($_POST['level_to'])) {
		$from = 'pokemon, pokemon_evolutions';
		$where = 'pokemon.id = pokemon_evolutions.pokemon_id AND pokemon.id = pokemon_evolutions.evolution AND pokemon_evolutions.level <= '.mysqli_real_escape_string($db->connection, $_POST['level_to']);
		if(!isset($_POST['legendary'])) {
			$where .= " AND pokemon.number NOT LIKE 'L%'";
		}
		if(!isset($_POST['all_habitats']) && isset($_POST['habitat'])) {
			$from .= ', pokemon_habitats';
			$where .= ' AND pokemon.id = pokemon_habitats.pokemon_id AND pokemon_habitats.habitat_id IN (';
			foreach($_POST['habitat'] as $i => $habitat_id) {
				if($i > 0)
					$where .= ',';
				$where .= mysqli_real_escape_string($db->connection, $habitat_id);
			}
			$where .= ')';
			//$pokemon_data = $db->select('DISTINCT(pokemon_id) AS id', 'pokemon_habitats', NULL, array('habitat_id' => $_POST['habitat']));
		}
		if(!isset($_POST['all_types']) && isset($_POST['type'])) {
			$types = '';
			foreach($_POST['type'] as $i => $type) {
				if($i > 0)
					$types .= ',';
				$types .= "'".mysqli_real_escape_string($db->connection, $type)."'";
			}
			if(isset($_POST['search_type']) && $_POST['search_type'] == 'exclusive')
				$where .= " AND ((pokemon.type1 IN (".$types.") AND pokemon.type2 IS NULL) OR (pokemon.type1 IN (".$types.") AND pokemon.type2 IN (".$types.")))";
			elseif(isset($_POST['search_type']) && $_POST['search_type'] == 'inclusive')
				$where .= " AND (pokemon.type1 IN (".$types.") OR pokemon.type2 IN (".$types."))";
		}
		if(!isset($_POST['all_generations']) && isset($_POST['generation'])) {
			$generations = '';
			foreach($_POST['generation'] as $i => $generation) {
				if($i > 0)
					$generations .= ',';
				$generations .= mysqli_real_escape_string($db->connection, $generation);
			}
			$where .= " AND pokemon.generation IN (".$generations.")";
		}
		if($_POST['stage'] != '') {
			if($_POST['stage'] <= 3)
				$where .= ' AND pokemon.stage = '.mysqli_real_escape_string($db->connection, $_POST['stage']);
			elseif($_POST['stage'] == 12)
				$where .= ' AND pokemon.stage <= 2 ';
			elseif($_POST['stage'] == 23)
				$where .= ' AND pokemon.stage >= 2 ';
		}
		if($_POST['rarity_from'] != 0 || $_POST['rarity_to'] != 4) {
			$where .= generate_rarity_sql($_POST['rarity_from'], $_POST['rarity_to']);
		}
		$pokemon_data = $db->select('pokemon.id', $from, NULL, NULL, $where, NULL, NULL, NULL, 'pokemon`.`id', FALSE);
		$pokemon_ids = array();
		foreach($pokemon_data as $poke_data) {
			$pokemon_ids[] = $poke_data['id'];
		}
		if($pokemon_data != NULL) {
			for($i = 0; $i < $_POST['number']; $i++) {
				$random_pokemon_id = $pokemon_ids[rand(0, count($pokemon_ids)-1)];
				$random_level = rand($_POST['level_from'], $_POST['level_to']);
				
				if((isset($_POST['strict']) && $_POST['strict'] == 1) || (isset($_POST['auto_evolve']) && $_POST['auto_evolve'] == 1)) {
					$evolution_data = $db->select('evolution,level', 'pokemon_evolutions', NULL, array('pokemon_id' => $random_pokemon_id), NULL, array('stage', 'ASC'));
					$min_level = NULL;
					foreach($evolution_data as $evo_data) {
						if($evo_data['evolution'] == $random_pokemon_id) {
							$min_level = $evo_data['level'];
							break;
						} elseif(isset($_POST['auto_evolve']) && $_POST['auto_evolve'] == 1 && $min_level != NULL) {
							if($evo_data['level'] < $random_level && in_array($evo_data['evolution'], $pokemon_ids)) {
								$random_pokemon_id = $evo_data['evolution'];
								$min_level = $evo_data['level'];
							}
						}
					}
					if(isset($_POST['strict']) && $_POST['strict'] == 1 && $min_level > $random_level) {
						$random_level = rand($min_level, $_POST['level_to']);
// 						while($min_level > $random_level) {
// 							$random_pokemon_id = $pokemon_ids[rand(0, count($pokemon_ids)-1)];
// 							$evolution_data = $db->select('level', 'pokemon_evolutions', 1, array('pokemon_id' => $random_pokemon_id, 'evolution' => $random_pokemon_id));
// 							$min_level = $evolution_data['level'];
// 						}
					}
				}
				$tmp_pokemon = new pta_pokemon($random_pokemon_id, $random_level);
				$pokemons[] = $tmp_pokemon;
			}
		}
	} elseif(isset($_POST['selected']) && isset($_POST['pokemon'])) {
		foreach($_POST['pokemon'] as $i => $pokemon_id) {
			if($pokemon_id != '')
				$pokemons[] = new pta_pokemon($pokemon_id, $_POST['level'][$i]);
		}
	}
	if(isset($pokemons)) {
		foreach($pokemons as $i => $pokemon) {
			$from_color = type_to_color($pokemon->type1, TRUE);
			if($pokemon->type2 != NULL)
				$to_color = type_to_color($pokemon->type2, TRUE);
			else
				$to_color = type_to_color($pokemon->type1, TRUE);
			if($pokemon->shiny) {?><div class="shiny"><?php }?>
			<div class="pokemon <?php if($i % 2 == 0) echo 'pokemon_even'; else echo 'pokemon_odd';?>" style="background: -moz-linear-gradient(-45deg, <?php echo $from_color;?> 0%, <?php echo $to_color;?> 100%); /* FF3.6+ */
				background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,<?php echo $from_color;?>), color-stop(100%,<?php echo $to_color;?>)); /* Chrome,Safari4+ */
				background: -webkit-linear-gradient(-45deg, <?php echo $from_color;?> 0%,<?php echo $to_color;?> 100%); /* Chrome10+,Safari5.1+ */
				background: -o-linear-gradient(-45deg, <?php echo $from_color;?> 0%,<?php echo $to_color;?> 100%); /* Opera 11.10+ */
				background: -ms-linear-gradient(-45deg, <?php echo $from_color;?> 0%,<?php echo $to_color;?> 100%); /* IE10+ */
				background: linear-gradient(135deg, <?php echo $from_color;?> 0%,<?php echo $to_color;?> 100%); /* W3C */">
				<div class="name"><?php echo $pokemon->number.'. '.$pokemon->name;?></div>
				<?php if($pokemon->mega_atk != 0 || $pokemon->mega_def != 0 || $pokemon->mega_satk != 0 || $pokemon->mega_sdef != 0 || $pokemon->mega_spd != 0) {?>
					<div id="mega_button<?php echo $i;?>" class="mega_button" onclick="megaEvolve(<?php echo $i.",'".$pokemon->mega_type."','".$pokemon->number."'"?>);">Mega<?php if($pokemon->mega_ability2 != NULL) echo ' X';?></div>
					<input type="hidden" id="mega_evolved<?php echo $i;?>" value="No"/>
				<?php }
				if($pokemon->mega_ability2 != NULL) {?>
					<div id="mega_button2<?php echo $i;?>" class="mega_button" onclick="megaEvolve2(<?php echo $i.",'".$pokemon->number."'"?>);">Mega Y</div>
					<input type="hidden" id="mega_evolved2<?php echo $i;?>" value="No"/>
				<?php }?>
				<div class="level">Lvl: <?php echo $pokemon->level?></div>
				<div class="elemental">Elemental Matchup
					<div id="elemental_slider<?php echo $i;?>" class="slider"></div>
				</div>
				<div class="clear"></div>
				<img id="pokemon_image<?php echo $i;?>" class="pokemon_image" src="/pokemon_images/<?php echo $pokemon->number;?>.png" width="200"/>
				<div class="main_stats_container">
					<div class="left_stats_container">
						<div id="pokemon_types<?php echo $i;?>" class="types"><?php echo $pokemon->type1; if($pokemon->type2 != NULL) echo ' / '.$pokemon->type2;?></div>
						<div class="nature"><span class="title">Nature: </span><span class="value" title="<?php echo 'Likes '.$pokemon->nature->liked.', dislikes '.$pokemon->nature->disliked.'.';?>"><?php echo $pokemon->nature->name;?></span></div>
						<div class="abilities">
							<?php if(isset($pokemon->basic_ability)) {?>
								<div class="basic_ability">
									<?php echo $pokemon->basic_ability->name;?>
									<div class="basic_details">
										<div class="detail">Activation: <?php echo $pokemon->basic_ability->activation;?></div>
										<?php if($pokemon->basic_ability->limit != NULL) {?><div class="detail">Limit: <?php echo $pokemon->basic_ability->limit;?></div><?php }?>
										<?php if($pokemon->basic_ability->keyword != NULL) {?><div class="detail">Keyword: <?php echo $pokemon->basic_ability->keyword;?></div><?php }?>
										<div class="detail">Effect: <?php echo $pokemon->basic_ability->effect;?></div>
									</div>
								</div>
							<?php }
							if($pokemon->high_ability != NULL) {?>
								<div class="comma">,</div>
								<div class="high_ability">
									<?php echo $pokemon->high_ability->name;?>
									<div class="high_details">
										<div class="detail">Activation: <?php echo $pokemon->high_ability->activation;?></div>
										<?php if($pokemon->high_ability->limit != NULL) {?><div class="detail">Limit: <?php echo $pokemon->high_ability->limit;?></div><?php }?>
										<?php if($pokemon->high_ability->keyword != NULL) {?><div class="detail">Keyword: <?php echo $pokemon->high_ability->keyword;?></div><?php }?>
										<div class="detail">Effect: <?php echo $pokemon->high_ability->effect;?></div>
									</div>
								</div>
							<?php }
							if($pokemon->mega_ability != NULL) {?>
								<div class="clear"></div>
								<div id="mega_ability<?php echo $i;?>" class="mega_ability">
									<?php echo $pokemon->mega_ability->name;?>
									<div class="mega_details">
										<div class="detail">Activation: <?php echo $pokemon->mega_ability->activation;?></div>
										<?php if($pokemon->mega_ability->limit != NULL) {?><div class="detail">Limit: <?php echo $pokemon->mega_ability->limit;?></div><?php }?>
										<?php if($pokemon->mega_ability->keyword != NULL) {?><div class="detail">Keyword: <?php echo $pokemon->mega_ability->keyword;?></div><?php }?>
										<div class="detail">Effect: <?php echo $pokemon->mega_ability->effect;?></div>
									</div>
								</div>
							<?php }
							if($pokemon->mega_ability2 != NULL) {
								$mega_ability2 = new pta_ability($pokemon->mega_ability2);?>
								<div class="clear"></div>
								<div id="mega_ability2<?php echo $i;?>" class="mega_ability">
									<?php echo $mega_ability2->name;?>
									<div class="mega_details">
										<div class="detail">Activation: <?php echo $mega_ability2->activation;?></div>
										<?php if($mega_ability2->limit != NULL) {?><div class="detail">Limit: <?php echo $mega_ability2->limit;?></div><?php }?>
										<?php if($mega_ability2->keyword != NULL) {?><div class="detail">Keyword: <?php echo $mega_ability2->keyword;?></div><?php }?>
										<div class="detail">Effect: <?php echo $mega_ability2->effect;?></div>
									</div>
								</div>
							<?php }?>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
						<table class="stats">
							<tr>
								<td>HP</td>
								<td><!-- <input type="button" value="-"/> --></td>
								<td><?php echo $pokemon->stats['hp'];?></td>
								<td><!-- <input type="button" value="+"/> --></td>
								<td>Stage</td>
							</tr>
							<tr>
								<td>Atk</td>
								<td><input type="button" class="button" value="-" onclick="combatStage('atk', -1, <?php echo $i;?>);"/></td>
								<td id="atk_<?php echo $i;?>"><?php echo $pokemon->stats['atk'];?></td>
								<td><input type="button" class="button" value="+" onclick="combatStage('atk', 1, <?php echo $i;?>);"/></td>
								<td id="atk_stage_<?php echo $i;?>"></td>
							</tr>
							<tr>
								<td>Def</td>
								<td><input type="button" class="button" value="-" onclick="combatStage('def', -1, <?php echo $i;?>);"/></td>
								<td id="def_<?php echo $i;?>"><?php echo $pokemon->stats['def'];?></td>
								<td><input type="button" class="button" value="+" onclick="combatStage('def', 1, <?php echo $i;?>);"/></td>
								<td id="def_stage_<?php echo $i;?>"></td>
							</tr>
							<tr>
								<td>S.Atk</td>
								<td><input type="button" class="button" value="-" onclick="combatStage('satk', -1, <?php echo $i;?>);"/></td>
								<td id="satk_<?php echo $i;?>"><?php echo $pokemon->stats['satk'];?></td>
								<td><input type="button" class="button" value="+" onclick="combatStage('satk', 1, <?php echo $i;?>);"/></td>
								<td id="satk_stage_<?php echo $i;?>"></td>
							</tr>
							<tr>
								<td>S.Def</td>
								<td><input type="button" class="button" value="-" onclick="combatStage('sdef', -1, <?php echo $i;?>);"/></td>
								<td id="sdef_<?php echo $i;?>"><?php echo $pokemon->stats['sdef'];?></td>
								<td><input type="button" class="button" value="+" onclick="combatStage('sdef', 1, <?php echo $i;?>);"/></td>
								<td id="sdef_stage_<?php echo $i;?>"></td>
							</tr>
							<tr>
								<td>Speed</td>
								<td><input type="button" class="button" value="-" onclick="combatStage('spd', -1, <?php echo $i;?>);"/></td>
								<td id="spd_<?php echo $i;?>"><?php echo $pokemon->stats['spd'];?></td>
								<td><input type="button" class="button" value="+" onclick="combatStage('spd', 1, <?php echo $i;?>);"/></td>
								<td id="spd_stage_<?php echo $i;?>"></td>
							</tr>
						</table>
						<div class="clear"></div>
					</div>
					<table class="hp_container">
						<tr>
							<th colspan="2">Current HP</th>
						</tr>
						<tr>
							<td colspan="2" class="current_hp"><input type="text" class="numeric" onchange="updateCapture(<?php echo $i;?>, this.value, <?php echo $pokemon->total_hp;?>);" id="current_hp_<?php echo $i;?>" value="<?php echo $pokemon->total_hp;?>"/> / <span id="total_hp_<?php echo $i;?>"><?php echo $pokemon->total_hp;?></span></td>
						</tr>
						<tr>
							<td colspan="2">
								<table class="multiplier_table">
									<tr>
										<th>x1</th><th>x&frac12;</th><th>x2</th><th>x&frac14;</th><th>x4</th>
									</tr>
									<tr>
										<th><input type="radio" name="weakness_<?php echo $i;?>" id="1_<?php echo $i;?>" value="1" checked="checked"/></th>
										<th><input type="radio" name="weakness_<?php echo $i;?>" id="12_<?php echo $i;?>" value="1/2"/></th>
										<th><input type="radio" name="weakness_<?php echo $i;?>" id="2_<?php echo $i;?>" value="2"/></th>
										<th><input type="radio" name="weakness_<?php echo $i;?>" id="14_<?php echo $i;?>" value="1/4"/></th>
										<th><input type="radio" name="weakness_<?php echo $i;?>" id="4_<?php echo $i;?>" value="4"/></th>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td><input type="button" class="button" value="Atk Dmg" onclick="dealDamage('atk', <?php echo $i?>);"/></td>
							<td><input type="text" class="numeric" id="atk_dmg_<?php echo $i;?>"/></td>
						<tr>
						<tr>
							<td><input type="button" class="button" value="S.Atk Dmg" onclick="dealDamage('satk', <?php echo $i?>);"/></td>
							<td><input type="text" class="numeric" id="satk_dmg_<?php echo $i;?>"/></td>
						<tr>
						<tr>
							<td><input type="button" class="button" value="True Dmg" onclick="dealDamage('tru', <?php echo $i?>);"/></td>
							<td><input type="text" class="numeric" id="tru_dmg_<?php echo $i;?>"/></td>
						<tr>
						<tr>
							<td><input type="button" class="button" value="Heal" onclick="dealDamage('heal', <?php echo $i?>);"/></td>
							<td><input type="text" class="numeric" id="heal_dmg_<?php echo $i;?>"/></td>
						<tr>
					</table>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
				<table class="capabilities">
					<tr>
						<?php $capabilities_total = 0;
						if($pokemon->overland != NULL) {
							$capabilities_total++;?>
								<td class="capability_name">Overland<input type="hidden" id="overland_base_<?php echo $i;?>" value="<?php echo $pokemon->overland;?>"/>
								<span id="overland_<?php echo $i;?>"><?php echo $pokemon->overland;?></span></td>
						<?php } if($pokemon->surface != NULL) {
							$capabilities_total++;?>
								<td class="capability_name">Surface<input type="hidden" id="surface_base_<?php echo $i;?>" value="<?php echo $pokemon->surface;?>"/>
								<span id="surface_<?php echo $i;?>"><?php echo $pokemon->surface;?></span></td>
						<?php } if($pokemon->underwater != NULL) {
							$capabilities_total++;
							if($capabilities_total % 3 == 1)
								echo '</tr><tr>';?>
								<td class="capability_name">Underwater<input type="hidden" id="underwater_base_<?php echo $i;?>" value="<?php echo $pokemon->underwater;?>"/>
								<span id="underwater_<?php echo $i;?>"><?php echo $pokemon->underwater;?></span></td>
						<?php } if($pokemon->sky != NULL) {
							$capabilities_total++;
							if($capabilities_total % 3 == 1)
								echo '</tr><tr>';?>
								<td class="capability_name">Sky<input type="hidden" id="sky_base_<?php echo $i;?>" value="<?php echo $pokemon->sky;?>"/>
								<span id="sky_<?php echo $i;?>"><?php echo $pokemon->sky;?></span></td>
						<?php } if($pokemon->burrow != NULL) {
							$capabilities_total++;
							if($capabilities_total % 3 == 1)
								echo '</tr><tr>';?>
								<td class="capability_name">Burrow<input type="hidden" id="burrow_base_<?php echo $i;?>" value="<?php echo $pokemon->burrow;?>"/>
								<span id="burrow_<?php echo $i;?>"><?php echo $pokemon->burrow;?></span></td>
						<?php } if($pokemon->jump != NULL) {
							$capabilities_total++;
							if($capabilities_total % 3 == 1)
								echo '</tr><tr>';?>
								<td class="capability_name">Jump <span><?php echo $pokemon->jump;?></span></td>
						<?php } if($pokemon->power != NULL) {
							$capabilities_total++;
							if($capabilities_total % 3 == 1)
								echo '</tr><tr>';?>
								<td class="capability_name">Power <span><?php echo $pokemon->power;?></span></td>
						<?php } if($pokemon->intelligence != NULL) {
							$capabilities_total++;
							if($capabilities_total % 3 == 1)
								echo '</tr><tr>';?>
								<td class="capability_name">Intelligence <span><?php echo $pokemon->intelligence;?></span></td>
						<?php }?>
					</tr>
					<?php if(count($pokemon->capabilities) > 0) {?>
						<tr>
							<td colspan="6">
								<?php foreach($pokemon->capabilities as $capability => $description) {
									echo '<div class="capability">'.$capability.'<div class="capability_description">'.$description.'</div></div>';
								}?>
							</td>
						</tr>
					<?php }?>
				</table>
				<table class="misc_info">
					<tr>
						<td colspan="2">Height: <?php echo $pokemon->height;?></td>
					</tr>
					<tr>	
						<td colspan="2">Weight: <?php echo $pokemon->weight;?></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo $pokemon->gender;?></td>
					</tr>
					<tr>
						<td>Cap Rate<input type="hidden" id="base_capture_<?php echo $i;?>" value="<?php echo $pokemon->current_capture;?>"/></td>
						<td id="capture_rate_<?php echo $i;?>"><?php echo ($pokemon->current_capture - 15);?></td>
					</tr>
				</table>
				<table class="evasion">
					<tr>
						<th colspan="2">Evasion</th>
					</tr>
					<tr>
						<td>Atk: </td><td id="atk_evas_<?php echo $i;?>"><?php echo min(floor($pokemon->stats['def'] / 5), 6);?></td>
					</tr>
					<tr>
						<td>S.Atk: </td><td id="satk_evas_<?php echo $i;?>"><?php echo min(floor($pokemon->stats['sdef'] / 5), 6);?></td>
					</tr>
					<tr>
						<td>Both: </td><td id="spd_evas_<?php echo $i;?>"><?php echo min(floor($pokemon->stats['spd'] / 10), 6);?></td>
					</tr>
				</table>
				<div class="clear"></div>
				<div class="move_tabs">
					<?php if($pokemon->moves != NULL) {?>
						<div id="learned_tab<?php echo $i;?>" class="move_tab selected" onclick="showMoves(<?php echo $i?>,'learned');">Learned Moves</div>
					<?php }
					if($pokemon->tmhm_moves != NULL) {?>
						<div id="tmhm_tab<?php echo $i;?>" class="move_tab" onclick="showMoves(<?php echo $i?>,'tmhm');">TM/HM Moves</div>
					<?php }
					if($pokemon->tutor_moves != NULL) {?>
						<div id="tutor_tab<?php echo $i;?>" class="move_tab" onclick="showMoves(<?php echo $i?>,'tutor');">Tutor Moves</div>
					<?php }
					if($pokemon->egg_moves != NULL) {?>
						<div id="egg_tab<?php echo $i;?>" class="move_tab" onclick="showMoves(<?php echo $i?>,'egg');">Egg Moves</div>
					<?php }?>
				</div>
				<table class="moves">
					<tr class="show">
						<th>Name</th><th>Type</th><th>Rate</th><th>Acc</th><th>Range</th><th>Stat</th><th>Damage</th><th>Effect</th>
					</tr>
					<?php if($pokemon->moves != NULL) {
						foreach($pokemon->moves as $move) {?>
							<tr class="learned_move<?php echo $i?> show">
								<td>
									<?php echo $move->name;
									if($move->effect2 != NULL) {?>
										<div class="full_text">
											<?php echo $move->effect2;
											if($move->id == 340) {?>
												<div class="clear"></div>
												<input type="button" value="Select Random Move" onclick="randomMove(<?php echo $i;?>);"/>
												<div class="clear"></div>
												<div id="random_move<?php echo $i;?>" class="random_move"></div>
											<?php }?>
										</div>
									<?php }?>
								</td>
								<td style="background-color: <?php echo type_to_color($move->type);?>;"><?php echo $move->type;?></td>
								<td><?php echo $move->rate;?></td>
								<td><?php echo $move->accuracy;?></td>
								<td><?php echo $move->range;?></td>
								<td><?php echo $move->stat;?></td>
								<td><?php echo $move->damage; if($move->damage != NULL && $pokemon->level >= 5 && ($move->type == $pokemon->type1 || $move->type == $pokemon->type2)) echo '+'.floor($pokemon->level / 5);?></td>
								<td><?php echo $move->effect1;?></td>
							</tr>
						<?php }
					}
					if($pokemon->tmhm_moves != NULL) {
						foreach($pokemon->tmhm_moves as $move) {?>
							<tr class="tmhm_move<?php echo $i?>">
								<td>
									<?php echo $move->name;
									if($move->effect2 != NULL) {?>
										<div class="full_text">
											<?php echo $move->effect2;
											if($move->id == 340) {?>
												<div class="clear"></div>
												<input type="button" value="Select Random Move" onclick="randomMove(<?php echo $i;?>);"/>
												<div class="clear"></div>
												<div id="random_move<?php echo $i;?>" class="random_move"></div>
											<?php }?>
										</div>
									<?php }?>
								</td>
								<td style="background-color: <?php echo type_to_color($move->type);?>;"><?php echo $move->type;?></td>
								<td><?php echo $move->rate;?></td>
								<td><?php echo $move->accuracy;?></td>
								<td><?php echo $move->range;?></td>
								<td><?php echo $move->stat;?></td>
								<td><?php echo $move->damage; if($move->damage != NULL && $pokemon->level >= 5 && ($move->type == $pokemon->type1 || $move->type == $pokemon->type2)) echo '+'.floor($pokemon->level / 5);?></td>
								<td><?php echo $move->effect1;?></td>
							</tr>
						<?php }
					}
					if($pokemon->tutor_moves != NULL) {
						foreach($pokemon->tutor_moves as $move) {?>
							<tr class="tutor_move<?php echo $i?>">
								<td>
									<?php echo $move->name;
									if($move->effect2 != NULL) {?>
										<div class="full_text">
											<?php echo $move->effect2;
											if($move->id == 340) {?>
												<div class="clear"></div>
												<input type="button" value="Select Random Move" onclick="randomMove(<?php echo $i;?>);"/>
												<div class="clear"></div>
												<div id="random_move<?php echo $i;?>" class="random_move"></div>
											<?php }?>
										</div>
									<?php }?>
								</td>
								<td style="background-color: <?php echo type_to_color($move->type);?>;"><?php echo $move->type;?></td>
								<td><?php echo $move->rate;?></td>
								<td><?php echo $move->accuracy;?></td>
								<td><?php echo $move->range;?></td>
								<td><?php echo $move->stat;?></td>
								<td><?php echo $move->damage; if($move->damage != NULL && $pokemon->level >= 5 && ($move->type == $pokemon->type1 || $move->type == $pokemon->type2)) echo '+'.floor($pokemon->level / 5);?></td>
								<td><?php echo $move->effect1;?></td>
							</tr>
						<?php }
					}
					if($pokemon->egg_moves != NULL) {
						foreach($pokemon->egg_moves as $move) {?>
							<tr class="egg_move<?php echo $i?>">
								<td>
									<?php echo $move->name;
									if($move->effect2 != NULL) {?>
										<div class="full_text">
											<?php echo $move->effect2;
											if($move->id == 340) {?>
												<div class="clear"></div>
												<input type="button" value="Select Random Move" onclick="randomMove(<?php echo $i;?>);"/>
												<div class="clear"></div>
												<div id="random_move<?php echo $i;?>" class="random_move"></div>
											<?php }?>
										</div>
									<?php }?>
								</td>
								<td style="background-color: <?php echo type_to_color($move->type);?>;"><?php echo $move->type;?></td>
								<td><?php echo $move->rate;?></td>
								<td><?php echo $move->accuracy;?></td>
								<td><?php echo $move->range;?></td>
								<td><?php echo $move->stat;?></td>
								<td><?php echo $move->damage; if($move->damage != NULL && $pokemon->level >= 5 && ($move->type == $pokemon->type1 || $move->type == $pokemon->type2)) echo '+'.floor($pokemon->level / 5);?></td>
								<td><?php echo $move->effect1;?></td>
							</tr>
						<?php }
					}?>
				</table>
				<input type="hidden" id="pokemon_type1<?php echo $i;?>" value="<?php echo $pokemon->type1;?>"/>
				<input type="hidden" id="pokemon_type2<?php echo $i;?>" value="<?php echo $pokemon->type2;?>"/>
				<input type="hidden" id="base_atk<?php echo $i;?>" value="<?php echo $pokemon->stats['atk'];?>"/>
				<input type="hidden" id="base_def<?php echo $i;?>" value="<?php echo $pokemon->stats['def'];?>"/>
				<input type="hidden" id="base_satk<?php echo $i;?>" value="<?php echo $pokemon->stats['satk'];?>"/>
				<input type="hidden" id="base_sdef<?php echo $i;?>" value="<?php echo $pokemon->stats['sdef'];?>"/>
				<input type="hidden" id="base_spd<?php echo $i;?>" value="<?php echo $pokemon->stats['spd'];?>"/>
				<input type="hidden" id="mega_atk<?php echo $i;?>" value="<?php echo $pokemon->mega_atk;?>"/>
				<input type="hidden" id="mega_def<?php echo $i;?>" value="<?php echo $pokemon->mega_def;?>"/>
				<input type="hidden" id="mega_satk<?php echo $i;?>" value="<?php echo $pokemon->mega_satk;?>"/>
				<input type="hidden" id="mega_sdef<?php echo $i;?>" value="<?php echo $pokemon->mega_sdef;?>"/>
				<input type="hidden" id="mega_spd<?php echo $i;?>" value="<?php echo $pokemon->mega_spd;?>"/>
				<input type="hidden" id="mega_atk2<?php echo $i;?>" value="<?php echo $pokemon->mega_atk2;?>"/>
				<input type="hidden" id="mega_def2<?php echo $i;?>" value="<?php echo $pokemon->mega_def2;?>"/>
				<input type="hidden" id="mega_satk2<?php echo $i;?>" value="<?php echo $pokemon->mega_satk2;?>"/>
				<input type="hidden" id="mega_sdef2<?php echo $i;?>" value="<?php echo $pokemon->mega_sdef2;?>"/>
				<input type="hidden" id="mega_spd2<?php echo $i;?>" value="<?php echo $pokemon->mega_spd2;?>"/>
			</div>
			<?php if($pokemon->shiny) {?></div><?php }
			if($i % 2 == 1) {?>
				<div class="clear"></div>
			<?php }?>
			<script type="text/javascript">
				pokemonStats[<?php echo $i;?>] = new Array(0,0,0,0,0);
				$('exp_table').innerHTML += '<tr><td><input type="checkbox" onclick="updateExp();" checked="checked"/></td><td><?php echo $pokemon->name;?></td><td><?php echo ($pokemon->exp_drop * $pokemon->level);?></td></tr>';
			</script>
		<?php }?>
		<script type="text/javascript">
			document.addEventListener('DOMContentLoaded', function() {
				updateExp();
				<?php foreach($pokemons as $i => $pokemon) {?>
					getElementalMatches(<?php echo $i;?>);
				<?php }?>
			}, false);
		</script>
	<?php } elseif(isset($_POST['random']) && is_numeric($_POST['number']) && $_POST['number'] > 20) {?>
		<div class="title">You should not have been able to get here without doing something malicious, probably attempting to crash my server. Shame on you.</div>
	<?php } elseif(isset($_POST['random'])) {?>
		<div class="title">No Pokemon match your query.</div>
	<?php } else {?>
		<div class="title">Please generate some Pokemon first.</div>
	<?php }
require_once 'inc/footer.php';?>