<?php require_once 'classes/loader.php';

if(isset($_POST['order']) && $_POST['order'] == 'number')
	$order = array('pokemon.number', 'ASC');
else
	$order = array('pokemon.name', 'ASC');
if(isset($_POST['habitat']) && $_POST['habitat'] != '') {
	$pokemon_data = $db->select('DISTINCT(pokemon.id) AS id, pokemon.number, pokemon.name', 'pokemon, pokemon_habitats', NULL, NULL, 'pokemon.id = pokemon_habitats.pokemon_id AND pokemon_habitats.habitat_id = '.mysqli_real_escape_string($db->connection, $_POST['habitat']), $order);
} else {
	$pokemon_data = $db->select('id, number, name', 'pokemon', NULL, NULL, NULL, $order, NULL, NULL, NULL, FALSE);
}
?>
	<td>
		<select name="pokemon[]" onchange="addPokemon(this);">
			<option value="">None</option>
			<?php foreach($pokemon_data as $pokemon) {
				echo '<option value="'.$pokemon['id'].'">';
				if(isset($_POST['order']) && $_POST['order'] == 'number')
					echo $pokemon['number'].'. ';
				echo $pokemon['name'].'</option>';
			}?>
		</select>
	</td>
	<td>
		<select name="level[]">
			<?php for($i = 1; $i <= 100; $i++) {
				echo '<option value="'.$i.'">'.$i.'</option>';
			}?>
		</select>
	</td>