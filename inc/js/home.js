function addPokemon(el) {
	if(el && el.value == '')
		el.parentNode.parentNode.parentNode.removeChild(el.parentNode.parentNode);
	else {
		if(el)
			el.onchange = '';
		else {
			var pokemon = document.getElementsByName('pokemon[]');
			for(var i = 0; i < pokemon.length; i++) {
				if(pokemon[i].value == '') {
					pokemon[i].parentNode.parentNode.parentNode.removeChild(pokemon[i].parentNode.parentNode);
					break;
				}
			}
		}
		var order = '';
		if($('number').checked)
			order = 'number';
		else if($('name').checked)
			order = 'name'
		new Request.HTML({
			url : '/api/home.get_pokemon_list.php',
			onSuccess : function(tree, elems, html, java) {
				var tr = document.createElement('tr');
				tr.innerHTML = html;
				$('table_body').appendChild(tr);
			}
		}).send({
			method : 'post',
			data : 'habitat='+$('habitat').value+'&order='+order
		});
	}
}
function numToRarity(number) {
	switch(number) {
	case 0:
		return 'Very Common';
		break;
	case 1:
		return 'Common';
		break;
	case 2:
		return 'Uncommon';
		break;
	case 3:
		return 'Rare';
		break;
	case 4:
		return 'Very Rare';
		break;
	}
}
function updateLevelTo(fromLevel) {
	if($('level_to').value <= fromLevel && fromLevel < 100)
		$('level_to').selectedIndex = fromLevel;
	else if(fromLevel == 100)
		$('level_to').selectedIndex = 99;
}
function toggleAllHabitats() {
	var checkboxes = $$('input.habitat_input');
	for(var i = 0; i < checkboxes.length; i++) {
		if($('all_habitats').checked)
			checkboxes[i].checked = true;
		else
			checkboxes[i].checked = false;
	}
}
function setCustomHabitats(input) {
	if(!input.checked)
		$('all_habitats').checked = false;
}
function toggleAllTypes() {
	var checkboxes = $$('input.type_input');
	for(var i = 0; i < checkboxes.length; i++) {
		if($('all_types').checked)
			checkboxes[i].checked = true;
		else
			checkboxes[i].checked = false;
	}
}
function setCustomTypes(input) {
	if(!input.checked)
		$('all_types').checked = false;
}
function toggleAllGenerations() {
	var checkboxes = $$('input.generation_input');
	for(var i = 0; i < checkboxes.length; i++) {
		if($('all_generations').checked)
			checkboxes[i].checked = true;
		else
			checkboxes[i].checked = false;
	}
}
function setCustomGenerations(input) {
	if(!input.checked)
		$('all_generations').checked = false;
}