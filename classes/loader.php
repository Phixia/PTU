<?php
require_once('config.php');
require_once('functions.php');

function __autoload($class) {
    $class_break = explode("_", $class);
    if($class_break['0'] == CLASS_PREFIX) require_once 'classes/'.substr($class, strlen(CLASS_PREFIX) + 1). '.php';
    else require_once $class. '.php';
}

class pta_loader {
  var $url = "https://";
  var $urls = array(
  	'home'			=>	'index.php',
  	'pokemon'		=>	'pokemon.php',
  	'trainers'	=>	'trainers.php'
  );
  var $types = array('Normal','Fighting','Flying','Poison','Ground','Rock','Bug','Ghost','Steel','Fire','Water','Grass','Electric','Psychic','Ice','Dragon','Dark','Fairy');
  var $weakness_resistance = array(
  	'Normal' => array('Rock' => .5, 'Ghost' => 0, 'Steel' => .5),
  	'Fighting' => array('Normal' => 2, 'Flying' => .5, 'Poison' => .5, 'Rock' => 2, 'Bug' => .5, 'Ghost' => 0, 'Steel' => 2, 'Psychic' => .5, 'Ice' => 2, 'Dark' => 2, 'Fairy' => .5),
  	'Flying' => array('Fighting' => 2, 'Rock' => .5, 'Bug' => 2, 'Steel' => .5, 'Grass' => 2, 'Electric' => .5),
  	'Poison' => array('Poison' => .5, 'Ground' => .5, 'Rock' => .5, 'Ghost' => .5, 'Steel' => 0, 'Grass' => 2, 'Fairy' => 2),
		'Ground' => array('Flying' => 0, 'Poison' => 2, 'Rock' => 2, 'Bug' => .5, 'Steel' => 2, 'Fire' => 2, 'Grass' => .5, 'Electric' => 2),
		'Rock' => array('Fighting' => .5, 'Flying' => 2, 'Ground' => .5, 'Bug' => 2, 'Steel' => .5, 'Fire' => 2, 'Ice' => 2),
		'Bug' => array('Fighting' => .5, 'Flying' => .5, 'Poison' => .5, 'Ghost' => .5, 'Steel' => .5, 'Fire' => .5, 'Grass' => 2, 'Psychic' => 2, 'Dark' => 2, 'Fairy' => .5),
		'Ghost' => array('Normal' => 0, 'Ghost' => 2, 'Psychic' => 2, 'Dark' => .5),
		'Steel' => array('Rock' => 2, 'Steel' => .5, 'Fire' => .5, 'Water' => .5, 'Electric' => .5, 'Ice' => 2, 'Fairy' => 2),
		'Fire' => array('Rock' => .5, 'Bug' => 2, 'Steel' => 2, 'Fire' => .5, 'Water' => .5, 'Grass' => 2, 'Ice' => 2, 'Dragon' => .5),
		'Water' => array('Ground' => 2, 'Rock' => 2, 'Fire' => 2, 'Water' => .5, 'Grass' => .5, 'Dragon' => .5),
		'Grass' => array('Flying' => .5, 'Poison' => .5, 'Ground' => 2, 'Rock' => 2, 'Bug' => .5, 'Steel' => .5, 'Fire' => .5, 'Water' => 2, 'Grass' => .5, 'Dragon' => .5),
		'Electric' => array('Flying' => 2, 'Ground' => 0, 'Water' => 2, 'Grass' => .5, 'Electric' => .5, 'Dragon' => .5),
		'Psychic' => array('Fighting' => 2, 'Poison' => 2, 'Steel' => .5, 'Psychic' => .5, 'Dark' => 0),
		'Ice' => array('Flying' => 2, 'Ground' => 2, 'Steel' => .5, 'Fire' => .5, 'Water' => .5, 'Grass' => 2, 'Ice' => .5, 'Dragon' => 2),
		'Dragon' => array('Steel' => .5, 'Dragon' => 2, 'Fairy' => 0),
		'Dark' => array('Fighting' => .5, 'Ghost' => 2, 'Psychic' => 2, 'Dark' => .5, 'Fairy' => .5),
		'Fairy' => array('Fighting' => 2, 'Poison' => .5, 'Steel' => .5, 'Fire' => .5, 'Dragon' => 2, 'Dark' =>2)
  );
  
	function url($name) {
		return $this->url.$this->urls[$name];
	}

	function am_i_here($where) {
	  if($this->url.$this->urls[$where] == $this->url.substr($_SERVER['PHP_SELF'], 1) || $this->url.$this->urls[$where] == $this->url.substr($_SERVER['PHP_SELF'], 1, -4)) return TRUE;
	  else return FALSE;
	}
}

$loader = new pta_loader();
$db = new pta_database();

global $db;

$loader->url .= $_SERVER['HTTP_HOST'].SUBFOLDER;
define('ROOT_URL', $loader->url);
define('INC_URL', $loader->url."inc/");?>