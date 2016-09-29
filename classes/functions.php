<?php
function genRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';    

    for ($p = 0; $p < $length; $p++) {
$string .= $characters[mt_rand(0, strlen($characters) -1)];
    }

    return $string;
}
function number_to_place($num) {
	if($num > 10 && (substr($num, -2) == 11 || substr($num, -2) == 12 || substr($num, -2) == 13))
		return $num.'th';
	elseif(substr($num, -1) == 1)
		return $num.'st';
	elseif(substr($num, -1) == 2)
		return $num.'nd';
	elseif(substr($num, -1) == 3)
		return $num.'rd';
	else
		return $num.'th';
}
function romanic_number($integer, $upcase = true)
{
	$table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1);
	$return = '';
	while($integer > 0)
	{
		foreach($table as $rom=>$arb)
		{
			if($integer >= $arb)
			{
				$integer -= $arb;
				$return .= $rom;
				break;
			}
		}
	}

	return $return;
}
function type_to_color($type, $transparent = FALSE) {
	if($type == 'Normal') {
		if($transparent)
			$color = 'rgba(168,168,120,0.85)';
		else
			$color = 'rgb(168,168,120)';
	} elseif($type == 'Fire') {
		if($transparent)
			$color = 'rgba(240,128,48,0.85)';
		else
			$color = 'rgb(240,128,48)';
	} elseif($type == 'Water') {
		if($transparent)
			$color = 'rgba(104,144,240,0.85)';
		else
			$color = 'rgb(104,144,240)';
	} elseif($type == 'Electric') {
		if($transparent)
			$color = 'rgba(248,208,48,0.85)';
		else
			$color = 'rgb(248,208,48)';
	} elseif($type == 'Grass') {
		if($transparent)
			$color = 'rgba(120,200,80,0.85)';
		else
			$color = 'rgb(120,200,80)';
	} elseif($type == 'Ice') {
		if($transparent)
			$color = 'rgba(152,216,216,0.85)';
		else
			$color = 'rgb(152,216,216)';
	} elseif($type == 'Fighting') {
		if($transparent)
			$color = 'rgba(192,48,40,0.85)';
		else
			$color = 'rgb(192,48,40)';
	} elseif($type == 'Poison') {
		if($transparent)
			$color = 'rgba(160,64,160,0.85)';
		else
			$color = 'rgb(160,64,160)';
	} elseif($type == 'Ground') {
		if($transparent)
			$color = 'rgba(227,195,104,0.85)';
		else
			$color = 'rgb(227,195,104)';
	} elseif($type == 'Flying') {
		if($transparent)
			$color = 'rgba(168,144,240,0.85)';
		else
			$color = 'rgb(168,144,240)';
	} elseif($type == 'Psychic') {
		if($transparent)
			$color = 'rgba(248,88,136,0.85)';
		else
			$color = 'rgb(248,88,136)';
	} elseif($type == 'Bug') {
		if($transparent)
			$color = 'rgba(168,184,32,0.85)';
		else
			$color = 'rgb(168,184,32)';
	} elseif($type == 'Rock') {
		if($transparent)
			$color = 'rgba(184,160,56,0.85)';
		else
			$color = 'rgb(184,160,56)';
	} elseif($type == 'Ghost') {
		if($transparent)
			$color = 'rgba(112,88,152,0.85)';
		else
			$color = 'rgb(112,88,152)';
	} elseif($type == 'Dragon') {
		if($transparent)
			$color = 'rgba(112,56,248,0.85)';
		else
			$color = 'rgb(112,56,248)';
	} elseif($type == 'Dark') {
		if($transparent)
			$color = 'rgba(112,88,72,0.85)';
		else
			$color = 'rgb(112,88,72)';
	} elseif($type == 'Steel') {
		if($transparent)
			$color = 'rgba(184,184,208,0.85)';
		else
			$color = 'rgb(184,184,208)';
	} elseif($type == 'Fairy') {
		if($transparent)
			$color = 'rgba(235,111,198,0.85)';
		else
			$color = 'rgb(235,111,198)';
	} else {
		if($transparent)
			$color = 'rgba(0,0,0,0.85)';
		else
			$color = 'rgb(0,0,0)';
	}
	return $color;
}
function generate_rarity_sql($from, $to) {
	if($from == $to) {
		switch($to) {
			case 0:
				return ' AND pokemon.capture_rate >= 30';
				break;
			case 1:
				return ' AND pokemon.capture_rate = 25';
				break;
			case 2:
				return ' AND (pokemon.capture_rate = 15 OR pokemon.capture_rate = 20)';
				break;
			case 3:
				return ' AND pokemon.capture_rate = 10';
				break;
			case 4:
				return ' AND pokemon.capture_rate <= 5';
				break;
		}
	} elseif($from == 0) {
		switch($to) {
			case 1:
				return ' AND pokemon.capture_rate >= 25';
				break;
			case 2:
				return ' AND pokemon.capture_rate >= 15';
				break;
			case 3:
				return ' AND pokemon.capture_rate >= 10';
				break;
		}
	} elseif($from == 1) {
		switch($to) {
			case 2:
				return ' AND pokemon.capture_rate <= 25 AND pokemon.capture_rate >= 15';
				break;
			case 3:
				return ' AND pokemon.capture_rate <= 25 AND pokemon.capture_rate >= 10';
				break;
			case 4:
				return ' AND pokemon.capture_rate <= 25';
				break;
		}
	} elseif($from == 2) {
		switch($to) {
			case 3:
				return ' AND pokemon.capture_rate <= 20 AND pokemon.capture_rate >= 10';
				break;
			case 4:
				return ' AND pokemon.capture_rate <= 20';
				break;
		}
	} elseif($from == 3) {
			return ' AND pokemon.capture_rate <= 10';
	}
}