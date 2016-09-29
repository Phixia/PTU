<?php require_once 'classes/loader.php';
$file_handle = fopen("ORAS_Abilities.txt", "r");
$effect = FALSE;
while (!feof($file_handle)) {
	$line = fgets($file_handle);
	if($line != "\n"){
		if(substr($line, 0, 4) == 'Cast' || substr($line, 0, 6) == 'Static' || substr($line, 0, 7) == 'Trigger') {
			$effect = FALSE;
			if(isset($ability_data)) {
				$db->insert('ORAS_ability', $ability_data);
				unset($ability_data);
			}
			$ability_data['name'] = $previous_line;
			if(strpos($line, ' - ') !== FALSE)
				$act_lim = explode(' - ', $line);
			elseif(strpos($line, ' � ') !== FALSE)
				$act_lim = explode(' � ', $line);
			else
				$act_lim = array(0 => $line);
			$ability_data['activation'] = trim($act_lim[0]);
			if(isset($act_lim[1]))
				$ability_data['limit'] = trim($act_lim[1]);
		} elseif(substr($line, 0, 9) == 'Keyword: ') {
			$ability_data['keyword'] = trim(substr($line, 9));
		} elseif(substr($line, 0, 8) == 'Effect: ') {
			$effect = TRUE;
			$previous_line = trim(substr($line, 8));
		} elseif($effect) {
			if(isset($ability_data['effect']))
				$ability_data['effect'] .= ' '.$previous_line;
			else
				$ability_data['effect'] = $previous_line;
			$previous_line = trim($line);
		} else {
			$previous_line = trim($line);
		}
	}
}
fclose($file_handle);?>