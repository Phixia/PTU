<?php
class pta_pokemon extends pta_db_class {
	public $total_hp;
	public $level;
	public $min_level;
	public $nature;
	public $stats;
	public $shiny;
	public $capabilities;
	public $basic_ability;
	public $high_ability = NULL;
	public $mega_ability = NULL;
	public $moves;
	public $tmhm_moves;
	public $tutor_moves;
	public $egg_moves;
	public $current_capture;
	
	public function __construct($id = NULL, $level = NULL, $number = NULL, $name = NULL) {
		global $db;
		
		if($number != NULL) {
			$data = $db->select('id', 'pokemon', 1, array('number' => $number));
			parent::__construct($data['id']);
		} elseif($name != NULL) {
			$data = $db->select('id', 'pokemon', 1, array('name' => $name));
			parent::__construct($data['id']);
		} else {
			parent::__construct($id);
		}
		
		//Find minimum level required for this evolution. And if current level is not provided, set to the minimum level for evolution.
		$level_data = $db->select('level', 'pokemon_evolutions', 1, array('pokemon_id' => $this->id, 'evolution' => $this->id));
		$this->min_level = $level_data['level'];
		if(isset($level) && $level != NULL)
			$this->level = $level;
		else
			$this->level = $this->min_level;
		
		//Chance of being shiny
		$this->shiny = FALSE;
		if(rand(0, 1000) == 1000)
			$this->shiny = TRUE;
		
		//Determine Pokemon's Nature
		$this->nature = new pta_nature(rand(1, 35));
		if($this->nature->raise != NULL) {
			if($this->nature->raise == 'hp')
				$this->hp += 1;
			else
				$this->{$this->nature->raise} += 2;
		}
		if($this->nature->lower != NULL) {
			if($this->nature->lower == 'hp')
				$this->hp -= 1;
			else
				$this->{$this->nature->lower} -= 2;
		}
		
		//Determine the stats for this pokemon at it's current level
		$this->stats = array(
			'hp' => $this->hp,
			'atk' => $this->atk,
			'def' => $this->def,
			'satk' => $this->satk,
			'sdef' => $this->sdef,
			'spd' => $this->spd
		);
		arsort($this->stats);
		$stat_keys = array_keys($this->stats);
		
		//First 4 levels add to highest stat, next 3 levels add to second
		//highest stat, next 2 levels add to third highest stat, then
		//next 3 levels add one to every other stat.
		$j = 0;
		for($i = 1; $i < $this->level; $i++) {
			if($j <= 3)
				$this->stats[$stat_keys[0]]++;
			elseif($j > 3 && $j <= 6)
				$this->stats[$stat_keys[1]]++;
			elseif($j > 6 && $j <= 8)
				$this->stats[$stat_keys[2]]++;
			elseif($j == 9)
				$this->stats[$stat_keys[3]]++;
			elseif($j == 10)
				$this->stats[$stat_keys[4]]++;
			elseif($j == 11)
				$this->stats[$stat_keys[5]]++;
			
			$j++;
			if($j > 11)
				$j = 0;
		}
		
		//OLD
		//Determine the stats for this pokemon at it's current level
// 		$this->stats = array(
// 			'hp' => $this->hp + floor(($this->level - 1) / 6),
// 			'atk' => $this->atk + floor(($this->level - 1) / 6),
// 			'def' => $this->def + floor(($this->level - 1) / 6),
// 			'satk' => $this->satk + floor(($this->level - 1) / 6),
// 			'sdef' => $this->sdef + floor(($this->level - 1) / 6),
// 			'spd' => $this->spd + floor(($this->level - 1) / 6)
// 		);
// 		arsort($this->stats);
// 		$count = 0;
// 		foreach($this->stats as $stat => $value) {
// 			if($count < ($this->level - 1) % 6) {
// 				$this->stats[$stat]++;
// 				$count++;
// 			} else
// 				break;
// 		}
		
		//Calculate total HP
		$this->total_hp = ($this->stats['hp'] * 3) + $this->level;
		
		//Get Pokemon's capabilities
		$capability_data = $db->select('capability.name, capability.description', 'capability, pokemon_capabilities', NULL, NULL, "pokemon_capabilities.pokemon_id = ".mysqli_real_escape_string($db->connection, $this->id)." AND pokemon_capabilities.capability_id = capability.id");
		foreach($capability_data as $capability) {
			$this->capabilities[$capability['name']] = $capability['description'];
		}
		
		//Determine this pokemon's abilit(y|ies)
		$basic_abilities_data = $db->select('ability.*', 'pokemon_abilities', NULL, array('pokemon_abilities.pokemon_id' => $this->id, 'pokemon_abilities.level' => 'basic'), NULL, NULL, "ORAS_ability` AS `ability", "ability.id = pokemon_abilities.ability_id", "ability`.`id");
		if($basic_abilities_data != NULL)
			$this->basic_ability = new pta_ability(NULL, $basic_abilities_data[rand(0, count($basic_abilities_data)-1)]);
		if($this->level >= 40) {
			$high_abilities_data = $db->select('ability.*', 'pokemon_abilities', NULL, array('pokemon_abilities.pokemon_id' => $this->id, 'pokemon_abilities.level' => 'high'), NULL, NULL, "ORAS_ability` AS `ability", "ability.id = pokemon_abilities.ability_id", "ability`.`id");
			if($high_abilities_data != NULL)
				$this->high_ability = new pta_ability(NULL, $high_abilities_data[rand(0, count($high_abilities_data)-1)]);
		}
		$mega_ability_data = $db->select('ability.*', 'pokemon_abilities', 1, array('pokemon_abilities.pokemon_id' => $this->id, 'pokemon_abilities.level' => 'mega'), NULL, NULL, "ORAS_ability` AS `ability", "ability.id = pokemon_abilities.ability_id", "ability`.`id");
		if($mega_ability_data != FALSE && $mega_ability_data['id'] != 0)
			$this->mega_ability = new pta_ability(NULL, $mega_ability_data);
		
		//Generate the move list for this pokemon.
		$evolutions = $db->select('*', 'pokemon_evolutions', NULL, NULL, 'pokemon_id = '.mysqli_real_escape_string($db->connection,$this->id).' AND stage <= '.mysqli_real_escape_string($db->connection,$this->stage), array('stage', 'DESC'));
		$where = '';
		$max_level = $this->level;
		if($evolutions != FALSE) {
			foreach($evolutions as $evolution) {
				if($where != '')
					$where .= ' OR ';
				$where .= '(pokemon_moves.pokemon_id = '.mysqli_real_escape_string($db->connection,$evolution['evolution']).' AND level >= '.mysqli_real_escape_string($db->connection,$evolution['level']).' AND level <= '.mysqli_real_escape_string($db->connection,$max_level).')';
				if($evolution['level'] < $this->level)
					$max_level = $evolution['level'];
			}
		} else {
			$where = 'pokemon_moves.pokemon_id = '.mysqli_real_escape_string($db->connection,$this->id).' AND level <= '.mysqli_real_escape_string($db->connection,$max_level);
		}
		//$move_data = $db->select('move_id AS id, MAX(`level`) AS level', 'pokemon_moves', NULL, NULL, $where, array('level', 'ASC'), NULL, NULL, "move_id", FALSE);
		$move_data = $db->select('`move`.*, MAX(`pokemon_moves`.`level`) AS level', 'move', NULL, NULL, $where, array('level', 'ASC'), 'ORAS_pokemon_moves` AS `pokemon_moves', "move.id = pokemon_moves.move_id", "move`.`id", FALSE);
		if($move_data != FALSE) {
			foreach($move_data as $move) {
				$this->moves[] = new pta_move(NULL, $move);
			}
		}
		
		//Get TM/HM moves
		$tmhm_move_data = $db->select('`move`.*', 'pokemon_tms_hms,TMs_HMs,move', NULL, NULL, 'TMs_HMs.move_id = move.id AND pokemon_tms_hms.tm_hm_id = TMs_HMs.id AND pokemon_tms_hms.pokemon_id = '.mysqli_real_escape_string($db->connection, $this->id), array('move.name', 'ASC'), NULL, NULL, "move`.`id", FALSE);
		if($tmhm_move_data != FALSE) {
			foreach($tmhm_move_data as $move) {
				$this->tmhm_moves[] = new pta_move(NULL, $move);
			}
		}
		
		//Get Tutor moves
		$tutor_move_data = $db->select('move.*', 'pokemon_tutor_moves, move', NULL, NULL, 'pokemon_tutor_moves.move_id = move.id AND pokemon_tutor_moves.pokemon_id = '.mysqli_real_escape_string($db->connection, $this->id), array('move.name', 'ASC'), NULL, NULL, "move`.`id", FALSE);
		if($tutor_move_data != FALSE) {
			foreach($tutor_move_data as $move) {
				$this->tutor_moves[] = new pta_move(NULL, $move);
			}
		}
		
		//Get Egg moves
		if($evolutions != FALSE) {
			$where = 'pokemon_egg_moves.move_id = move.id AND pokemon_egg_moves.pokemon_id IN (';
			foreach($evolutions as $i => $evolution) {
				if($i != 0)
					$where .= ',';
				$where .= $evolution['evolution'];
			}
			$where .= ')';
		}
		$egg_move_data = $db->select('move.*', 'pokemon_egg_moves, move', NULL, NULL, $where, array('move.name', 'ASC'), NULL, NULL, "move`.`id");
		if($egg_move_data != FALSE) {
			foreach($egg_move_data as $move) {
				$this->egg_moves[] = new pta_move(NULL, $move);
			}
		}
		
		$this->current_capture = $this->capture_rate;
		if($this->level <=20)
			$this->current_capture += 20;
		elseif($this->level <= 40)
			$this->current_capture += 10;
		elseif($this->level <= 60)
			$this->current_capture -= 5;
		elseif($this->level <= 80)
			$this->current_capture -= 15;
		else
			$this->current_capture -= 30;
	}
}