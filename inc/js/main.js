var pokemonTypes = new Array("Normal", "Fighting", "Flying", "Poison", "Ground", "Rock", "Bug", "Ghost", "Steel", "Fire", "Water", "Grass", "Electric", "Psychic", "Ice", "Dragon", "Dark", "Fairy");

function updateExp() {
	var rows = $('exp_table').getElementsByTagName("tr");
	var total_exp = 0;
	for(var i = 1; i < rows.length; i++) {
		if(rows[i].getElementsByTagName("td")[0].getElementsByTagName("input")[0].checked)
			total_exp += parseInt(rows[i].getElementsByTagName("td")[2].innerHTML);
	}
	if($('trainer_battle').checked)
		total_exp = total_exp * 2;
	$('total_exp').innerHTML = total_exp;
}
function type_to_color(type) {
	if(type == 'Normal') {
		return 'rgb(168,168,120)';
	} else if(type == 'Fire') {
		return 'rgb(240,128,48)';
	} else if(type == 'Water') {
		return 'rgb(104,144,240)';
	} else if(type == 'Electric') {
		return 'rgb(248,208,48)';
	} else if(type == 'Grass') {
		return 'rgb(120,200,80)';
	} else if(type == 'Ice') {
		return 'rgb(152,216,216)';
	} else if(type == 'Fighting') {
		return 'rgb(192,48,40)';
	} else if(type == 'Poison') {
		return 'rgb(160,64,160)';
	} else if(type == 'Ground') {
		return 'rgb(227,195,104)';
	} else if(type == 'Flying') {
		return 'rgb(168,144,240)';
	} else if(type == 'Psychic') {
		return 'rgb(248,88,136)';
	} else if(type == 'Bug') {
		return 'rgb(168,184,32)';
	} else if(type == 'Rock') {
		return 'rgb(184,160,56)';
	} else if(type == 'Ghost') {
		return 'rgb(112,88,152)';
	} else if(type == 'Dragon') {
		return 'rgb(112,56,248)';
	} else if(type == 'Dark') {
		return 'rgb(112,88,72)';
	} else if(type == 'Steel') {
		return 'rgb(184,184,208)';
	} else if(type == 'Fairy') {
		return 'rgb(235,111,198)';
	} else {
		return 'rgb(0,0,0)';
	}
}
function highlightTop(type) {
	for(var i = 0; i < pokemonTypes.length; i++) {
		if(pokemonTypes[i] == type)
			$('type_chart_top_cell_'+pokemonTypes[i]).style.color = 'rgb(75,150,255)';
		else
			$('type_chart_top_cell_'+pokemonTypes[i]).style.color = '#FFFFFF';
	}
}