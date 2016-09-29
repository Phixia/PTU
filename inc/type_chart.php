<?php require_once 'classes/loader.php';?>
<table class="typetable">
	<tr>
		<td></td>
		<?php foreach($loader->types as $type) {?>
			<td style="background-color: <?php echo type_to_color($type);?>;" id="type_chart_top_cell_<?php echo $type;?>"><?php if($type == 'Fighting') echo 'Fight'; else echo $type;?></td>
		<?php }
		foreach($loader->weakness_resistance as $type => $info) {?>
			<tr>
				<td style="background-color: <?php echo type_to_color($type);?>;"><?php if($type == 'Fighting') echo 'Fight'; else echo $type;?></td>
				<?php foreach($loader->types as $type_match) {
					echo '<td';
					if(isset($info[$type_match])) {
						if($info[$type_match] == .5)
							echo ' class="weak"';
						elseif($info[$type_match] == 2)
							echo ' class="strong"';
						elseif($info[$type_match] == 0)
							echo ' class="none"';
					}
					echo ' onmouseover="highlightTop(\''.$type_match.'\');">';
					if(isset($info[$type_match])) {
						if($info[$type_match] == .5)
							echo '<img src="'.INC_URL.'imgs/x12.png"/>';
						elseif($info[$type_match] == 2)
							echo '<img src="'.INC_URL.'imgs/x2.png"/>';
						elseif($info[$type_match] == 0)
						echo '<img src="'.INC_URL.'imgs/x0.png"/>';
					}
					echo '</td>';
				}?>
			</tr>
		<?php }?>
</table>

<?php /* OLD METHOD
<table style="border-spacing:0px;" class="typetable">
	<tbody>
		<tr>
			<td style="width:50px;"></td><!--Blank-->
			<td style="background-color:#a8a878;padding:3px;width:24px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">NOR</span></td><!--Normal-->
			<td style="background-color:#f08030;padding:3px;width:24px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">FIR</span></td><!--Fire-->
			<td style="background-color:#6890f0;padding:3px;width:24px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">WAT</span></td><!--Water-->
			<td style="background-color:#f8d030;padding:3px;width:24px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">ELE</span></td><!--Electric-->
			<td style="background-color:#78c850;padding:3px;width:24px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">GRA</span></td><!--Grass-->
			<td style="background-color:#98d8d8;padding:3px;width:24px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">ICE</span></td><!--Ice-->
			<td style="background-color:#c03028;padding:3px;width:24px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">FIG</span></td><!--Fighting-->
			<td style="background-color:#a040a0;padding:3px;width:24px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">POI</span></td><!--Poison-->
			<td style="background-color:#e3C368;padding:3px;width:24px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">GRO</span></td><!--Ground-->
			<td style="background-color:#a890f0;padding:3px;width:24px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">FLY</span></td><!--Flying-->
			<td style="background-color:#f85888;padding:3px;width:24px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">PSY</span></td><!--Psychic-->
			<td style="background-color:#a8b820;padding:3px;width:24px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">BUG</span></td><!--Bug-->
			<td style="background-color:#b8a038;padding:3px;width:24px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">ROC</span></td><!--Rock-->
			<td style="background-color:#705898;padding:3px;width:24px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">GHO</span></td><!--Ghost-->
			<td style="background-color:#7038f8;padding:3px;width:24px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">DRA</span></td><!--Dragon-->
			<td style="background-color:#705848;padding:3px;width:24px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">DAR</span></td><!--Dark-->
			<td style="border-right:1px solid #CCC;background-color:#b8b8d0;padding:3px;width:24px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">STE</span></td><!--Steel-->
		</tr>
		<tr onmouseout="style.backgroundColor='rgba(0,0,0,.7)'" onmouseover="style.backgroundColor='rgba(200,200,200,.7)';" style="background-color: rgba(0,0,0,.7);">
			<td style="background-color:#a8a878;padding:3px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">NORMAL</span></td>
			<td></td><!--Normal-->
			<td></td><!--Fire-->
			<td></td><!--Water-->
			<td></td><!--Electric-->
			<td></td><!--Grass-->
			<td></td><!--Ice-->
			<td></td><!--Fighting-->
			<td></td><!--Poison-->
			<td></td><!--Ground-->
			<td></td><!--Flying-->
			<td></td><!--Psychic-->
			<td></td><!--Bug-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Rock-->
			<td style="text-align:center;background-color:rgb(80,80,80);"><span style="color:#FFF;">0</span></td><!--Ghost-->
			<td></td><!--Dragon-->
			<td></td><!--Dark-->
			<td style="border-right:1px solid #CCC;text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Steel-->
		</tr>
		<tr onmouseout="style.backgroundColor='rgba(0,0,0,.7)'" onmouseover="style.backgroundColor='rgba(200,200,200,.7)';" style="background-color: rgba(0,0,0,.7);">
			<td style="background-color:#f08030;padding:3px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">FIRE</span></td>
			<td></td><!--Normal-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Fire-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Water-->
			<td></td><!--Electric-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Grass-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Ice-->
			<td></td><!--Fighting-->
			<td></td><!--Poison-->
			<td></td><!--Ground-->
			<td></td><!--Flying-->
			<td></td><!--Psychic-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Bug-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Rock-->
			<td></td><!--Ghost-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Dragon-->
			<td></td><!--Dark-->
			<td style="border-right:1px solid #CCC;text-align:center;background-color:rgb(51,204,51);">2</td><!--Steel-->
		</tr>
		<tr onmouseout="style.backgroundColor='rgba(0,0,0,.7)'" onmouseover="style.backgroundColor='rgba(200,200,200,.7)';" style="background-color: rgba(0,0,0,.7);">
			<td style="background-color:#6890f0;padding:3px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">WATER</span></td>
			<td></td><!--Normal-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Fire-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Water-->
			<td></td><!--Electric-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Grass-->
			<td></td><!--Ice-->
			<td></td><!--Fighting-->
			<td></td><!--Poison-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Ground-->
			<td></td><!--Flying-->
			<td></td><!--Psychic-->
			<td></td><!--Bug-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Rock-->
			<td></td><!--Ghost-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Dragon-->
			<td></td><!--Dark-->
			<td style="border-right:1px solid #CCC;"></td><!--Steel-->
		</tr>
		<tr onmouseout="style.backgroundColor='rgba(0,0,0,.7)'" onmouseover="style.backgroundColor='rgba(200,200,200,.7)';" style="background-color: rgba(0,0,0,.7);">
			<td style="background-color:#f8d030;padding:3px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">ELECTRIC</span></td>
			<td></td><!--Normal-->
			<td></td><!--Fire-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Water-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Electric-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Grass-->
			<td></td><!--Ice-->
			<td></td><!--Fighting-->
			<td></td><!--Poison-->
			<td style="text-align:center;background-color:rgb(80,80,80);"><span style="color:#FFF;">0</span></td><!--Ground-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Flying-->
			<td></td><!--Psychic-->
			<td></td><!--Bug-->
			<td></td><!--Rock-->
			<td></td><!--Ghost-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Dragon-->
			<td></td><!--Dark-->
			<td style="border-right:1px solid #CCC;"></td><!--Steel-->
		</tr>
		<tr onmouseout="style.backgroundColor='rgba(0,0,0,.7)'" onmouseover="style.backgroundColor='rgba(200,200,200,.7)';" style="background-color: rgba(0,0,0,.7);">
			<td style="background-color:#78c850;padding:3px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">GRASS</span></td>
			<td></td><!--Normal-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Fire-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Water-->
			<td></td><!--Electric-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Grass-->
			<td></td><!--Ice-->
			<td></td><!--Fighting-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Poison-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Ground-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Flying-->
			<td></td><!--Psychic-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Bug-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Rock-->
			<td></td><!--Ghost-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Dragon-->
			<td></td><!--Dark-->
			<td style="border-right:1px solid #CCC;text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Steel-->
		</tr>
		<tr onmouseout="style.backgroundColor='rgba(0,0,0,.7)'" onmouseover="style.backgroundColor='rgba(200,200,200,.7)';" style="background-color: rgba(0,0,0,.7);">
			<td style="background-color:#98d8d8;padding:3px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">ICE</span></td>
			<td></td><!--Normal-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Fire-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Water-->
			<td></td><!--Electric-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Grass-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Ice-->
			<td></td><!--Fighting-->
			<td></td><!--Poison-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Ground-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Flying-->
			<td></td><!--Psychic-->
			<td></td><!--Bug-->
			<td></td><!--Rock-->
			<td></td><!--Ghost-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Dragon-->
			<td></td><!--Dark-->
			<td style="border-right:1px solid #CCC;text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Steel-->
		</tr>
		<tr onmouseout="style.backgroundColor='rgba(0,0,0,.7)'" onmouseover="style.backgroundColor='rgba(200,200,200,.7)';" style="background-color: rgba(0,0,0,.7);">
			<td style="background-color:#c03028;padding:3px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">FIGHTING</span></td>
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Normal-->
			<td></td><!--Fire-->
			<td></td><!--Water-->
			<td></td><!--Electric-->
			<td></td><!--Grass-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Ice-->
			<td></td><!--Fighting-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Poison-->
			<td></td><!--Ground-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Flying-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Psychic-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Bug-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Rock-->
			<td style="text-align:center;background-color:rgb(80,80,80);"><span style="color:#FFF;">0</span></td><!--Ghost-->
			<td></td><!--Dragon-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Dark-->
			<td style="border-right:1px solid #CCC;text-align:center;background-color:rgb(51,204,51);">2</td><!--Steel-->
		</tr>
		<tr onmouseout="style.backgroundColor='rgba(0,0,0,.7)'" onmouseover="style.backgroundColor='rgba(200,200,200,.7)';" style="background-color: rgba(0,0,0,.7);">
			<td style="background-color:#a040a0;padding:3px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">POISON</span></td>
			<td></td><!--Normal-->
			<td></td><!--Fire-->
			<td></td><!--Water-->
			<td></td><!--Electric-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Grass-->
			<td></td><!--Ice-->
			<td></td><!--Fighting-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Poison-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Ground-->
			<td></td><!--Flying-->
			<td></td><!--Psychic-->
			<td></td><!--Bug-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Rock-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Ghost-->
			<td></td><!--Dragon-->
			<td></td><!--Dark-->
			<td style="border-right:1px solid #CCC;text-align:center;background-color:rgb(80,80,80);"><span style="color:#FFF;">0</span></td><!--Steel-->
		</tr>
		<tr onmouseout="style.backgroundColor='rgba(0,0,0,.7)'" onmouseover="style.backgroundColor='rgba(200,200,200,.7)';" style="background-color: rgba(0,0,0,.7);">
			<td style="background-color:#e3C368;padding:3px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">GROUND</span></td>
			<td></td><!--Normal-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Fire-->
			<td></td><!--Water-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Electric-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Grass-->
			<td></td><!--Ice-->
			<td></td><!--Fighting-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Poison-->
			<td></td><!--Ground-->
			<td style="text-align:center;background-color:rgb(80,80,80);"><span style="color:#FFF;">0</span></td><!--Flying-->
			<td></td><!--Psychic-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Bug-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Rock-->
			<td></td><!--Ghost-->
			<td></td><!--Dragon-->
			<td></td><!--Dark-->
			<td style="border-right:1px solid #CCC;text-align:center;background-color:rgb(51,204,51);">2</td><!--Steel-->
		</tr>
		<tr onmouseout="style.backgroundColor='rgba(0,0,0,.7)'" onmouseover="style.backgroundColor='rgba(200,200,200,.7)';" style="background-color: rgba(0,0,0,.7);">
			<td style="background-color:#a890f0;padding:3px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">FLYING</span></td>
			<td></td><!--Normal-->
			<td></td><!--Fire-->
			<td></td><!--Water-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Electric-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Grass-->
			<td></td><!--Ice-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Fighting-->
			<td></td><!--Poison-->
			<td></td><!--Ground-->
			<td></td><!--Flying-->
			<td></td><!--Psychic-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Bug-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Rock-->
			<td></td><!--Ghost-->
			<td></td><!--Dragon-->
			<td></td><!--Dark-->
			<td style="border-right:1px solid #CCC;text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Steel-->
		</tr>
		<tr onmouseout="style.backgroundColor='rgba(0,0,0,.7)'" onmouseover="style.backgroundColor='rgba(200,200,200,.7)';" style="background-color: rgba(0,0,0,.7);">
			<td style="background-color:#f85888;padding:3px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">PSYCHIC</span></td>
			<td></td><!--Normal-->
			<td></td><!--Fire-->
			<td></td><!--Water-->
			<td></td><!--Electric-->
			<td></td><!--Grass-->
			<td></td><!--Ice-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Fighting-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Poison-->
			<td></td><!--Ground-->
			<td></td><!--Flying-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Psychic-->
			<td></td><!--Bug-->
			<td></td><!--Rock-->
			<td></td><!--Ghost-->
			<td></td><!--Dragon-->
			<td style="text-align:center;background-color:rgb(80,80,80);"><span style="color:#FFF;">0</span></td><!--Dark-->
			<td style="border-right:1px solid #CCC;text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Steel-->
		</tr>
		<tr onmouseout="style.backgroundColor='rgba(0,0,0,.7)'" onmouseover="style.backgroundColor='rgba(200,200,200,.7)';" style="background-color: rgba(0,0,0,.7);">
			<td style="background-color:#a8b820;padding:3px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">BUG</span></td>
			<td></td><!--Normal-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Fire-->
			<td></td><!--Water-->
			<td></td><!--Electric-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Grass-->
			<td></td><!--Ice-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Fighting-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Poison-->
			<td></td><!--Ground-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Flying-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Psychic-->
			<td></td><!--Bug-->
			<td></td><!--Rock-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Ghost-->
			<td></td><!--Dragon-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Dark-->
			<td style="border-right:1px solid #CCC;text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Steel-->
		</tr>
		<tr onmouseout="style.backgroundColor='rgba(0,0,0,.7)'" onmouseover="style.backgroundColor='rgba(200,200,200,.7)';" style="background-color: rgba(0,0,0,.7);">
			<td style="background-color:#b8a038;padding:3px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">ROCK</span></td>
			<td></td><!--Normal-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Fire-->
			<td></td><!--Water-->
			<td></td><!--Electric-->
			<td></td><!--Grass-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Ice-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Fighting-->
			<td></td><!--Poison-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Ground-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Flying-->
			<td></td><!--Psychic-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Bug-->
			<td></td><!--Rock-->
			<td></td><!--Ghost-->
			<td></td><!--Dragon-->
			<td></td><!--Dark-->
			<td style="border-right:1px solid #CCC;text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Steel-->
		</tr>
		<tr onmouseout="style.backgroundColor='rgba(0,0,0,.7)'" onmouseover="style.backgroundColor='rgba(200,200,200,.7)';" style="background-color: rgba(0,0,0,.7);">
			<td style="background-color:#705898;padding:3px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">GHOST</span></td>
			<td style="text-align:center;background-color:rgb(80,80,80);"><span style="color:#FFF;">0</span></td><!--Normal-->
			<td></td><!--Fire-->
			<td></td><!--Water-->
			<td></td><!--Electric-->
			<td></td><!--Grass-->
			<td></td><!--Ice-->
			<td></td><!--Fighting-->
			<td></td><!--Poison-->
			<td></td><!--Ground-->
			<td></td><!--Flying-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Psychic-->
			<td></td><!--Bug-->
			<td></td><!--Rock-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Ghost-->
			<td></td><!--Dragon-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Dark-->
			<td style="border-right:1px solid #CCC;text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Steel-->
		</tr>
		<tr onmouseout="style.backgroundColor='rgba(0,0,0,.7)'" onmouseover="style.backgroundColor='rgba(200,200,200,.7)';" style="background-color: rgba(0,0,0,.7);">
			<td style="background-color:#7038f8;padding:3px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">DRAGON</span></td>
			<td></td><!--Normal-->
			<td></td><!--Fire-->
			<td></td><!--Water-->
			<td></td><!--Electric-->
			<td></td><!--Grass-->
			<td></td><!--Ice-->
			<td></td><!--Fighting-->
			<td></td><!--Poison-->
			<td></td><!--Ground-->
			<td></td><!--Flying-->
			<td></td><!--Psychic-->
			<td></td><!--Bug-->
			<td></td><!--Rock-->
			<td></td><!--Ghost-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Dragon-->
			<td></td><!--Dark-->
			<td style="border-right:1px solid #CCC;text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Steel-->
		</tr>
		<tr onmouseout="style.backgroundColor='rgba(0,0,0,.7)'" onmouseover="style.backgroundColor='rgba(200,200,200,.7)';" style="background-color: rgba(0,0,0,.7);">
			<td style="background-color:#705848;padding:3px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">DARK</span></td>
			<td></td><!--Normal-->
			<td></td><!--Fire-->
			<td></td><!--Water-->
			<td></td><!--Electric-->
			<td></td><!--Grass-->
			<td></td><!--Ice-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Fighting-->
			<td></td><!--Poison-->
			<td></td><!--Ground-->
			<td></td><!--Flying-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Psychic-->
			<td></td><!--Bug-->
			<td></td><!--Rock-->
			<td style="text-align:center;background-color:rgb(51,204,51);">2</td><!--Ghost-->
			<td></td><!--Dragon-->
			<td style="text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Dark-->
			<td style="border-right:1px solid #CCC;text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Steel-->
		</tr>
		<tr onmouseout="style.backgroundColor='rgba(0,0,0,.7)'" onmouseover="style.backgroundColor='rgba(200,200,200,.7)';" style="background-color: rgba(0,0,0,.7);">
			<td style="border-bottom:1px solid #CCC;background-color:#b8b8d0;padding:3px;text-align:center;"><span style="font-size:10px;color:#FFF;text-shadow: #333 1px 1px;">STEEL</span></td>
			<td style="border-bottom:1px solid #CCC;"></td><!--Normal-->
			<td style="border-bottom:1px solid #CCC;text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Fire-->
			<td style="border-bottom:1px solid #CCC;text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Water-->
			<td style="border-bottom:1px solid #CCC;text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Electric-->
			<td style="border-bottom:1px solid #CCC;"></td><!--Grass-->
			<td style="border-bottom:1px solid #CCC;text-align:center;background-color:rgb(51,204,51);">2</td><!--Ice-->
			<td style="border-bottom:1px solid #CCC;"></td><!--Fighting-->
			<td style="border-bottom:1px solid #CCC;"></td><!--Poison-->
			<td style="border-bottom:1px solid #CCC;"></td><!--Ground-->
			<td style="border-bottom:1px solid #CCC;"></td><!--Flying-->
			<td style="border-bottom:1px solid #CCC;"></td><!--Psychic-->
			<td style="border-bottom:1px solid #CCC;"></td><!--Bug-->
			<td style="border-bottom:1px solid #CCC;text-align:center;background-color:rgb(51,204,51);">2</td><!--Rock-->
			<td style="border-bottom:1px solid #CCC;"></td><!--Ghost-->
			<td style="border-bottom:1px solid #CCC;"></td><!--Dragon-->
			<td style="border-bottom:1px solid #CCC;"></td><!--Dark-->
			<td style="border-bottom:1px solid #CCC;text-align:center;background-color:rgb(204,51,51);">&frac12;</td><!--Steel-->
		</tr>
	</tbody>
</table>*/?>