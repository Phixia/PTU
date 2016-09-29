<?php require_once 'classes/loader.php';
$file_handle = fopen("ORAS_Moves.txt", "r");
$info = 0;
while (!feof($file_handle)) {
	$line = fgets($file_handle);
	if($line != "\n") {
		switch($info) {
			case 0:
				if(substr($line, 0, 1) == '*') {
					if(isset($move_data['effect2']))
						$move_data['effect2'] .= '<br/>'.trim(substr($line, 1));
					else
						$move_data['effect2'] = trim(substr($line, 1));
				} else {
					if(isset($move_data)) {
						$db->insert('ORAS_move', $move_data);
						unset($move_data);
					}
					$name_type = explode(' - ', $line);
					$move_data['name'] = trim($name_type[0]);
					$move_data['type'] = trim($name_type[1]);
					$info++;
				}
				break;
			case 1:
				$dmg_rate_acc = explode(' - ', $line);
				if(count($dmg_rate_acc) == 2) {
					$move_data['rate'] = trim($dmg_rate_acc[0]);
					$move_data['accuracy'] = trim($dmg_rate_acc[1]);
				} else {
					$move_data['damage'] = trim($dmg_rate_acc[0]);
					$move_data['rate'] = trim($dmg_rate_acc[1]);
					$move_data['accuracy'] = trim($dmg_rate_acc[2]);
				}
				$info++;
				break;
			case 2:
				$stat_range = explode(' - ', $line);
				if($stat_range[0] == 'Attack')
					$move_data['stat'] = 'ATK';
				elseif($stat_range[0] == 'Special Attack')
					$move_data['stat'] = 'SATK';
				if(isset($stat_range[1]))
					$move_data['range'] = trim($stat_range[1]);
				else
					$move_data['range'] = 'See Effect';
				$info++;
				break;
			case 3:
				if(substr($line, 0, 8) == 'Effect: ')
					$move_data['effect1'] = trim(substr($line, 8));
				else
					$move_data['effect1'] = trim($line);
				$info++;
				break;
			case 4:
				if(substr($line, 0, 9) != 'Beauty - ' && substr($line, 0, 7) != 'Cool - ' && substr($line, 0, 7) != 'Cute - ' && substr($line, 0, 8) != 'Smart - ' && substr($line, 0, 8) != 'Tough - ') {
					if(!isset($move_data['effect2']))
						$move_data['effect2'] = trim($line);
					else
						$move_data['effect2'] .= ' '.trim($line);
				} else {
					$move_data['contest'] = trim($line);
					$info = 0;
				}
				break;
		}
	}
}
fclose($file_handle);?>