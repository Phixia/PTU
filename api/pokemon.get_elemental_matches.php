<?php require_once 'classes/loader.php';
if(isset($_POST['type1']) && isset($_POST['pokemonIndex'])) {?>
	<table class="elemental_matches">
		<?php foreach($loader->types as $type) {
			$multiplier = 1;
			if(isset($loader->weakness_resistance[$type][$_POST['type1']]))
				$multiplier = $multiplier * $loader->weakness_resistance[$type][$_POST['type1']];
			if(isset($_POST['type2']) && $_POST['type2'] != '' && isset($loader->weakness_resistance[$type][$_POST['type2']]))
				$multiplier = $multiplier * $loader->weakness_resistance[$type][$_POST['type2']];?>
			<tr onclick="setMultiplier(<?php echo $_POST['pokemonIndex'].','.$multiplier;?>);">
				<td style="background-color: <?php echo type_to_color($type, TRUE);?>;"><?php echo $type;?></td>
				<td>
					<?php if($multiplier == .25)
						echo '&frac14;';
					elseif($multiplier == .5)
						echo '&frac12;';
					else
						echo $multiplier;?>
				</td>
			</tr>
		<?php }?>
	</table>
<?php }?>