<?php ini_set('max_execution_time', 3600);
require_once 'classes/loader.php';
$file_handle = fopen("text_files/ORAS_Modified_Pokedex.txt", "r");
$capabilities = FALSE;
$evolutions = FALSE;
$level_up_moves_flag = FALSE;
while (!feof($file_handle)) {
	$line = fgets($file_handle);
	if(!is_numeric(substr($line, 0, 1))) {
		$evolutions = FALSE;
		$moves = FALSE;
	}
	if(preg_match('/[\d|L]\d\d\. /', $line) === 1) {
		if(isset($pokemon_data)) {
			$data = $db->select('id', 'pokemon', 1, array('name' => $pokemon_data['name']));
			$pokemon_id = $data['id'];
			$db->update('pokemon', array('capture_rate' => $pokemon_data['capture_rate']), array('id' => $pokemon_id));
// 			if($pokemon_data['number'] == '490') {
// 				$pokemon_id = $db->insert('pokemon', $pokemon_data, FALSE);
				
// 				if(isset($pokemon_capabilities)) {
// 					foreach($pokemon_capabilities as $pokemon_capability) {
// 						$db->insert('pokemon_capabilities', array('pokemon_id' => $pokemon_id, 'capability_id' => $pokemon_capability));
// 					}
// 				}
// 				if(isset($pokemon_moves)) {
// 					foreach($pokemon_moves as $move) {
// 						$what = array('pokemon_id' => $pokemon_id, 'move_id' => $move['move_id'], 'level' => $move['level']);
// 						if(isset($move['signature']))
// 							$what['signature'] = $move['signature'];
// 						$db->insert('pokemon_moves', $what);
// 					}
// 				}
// 				if(isset($pokemon_tmhm_moves)) {
// 					foreach($pokemon_tmhm_moves as $pokemon_tmhm_move) {
// 						$db->insert('pokemon_tms_hms', array('pokemon_id' => $pokemon_id, 'tm_hm_id' => $pokemon_tmhm_move));
// 					}
// 				}
// 				if(isset($pokemon_egg_moves)) {
// 					foreach($pokemon_egg_moves as $pokemon_egg_move) {
// 						$db->insert('pokemon_egg_moves', array('pokemon_id' => $pokemon_id, 'move_id' => $pokemon_egg_move));
// 					}
// 				}
// 				if(isset($pokemon_tutor_moves)) {
// 					foreach($pokemon_tutor_moves as $pokemon_tutor_move) {
// 						$db->insert('pokemon_tutor_moves', array('pokemon_id' => $pokemon_id, 'move_id' => $pokemon_tutor_move));
// 					}
// 				}
// 				if(!isset($basic_abilities)) {
// 					var_dump($pokemon_data);
// 					die();
// 				}
// 				foreach($basic_abilities as $ability) {
// 					$ability_data = $db->select('id', 'ability', 1, array('name' => $ability));
// 					if($ability_data != FALSE) {
// 						$db->insert('pokemon_abilities', array('pokemon_id' => $pokemon_id, 'ability_id' => $ability_data['id'], 'level' => 'basic'));
// 					} else {
// 						var_dump('Pokemon: '.$pokemon_data['name'].'<br/>Ability: '.$ability.'<br/><br/>');
// 						die();
// 					}
// 				}
// 				foreach($high_abilities as $ability) {
// 					if(preg_match("/([^\(]*)\(M - ([^\)]*)\)/", $ability, $matches) === 1) {
// 						$ability_data = $db->select('id', 'ability', 1, array('name' => trim($matches[1])));
// 						if($ability_data != FALSE) {
// 							$db->insert('pokemon_abilities', array('pokemon_id' => $pokemon_id, 'ability_id' => $ability_data['id'], 'level' => 'high'));
// 						} else {
// 							echo 'Pokemon: '.$pokemon_data['name'].'<br/>Ability: ';
// 							var_dump($matches);
// 							die();
// 						}
						
// 						$ability_data = $db->select('id', 'ability', 1, array('name' => trim($matches[2])));
// 						if($ability_data != FALSE) {
// 							$db->insert('pokemon_abilities', array('pokemon_id' => $pokemon_id, 'ability_id' => $ability_data['id'], 'level' => 'mega'));
// 						} else {
// 							echo 'Pokemon: '.$pokemon_data['name'].'<br/>Ability: ';
// 							var_dump($matches);
// 							die();
// 						}
// 					} else {
// 						$ability_data = $db->select('id', 'ability', 1, array('name' => $ability));
// 						if($ability_data != FALSE) {
// 							$db->insert('pokemon_abilities', array('pokemon_id' => $pokemon_id, 'ability_id' => $ability_data['id'], 'level' => 'high'));
// 						} else
// 							var_dump('Pokemon: '.$pokemon_data['name'].'<br/>Ability: '.$ability.'<br/><br/>');
// 					}
// 				}
// 				foreach($habitat_data as $habitat) {
// 					$data = $db->select('id', 'habitats', 1, array('name' => $habitat));
// 					if($data == FALSE)
// 						$id = $db->insert('habitats', array('name' => $habitat));
// 					else
// 						$id = $data['id'];
// 					$db->insert('pokemon_habitats', array('pokemon_id' => $pokemon_id, 'habitat_id' => $id));
// 				}
// 				echo 'Done';
// 				die();
// 			}
			
// 			if(preg_match('/([\d]+) \+([\d]+)/', $pokemon_data['atk'], $matches) == 1) {
// 				$db->update('pokemon', array('atk' => $matches[1], 'mega_atk' => $matches[2]), array('id' => $pokemon_id));
// 			}
// 			if(preg_match('/([\d]+) \+([\d]+)/', $pokemon_data['def'], $matches) == 1) {
// 				$db->update('pokemon', array('def' => $matches[1], 'mega_def' => $matches[2]), array('id' => $pokemon_id));
// 			}
// 			if(preg_match('/([\d]+) \+([\d]+)/', $pokemon_data['satk'], $matches) == 1) {
// 				$db->update('pokemon', array('satk' => $matches[1], 'mega_satk' => $matches[2]), array('id' => $pokemon_id));
// 			}
// 			if(preg_match('/([\d]+) \+([\d]+)/', $pokemon_data['sdef'], $matches) == 1) {
// 				$db->update('pokemon', array('sdef' => $matches[1], 'mega_sdef' => $matches[2]), array('id' => $pokemon_id));
// 			}
// 			if(preg_match('/([\d]+) \+([\d]+)/', $pokemon_data['spd'], $matches) == 1) {
// 				$db->update('pokemon', array('spd' => $matches[1], 'mega_spd' => $matches[2]), array('id' => $pokemon_id));
// 			}
			
// 			if(isset($pokemon_evolutions) && count($pokemon_evolutions) > 0) {
// 				foreach($pokemon_evolutions as $evolution) {
// 					$stage_name = explode(' - ', $evolution);
// 					$evolution_info = explode(' Minimum ', $stage_name[1]);
// 					if(strpos($evolution_info[0], ' Holding') !== FALSE)
// 						$evolution_info[0] = substr($evolution_info[0], 0, strpos($evolution_info[0], ' Holding'));
// 					if(preg_match('/[^ ]* Stone/', $evolution_info[0], $matches) == 1) {
// 						$evolution_info[0] = trim(substr($evolution_info[0], 0, strpos($evolution_info[0], $matches[0])));
// 					}
					
// 					if(strtolower(substr($stage_name[1], 0, strlen($pokemon_data['name']))) == strtolower($pokemon_data['name'])) {
// 						$db->update('pokemon', array('stage' => $stage_name[0]), array('id' => $pokemon_id));
// 						$what = array('pokemon_id' => $pokemon_id, 'evolution' => $pokemon_id, 'stage' => $stage_name[0]);
// 						if(count($evolution_info) > 1) {
// 							$what['level'] = $evolution_info[1];
// 						}
// 						$db->insert('pokemon_evolutions', $what);
// 					} else {
// 						$pokemon_evolution = $db->select('id', 'pokemon', 1, array('name' => $evolution_info[0]));
// 						if($pokemon_evolution == FALSE) {
// 							var_dump($evolution_info);
// 							die();
// 						}
// 						$what = array('pokemon_id' => $pokemon_id, 'evolution' => $pokemon_evolution['id'], 'stage' => $stage_name[0]);
// 						if(count($evolution_info) > 1) {
// 							$what['level'] = $evolution_info[1];
// 							if(!is_numeric($evolution_info[1])) {
// 								var_dump($evolution_info[1]);
// 								die();
// 							}
// 						}
// 						$db->insert('pokemon_evolutions', $what);
// 					}
// 				}
// 			}
			unset($pokemon_data);
			unset($pokemon_capabilities);
			unset($pokemon_moves);
			unset($pokemon_tmhm_moves);
			unset($pokemon_egg_moves);
			unset($pokemon_tutor_moves);
			unset($basic_abilities);
			unset($high_abilities);
			unset($pokemon_evolutions);
		}
		$number_name = explode('. ', $line);
		preg_match("/[\d|L]\d\d/", $number_name[0], $matches);
		$pokemon_data['number'] = $matches[0];
		$pokemon_data['name'] = ucwords(strtolower(trim($number_name[1])));
		if($pokemon_data['name'] == 'Mr')
			$pokemon_data['name'] = 'Mr. Mime';
	} elseif(substr($line, 0, 12) == 'Hit Points: ') {
		$pokemon_data['hp'] = trim(substr($line, 12));
	} elseif(substr($line, 0, 8) == 'Attack: ') {
		$pokemon_data['atk'] = trim(substr($line, 8));
	} elseif(substr($line, 0, 9) == 'Defense: ') {
		$pokemon_data['def'] = trim(substr($line, 9));
	} elseif(substr($line, 0, 16) == 'Special Attack: ') {
		$pokemon_data['satk'] = trim(substr($line, 16));
	} elseif(substr($line, 0, 17) == 'Special Defense: ') {
		$pokemon_data['sdef'] = trim(substr($line, 17));
	} elseif(substr($line, 0, 7) == 'Speed: ') {
		$pokemon_data['spd'] = trim(substr($line, 7));
	} elseif(substr($line, 0, 7) == 'Type : ') {
		$types = explode(' / ', substr($line, 7));
		$pokemon_data['type1'] = trim($types[0]);
		if(isset($types[1]))
			$pokemon_data['type2'] = trim($types[1]);
	} elseif(substr($line, 0, 17) == 'Basic Abilities: ') {
		$basic_abilities = explode(' / ', trim(substr($line, 17)));
	} elseif(substr($line, 0, 16) == 'High Abilities: ') {
		$high_abilities = explode(' / ', trim(substr($line, 16)));
	} elseif(substr($line, 0, 10) == 'Evolution:') {
		$evolutions = TRUE;
	} elseif($evolutions) {
		$pokemon_evolutions[] = trim($line);
	} elseif(substr($line, 0, 9) == 'Height : ') {
		preg_match('/\(([^\)]*)\)/', $line, $matches);
		$pokemon_data['height'] = $matches[1];
	} elseif(substr($line, 0, 9) == 'Weight : ') {
		preg_match('/\(([^\)]*)\)/', $line, $matches);
		$pokemon_data['weight'] = $matches[1];
	} elseif(substr($line, 0, 15) == 'Gender Ratio : ') {
		$pokemon_data['gender'] = trim(substr($line, 15));
	} elseif(substr($line, 0, 10) == 'Habitat : ') {
		$habitat_data = explode(', ', trim(substr($line, 10)));
	} elseif(substr($line, 0, 18) == 'Capability List - ') {
		$capabilities = explode(', ', substr($line, 18));
		foreach($capabilities as $capability) {
			if(preg_match('/([A-z]*) ([\d]*)/', $capability, $matches) === 1)
				$pokemon_data[$matches[1]] = $matches[2];
			else {
				$capability_data = $db->select('id', 'capability', 1, array('name' => trim($capability)));
				if($capability_data != FALSE)
					$pokemon_capabilities[] = $capability_data['id'];
				else {
					echo "Pokemon: ".$pokemon_data['name']." Capability:";
					var_dump($capability);
					die();
				}
			}
		}
	} elseif(substr($line, 0, 18) == 'Level Up Move List') {
		$level_up_moves_flag = TRUE;
	} elseif(substr($line, 0, 18) == 'TM/HM Move List - ') {
		$level_up_moves_flag = FALSE;
		$tm_hms = explode(', ', substr($line, 18));
		foreach($tm_hms as $tm_hm) {
			$tm_data = $db->select('id', 'TMs_HMs', 1, array('number' => trim($tm_hm)));
			if($tm_data != FALSE)
				$pokemon_tmhm_moves[] = $tm_data['id'];
			else {
				echo "Pokemon: ".$pokemon_data['name']." TM/HM:";
				var_dump($tm_hm);
				die();
			}
		}
	} elseif(substr($line, 0, 16) == 'Egg Move List - ') {
		$level_up_moves_flag = FALSE;
		$egg_moves = explode(', ', substr($line, 16));
		foreach($egg_moves as $egg_move) {
			$egg_move_data = $db->select('id', 'move', 1, array('name' => trim($egg_move)));
			if($egg_move_data != FALSE)
				$pokemon_egg_moves[] = $egg_move_data['id'];
			else {
				echo "Pokemon: ".$pokemon_data['name']." Egg Move:";
				var_dump($egg_move);
				die();
			}
		}
	} elseif(substr($line, 0, 18) == 'Tutor Move List - ') {
		$level_up_moves_flag = FALSE;
		$tutor_moves = explode(', ', substr($line, 18));
		foreach($tutor_moves as $tutor_move) {
			$tutor_move_data = $db->select('id', 'move', 1, array('name' => trim($tutor_move)));
			if($tutor_move_data != FALSE)
				$pokemon_tutor_moves[] = $tutor_move_data['id'];
			else {
				echo "Pokemon: ".$pokemon_data['name']." Tutor Move:";
				var_dump($tutor_move);
				die();
			}
		}
	} elseif(substr($line, 0, 13) == 'Capture Rate:') {
		$level_up_moves_flag = FALSE;
		$pokemon_data['capture_rate'] = trim(substr($line, 14));
	} elseif($level_up_moves_flag) {
		preg_match('/^([\d]*) ([§]*)[ ]*(.*) - /', $line, $matches);
		$move_data = $db->select('id', 'move', 1, array('name' => trim($matches[3])), NULL, NULL, NULL, NULL, NULL, FALSE);
		if($move_data !== FALSE && $move_data['id'] != 0) {
			if($matches[2] != "")
				$pokemon_moves[] = array('level' => $matches[1], 'move_id' => $move_data['id'], 'signature' => 1);
			else
				$pokemon_moves[] = array('level' => $matches[1], 'move_id' => $move_data['id']);
		} else {
			echo "Pokemon: ".$pokemon_data['name']." Move:";
			var_dump($line);
			die();
		}
	} elseif(substr($line, 0, 17) == 'Experience Drop: ') {
		$pokemon_data['exp_drop'] = trim(substr($line, 17));
	}
}
fclose($file_handle);?>