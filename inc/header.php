<?php
$number = rand(1, 45);
if($number < 10)
	$number = '0'.$number;?>
<!DOCTYPE html>
<html class="<?php if(isset($_SERVER['HTTP_USER_AGENT'])) { $browser = get_browser(); echo $browser->browser; }?>">
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="A Pokemon generator for the Pokemon Tabletop Adventures role playing game. Great random encounter generator for GMs."/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<?php if(isset($nocache) && $nocache == TRUE) {?><meta http-equiv="Pragma" content="no-cache"/><meta http-equiv="Expires" content="-1"/><?php }?>
		<link rel="author" href="https://plus.google.com/104177809008821132225"/>
		<link rel="stylesheet" href="<?php echo ROOT_URL; ?>inc/css/main.css" type="text/css"/>
		<?php if(isset($required_css)) {
			foreach($required_css as $css) {?>
				<link rel="stylesheet" href="<?php echo ROOT_URL.'inc/css/'.$css.'.css';?>" type="text/css"/>
			<?php }
		}?>
		<script type="text/javascript" src="<?php echo ROOT_URL; ?>inc/js/mootools.js"></script>
		<script type="text/javascript" src="<?php echo ROOT_URL; ?>inc/js/moo-more.js"></script>
		<script type="text/javascript" src="<?php echo ROOT_URL; ?>inc/js/main.js"></script>
		<?php if(isset($required_js)) {
			foreach($required_js as $js) {?>
				<script type="text/javascript" src="<?php echo ROOT_URL.'inc/js/'.$js.'.js';?>"></script>
			<?php }
		}
		if(isset($title) && $title != '') {?>
			<title><?php echo $title;?></title>
		<?php } else {?>
			<title>Pokemon Tabletop Adventures | Pokemon Generator</title>
		<?php }?>
	</head>
	<body style="background: #000000 url('/inc/imgs/backgrounds/background_<?php echo $number;?>.jpg') top right no-repeat fixed; background-size: contain;">
		<div id="header" class="black_transparent">
			<a href="/"><img src="/inc/imgs/logo.jpg" alt="Pokemon Tabletop Adventures"/></a>
			<div id="disclaimer" title="I couldn't find any information on current copyrights for the images used for backgrounds. I guess I'll just wait until I get a cease and desist...">
				All content on this site is licensed under <a href="http://creativecommons.org/licenses/by-sa/3.0/" target="_blank">Creative Commons Attribution-ShareAlike 3.0 License</a><br/>
				If you feel like throwing a buck my way to help offset the cost of hosting this site, please feel free to click the PayPal link below.
			</div>
			<div id="main_nav">
				<div class="first_nav nav_element<?php if($loader->am_i_here('home')) echo ' selected';?>" onclick="window.location.href = '/<?php echo $loader->urls['home'];?>';">Generate</div>
				<div class="nav_element<?php if($loader->am_i_here('pokemon')) echo ' selected';?>" onclick="window.location.href = '/<?php echo $loader->urls['pokemon'];?>';">Pokemon</div>
				<div class="nav_element<?php if($loader->am_i_here('trainers')) echo ' selected';?>" onclick="window.location.href = '/<?php echo $loader->urls['trainers'];?>';">Trainers</div>
				<div class="chart_container">
					<div class="nav_element">Type Chart</div>
					<div class="clear"></div>
					<?php include_once 'inc/type_chart.php';?>
				</div>
				<?php if($loader->am_i_here('pokemon')) {?>
					<div class="exp_container">
						<div class="nav_element">Experience</div>
						<div class="clear"></div>
						<table class="exp_table">
							<thead id="exp_table">
								<tr>
									<th>Defeated?</th><th>Pokemon</th><th>Exp</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan="2">Trainer Battle?<input type="checkbox" id="trainer_battle" onchange="updateExp();"/></td><td class="total_exp">Total: <span id="total_exp"></span></td>
								</tr>
							</tbody>
						</table>
					</div>
				<?php }?>
				<div class="clear"></div>
			</div>
			<div id="paypal_button">
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		<div id="site" class="<?php if($loader->am_i_here('home')) echo 'black_transparent';?>">