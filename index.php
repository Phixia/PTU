<?php require_once 'classes/loader.php';

$habitat_data = $db->select('*', 'habitats', NULL, NULL, NULL, array('name', 'ASC'));
$required_css = array('home');
$required_js = array('home', 'doubleslider');
require_once 'inc/header.php';?>
<div class="news">News: The site has been updated for ORAS! Don't worry if you still want to use the old Beta 1.34 version it can be found here: <a href="https://beta.pokemontabletopadventures.com">beta.pokemontabletopadventures.com</a></div>
<div class="clear"></div>
<div class="title">Generate Random Encounter</div>
<form method="post" action="/pokemon.php">
	<?php /*<div class="table_container">*/?>
		<table class="encounter_table">
			<tr>
				<th># of Pokemon</th>
				<th>Level Range</th>
				<th>Habitat</th>
				<th>Type</th>
				<th>Generation</th>
			</tr>
			<tr>
				<td>
					<select name="number">
						<?php for($i = 1; $i <= 20; $i++) {
							echo '<option value="'.$i.'">'.$i.'</option>';
						}?>
					</select>
				</td>
				<td>
					<select name="level_from" onchange="updateLevelTo(this.value);">
						<?php for($i = 1; $i <= 100; $i++) {
							echo '<option value="'.$i.'">'.$i.'</option>';
						}?>
					</select> to
					<select id="level_to" name="level_to">
						<?php for($i = 1; $i <= 100; $i++) {
							echo '<option value="'.$i.'">'.$i.'</option>';
						}?>
					</select>
				</td>
				<td>
					<div class="habitat_spacer"></div>
					<div class="expandable">
						<table class="checkbox_table">
							<tr>
								<td><input type="checkbox" id="all_habitats" name="all_habitats" onchange="toggleAllHabitats();" checked="checked"/></td>
								<td>All</td>
							</tr>
							<?php foreach($habitat_data as $habitat) {?>
								<tr>
									<td><input type="checkbox" class="habitat_input" name="habitat[]" onchange="setCustomHabitats(this);" value="<?php echo $habitat['id'];?>" checked="checked"/></td>
									<td><?php echo $habitat['name'];?></td>
								</tr>
							<?php }?>
						</table>
					</div>
					<?php /*<select name="habitat">
						<option value="">Any</option>
						<?php foreach($habitat_data as $habitat) {
							echo '<option value="'.$habitat['id'].'">'.$habitat['name'].'</option>';
						}?>
					</select>*/?>
				</td>
				<td>
					<input type="radio" name="search_type" value="inclusive" checked="checked"/> Inclusive<span class="help" title="e.g. If you select only Fire, you can still get Fire/Flying or Fire/Fighting, etc.">?</span>
					<input type="radio" name="search_type" value="exclusive"/> Exclusive<span class="help" title="e.g. If you select Fire and Flying you will only get Fire, Flying, and Fire/Flying Pokemon.">?</span>
					<div class="type_spacer"></div>
					<div class="expandable expandable_types">
						<table class="checkbox_table">
							<tr>
								<td><input type="checkbox" id="all_types" name="all_types" onchange="toggleAllTypes();" checked="checked"/></td>
								<td>All</td>
							</tr>
							<?php foreach($loader->types as $type) {?>
								<tr style="background-color: <?php echo type_to_color($type);?>;">
									<td><input type="checkbox" class="type_input" name="type[]" onchange="setCustomTypes(this);" value="<?php echo $type;?>" checked="checked"/></td>
									<td><?php echo $type;?></td>
								</tr>
							<?php }?>
						</table>
					</div>
					<?php /*<select name="type" onchange="if(this.value != '') this.style.backgroundColor = type_to_color(this.value); else this.style.backgroundColor = '#FFFFFF';">
						<option value="">Any</option>
						<?php foreach($loader->types as $type) {
							echo '<option value="'.$type.'" style="background-color: '.type_to_color($type).';">'.$type.'</option>';
						}?>
					</select>*/?>
				</td>
				<td>
					<div class="generation_spacer"></div>
					<div class="expandable expandable_generations">
						<table class="checkbox_table">
							<tr>
								<td><input type="checkbox" id="all_generations" name="all_generations" onchange="toggleAllGenerations();" checked="checked"/></td>
								<td>All</td>
							</tr>
							<?php for($i = 1; $i <= 6; $i++) {?>
								<tr>
									<td><input type="checkbox" class="generation_input" name="generation[]" onchange="setCustomGenerations(this);" value="<?php echo $i;?>" checked="checked"/></td>
									<td>Generation <?php echo romanic_number($i);?></td>
								</tr>
							<?php }?>
						</table>
					</div>
				</td>
			</tr>
			<tr>
				<th>Stage</th>
				<th>Rarity<span class="details" title="Experimental, uses base capture rate to estimate rarity.">?</span></th>
				<th>Strict Levels<span class="details" title="Enforces minimum level requirements for all evolutions. i.e. you can't generate a level 2 Charizard.">?</span></th>
				<th>Auto Evolve<span class="details" title="All Pokemon generated will be the highest evolution possible for their level (that still matches your filters). i.e. you won't get a level 30 Charmander, it will be a Charizard instead. Unless you've specified no flying Pokemon, then you'd get a level 30 Charmeleon instead.">?</span></th>
				<th>Include Legendaries</th>
			</tr>
			<tr>
				<td>
					<select name="stage">
						<option value="">Any</option>
						<option value="1">Stage 1</option>
						<option value="2">Stage 2</option>
						<option value="3">Stage 3</option>
						<option value="12">Stages 1 &amp; 2</option>
						<option value="23">Stages 2 &amp; 3</option>
					</select>
				</td>
				<td>
					<div class="rarity_text" id="rarity_text">Very Common to Very Rare</div>
					<div id="rarity_selector">
						<div class="knob"></div>
						<div class="knob"></div>
					</div>
					<input type="hidden" name="rarity_from" id="rarity_from" value="0"/>
					<input type="hidden" name="rarity_to" id="rarity_to" value="4"/>
				</td>
				<td><input type="checkbox" name="strict" value="1" checked="checked"/></td>
				<td><input type="checkbox" name="auto_evolve" value="1" checked="checked"/></td>
				<td><input type="checkbox" name="legendary" value="1"/></td>
			</tr>
			<tr>
				<td colspan="4"><input type="submit" class="submit" name="random" value="Go!"/></td>
			</tr>
		</table>
</form>
<div class="title second_title">Select Pokemon</div>
<form method="post" action="/pokemon.php">
	<div class="table_container second_container">
		<table class="encounter_table">
			<thead>
				<tr>
					<th colspan="2">
						<span class="order">Order by:</span>
						<input type="radio" name="order" id="number" onchange="addPokemon();" checked="checked"/>
						<label for="number">Number </label>
						<input type="radio" name="order" id="name" onchange="addPokemon();"/>
						<label for="name">Name</label>
					</th>
				</tr>
				<tr>
					<th colspan="2">
						<span class="habitat">Habitat</span>
						<select onchange="addPokemon();" id="habitat">
							<option value="">Any</option>
							<?php foreach($habitat_data as $habitat) {
								echo '<option value="'.$habitat['id'].'">'.$habitat['name'].'</option>';
							}?>
						</select>
					</th>
				</tr>
				<tr class="divider">
					<th>Pokemon</th><th>Level</th>
				</tr>
			</thead>
			<tbody id="table_body"></tbody>
		</table>
		<div class="go_button"><input type="submit" class="submit" name="selected" value="Go!"/></div>
		<div class="clear"></div>
	</div>
</form>
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {
		addPokemon();
		var doubleslider = new DoubleSlider(
		  'rarity_selector',
		  {
			  onChange: function(firstValue, secondValue) {
			    $('rarity_from').value = firstValue;
			    $('rarity_to').value = secondValue;
			    if(firstValue == secondValue)
				    $('rarity_text').innerHTML = numToRarity(firstValue)+' only';
			    else
			    	$('rarity_text').innerHTML = numToRarity(firstValue)+' to '+numToRarity(secondValue);
			  },
		    range: [0, 4],
		    start: [0, 4],
		    steps: 4
		  }
		);
	}, false);
</script>
<?php require_once 'inc/footer.php';?>