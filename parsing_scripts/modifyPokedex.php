<?php ini_set('max_execution_time', 3600);

$file_handle = fopen("ORAS_Pokedex.txt", "r");
$file_out = fopen("ORAS_Modified_Pokedex.txt", "w");

$buffering = FALSE;

while (!feof($file_handle)) {
	$line = fgets($file_handle);
	
	if(!$buffering && ($line == "Capability List -\n" || $line == "TM/HM Move List -\n" || $line == "Egg Move List -\n" || $line == "Tutor Move List -\n")) {
		$buffering = TRUE;
		$buffer = str_replace("\n", "", $line);
	} elseif($buffering) {
		if($line == "Move Lists -\n" || substr($line, 0, 13) == "Capture Rate:") {
			$buffering = FALSE;
			fwrite($file_out, $buffer."\n");
		} elseif($line == "Egg Move List -\n" || $line == "Tutor Move List -\n") {
			fwrite($file_out, $buffer."\n");
			$buffer = str_replace("\n", "", $line);
		} else {
			$buffer .= ' '.str_replace("\n", "", $line);
		}
	}
	
	if(!$buffering)
		fwrite($file_out, $line);
}

fclose($file_handle);
fclose($file_out);