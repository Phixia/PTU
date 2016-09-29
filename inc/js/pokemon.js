var pokemonStats = new Array();

function combatStage(stat, direction, pokemonIndex) {
	if(stat == 'atk') {
		base = parseInt($('base_atk'+pokemonIndex).value);
		if($('mega_evolved'+pokemonIndex) && $('mega_evolved'+pokemonIndex).value == 'Yes')
			base += parseInt($('mega_atk'+pokemonIndex).value);
		else if($('mega_evolved2'+pokemonIndex) && $('mega_evolved2'+pokemonIndex).value == 'Yes')
			base += parseInt($('mega_atk2'+pokemonIndex).value);
		pokemonStats[pokemonIndex][0] += direction;
		if(pokemonStats[pokemonIndex][0] < 0 && pokemonStats[pokemonIndex][0] >= -6)
			$('atk_'+pokemonIndex).innerHTML = base - Math.ceil(base * 0.125 * pokemonStats[pokemonIndex][0] * -1);
		else if(pokemonStats[pokemonIndex][0] < -6) {
			alert('Can\'t lower attack any further.');
			pokemonStats[pokemonIndex][0] = -6;
		} else if(pokemonStats[pokemonIndex][0] > 0 && pokemonStats[pokemonIndex][0] <= 6)
			$('atk_'+pokemonIndex).innerHTML = base + Math.floor(base * 0.25 * pokemonStats[pokemonIndex][0]);
		else if(pokemonStats[pokemonIndex][0] > 6) {
			alert("Can't raise attack any higher.");
			pokemonStats[pokemonIndex][0] = 6;
		} else
			$('atk_'+pokemonIndex).innerHTML = base;
		
		if(pokemonStats[pokemonIndex][0] > 0)
			$('atk_stage_'+pokemonIndex).innerHTML = '+'+pokemonStats[pokemonIndex][0];
		else if(pokemonStats[pokemonIndex][0] < 0)
			$('atk_stage_'+pokemonIndex).innerHTML = pokemonStats[pokemonIndex][0];
		else
			$('atk_stage_'+pokemonIndex).innerHTML = '';
	} else if(stat == 'def') {
		base = parseInt($('base_def'+pokemonIndex).value);
		if($('mega_evolved'+pokemonIndex) && $('mega_evolved'+pokemonIndex).value == 'Yes')
			base += parseInt($('mega_def'+pokemonIndex).value);
		else if($('mega_evolved2'+pokemonIndex) && $('mega_evolved2'+pokemonIndex).value == 'Yes')
			base += parseInt($('mega_def2'+pokemonIndex).value);
		pokemonStats[pokemonIndex][1] += direction;
		if(pokemonStats[pokemonIndex][1] < 0 && pokemonStats[pokemonIndex][1] >= -6)
			$('def_'+pokemonIndex).innerHTML = base - Math.ceil(base * 0.125 * pokemonStats[pokemonIndex][1] * -1);
		else if(pokemonStats[pokemonIndex][1] < -6) {
			alert('Can\'t lower attack any further.');
			pokemonStats[pokemonIndex][1] = -6;
		} else if(pokemonStats[pokemonIndex][1] > 0 && pokemonStats[pokemonIndex][1] <= 6)
			$('def_'+pokemonIndex).innerHTML = base + Math.floor(base * 0.25 * pokemonStats[pokemonIndex][1]);
		else if(pokemonStats[pokemonIndex][1] > 6) {
			alert("Can't raise attack any higher.");
			pokemonStats[pokemonIndex][1] = 6;
		} else
			$('def_'+pokemonIndex).innerHTML = base;
		$('atk_evas_'+pokemonIndex).innerHTML = Math.min(Math.min(Math.floor(base / 5), 6) + pokemonStats[pokemonIndex][1], 9);
		
		if(pokemonStats[pokemonIndex][1] > 0)
			$('def_stage_'+pokemonIndex).innerHTML = '+'+pokemonStats[pokemonIndex][1];
		else if(pokemonStats[pokemonIndex][1] < 0)
			$('def_stage_'+pokemonIndex).innerHTML = pokemonStats[pokemonIndex][1];
		else
			$('def_stage_'+pokemonIndex).innerHTML = '';
	} else if(stat == 'satk') {
		base = parseInt($('base_satk'+pokemonIndex).value);
		if($('mega_evolved'+pokemonIndex) && $('mega_evolved'+pokemonIndex).value == 'Yes')
			base += parseInt($('mega_satk'+pokemonIndex).value);
		else if($('mega_evolved2'+pokemonIndex) && $('mega_evolved2'+pokemonIndex).value == 'Yes')
			base += parseInt($('mega_satk2'+pokemonIndex).value);
		pokemonStats[pokemonIndex][2] += direction;
		if(pokemonStats[pokemonIndex][2] < 0 && pokemonStats[pokemonIndex][2] >= -6)
			$('satk_'+pokemonIndex).innerHTML = base - Math.ceil(base * 0.125 * pokemonStats[pokemonIndex][2] * -1);
		else if(pokemonStats[pokemonIndex][2] < -6) {
			alert('Can\'t lower attack any further.');
			pokemonStats[pokemonIndex][2] = -6;
		} else if(pokemonStats[pokemonIndex][2] > 0 && pokemonStats[pokemonIndex][2] <= 6)
			$('satk_'+pokemonIndex).innerHTML = base + Math.floor(base * 0.25 * pokemonStats[pokemonIndex][2]);
		else if(pokemonStats[pokemonIndex][2] > 6) {
			alert("Can't raise attack any higher.");
			pokemonStats[pokemonIndex][2] = 6;
		} else
			$('satk_'+pokemonIndex).innerHTML = base;
		
		if(pokemonStats[pokemonIndex][2] > 0)
			$('satk_stage_'+pokemonIndex).innerHTML = '+'+pokemonStats[pokemonIndex][2];
		else if(pokemonStats[pokemonIndex][2] < 0)
			$('satk_stage_'+pokemonIndex).innerHTML = pokemonStats[pokemonIndex][2];
		else
			$('satk_stage_'+pokemonIndex).innerHTML = '';
	} else if(stat == 'sdef') {
		base = parseInt($('base_sdef'+pokemonIndex).value);
		if($('mega_evolved'+pokemonIndex) && $('mega_evolved'+pokemonIndex).value == 'Yes')
			base += parseInt($('mega_sdef'+pokemonIndex).value);
		else if($('mega_evolved2'+pokemonIndex) && $('mega_evolved2'+pokemonIndex).value == 'Yes')
			base += parseInt($('mega_sdef2'+pokemonIndex).value);
		pokemonStats[pokemonIndex][3] += direction;
		if(pokemonStats[pokemonIndex][3] < 0 && pokemonStats[pokemonIndex][3] >= -6)
			$('sdef_'+pokemonIndex).innerHTML = base - Math.ceil(base * 0.125 * pokemonStats[pokemonIndex][3] * -1);
		else if(pokemonStats[pokemonIndex][3] < -6) {
			alert('Can\'t lower attack any further.');
			pokemonStats[pokemonIndex][3] = -6;
		} else if(pokemonStats[pokemonIndex][3] > 0 && pokemonStats[pokemonIndex][3] <= 6)
			$('sdef_'+pokemonIndex).innerHTML = base + Math.floor(base * 0.25 * pokemonStats[pokemonIndex][3]);
		else if(pokemonStats[pokemonIndex][3] > 6) {
			alert("Can't raise attack any higher.");
			pokemonStats[pokemonIndex][3] = 6;
		} else
			$('sdef_'+pokemonIndex).innerHTML = base;
		$('satk_evas_'+pokemonIndex).innerHTML = Math.min(Math.min(Math.floor(base / 5), 6) + pokemonStats[pokemonIndex][3], 9);
		
		if(pokemonStats[pokemonIndex][3] > 0)
			$('sdef_stage_'+pokemonIndex).innerHTML = '+'+pokemonStats[pokemonIndex][3];
		else if(pokemonStats[pokemonIndex][3] < 0)
			$('sdef_stage_'+pokemonIndex).innerHTML = pokemonStats[pokemonIndex][3];
		else
			$('sdef_stage_'+pokemonIndex).innerHTML = '';
	} else if(stat == 'spd') {
		base = parseInt($('base_spd'+pokemonIndex).value);
		if($('mega_evolved'+pokemonIndex) && $('mega_evolved'+pokemonIndex).value == 'Yes')
			base += parseInt($('mega_spd'+pokemonIndex).value);
		else if($('mega_evolved2'+pokemonIndex) && $('mega_evolved2'+pokemonIndex).value == 'Yes')
			base += parseInt($('mega_spd2'+pokemonIndex).value);
		pokemonStats[pokemonIndex][4] += direction;
		if(pokemonStats[pokemonIndex][4] < 0 && pokemonStats[pokemonIndex][4] >= -6)
			$('spd_'+pokemonIndex).innerHTML = base - Math.ceil(base * 0.125 * pokemonStats[pokemonIndex][4] * -1);
		else if(pokemonStats[pokemonIndex][4] < -6) {
			alert('Can\'t lower attack any further.');
			pokemonStats[pokemonIndex][4] = -6;
		} else if(pokemonStats[pokemonIndex][4] > 0 && pokemonStats[pokemonIndex][4] <= 6)
			$('spd_'+pokemonIndex).innerHTML = base + Math.floor(base * 0.25 * pokemonStats[pokemonIndex][4]);
		else if(pokemonStats[pokemonIndex][4] > 6) {
			alert("Can't raise attack any higher.");
			pokemonStats[pokemonIndex][4] = 6;
		} else
			$('spd_'+pokemonIndex).innerHTML = base;
		$('spd_evas_'+pokemonIndex).innerHTML = Math.min(Math.min(Math.floor(base / 10), 6) + pokemonStats[pokemonIndex][4], 9);
		
		if(pokemonStats[pokemonIndex][4] > 0)
			$('spd_stage_'+pokemonIndex).innerHTML = '+'+pokemonStats[pokemonIndex][4];
		else if(pokemonStats[pokemonIndex][4] < 0)
			$('spd_stage_'+pokemonIndex).innerHTML = pokemonStats[pokemonIndex][4];
		else
			$('spd_stage_'+pokemonIndex).innerHTML = '';
		
		var speedChange;
		if(pokemonStats[pokemonIndex][4] > 0) {
			speedChange = Math.floor(pokemonStats[pokemonIndex][4] / 2);
		} else {
			speedChange = Math.ceil(pokemonStats[pokemonIndex][4] / 3);
		}
		if($('overland_'+pokemonIndex) && parseInt($('overland_base_'+pokemonIndex).value) + speedChange >= 1) {
			$('overland_'+pokemonIndex).innerHTML = parseInt($('overland_base_'+pokemonIndex).value) + speedChange;
		}
		if($('surface_'+pokemonIndex) && parseInt($('surface_base_'+pokemonIndex).value) + speedChange >= 1) {
			$('surface_'+pokemonIndex).innerHTML = parseInt($('surface_base_'+pokemonIndex).value) + speedChange;
		}
		if($('underwater_'+pokemonIndex) && parseInt($('underwater_base_'+pokemonIndex).value) + speedChange >= 1) {
			$('underwater_'+pokemonIndex).innerHTML = parseInt($('underwater_base_'+pokemonIndex).value) + speedChange;
		}
		if($('sky_'+pokemonIndex) && parseInt($('sky_base_'+pokemonIndex).value) + speedChange >= 1) {
			$('sky_'+pokemonIndex).innerHTML = parseInt($('sky_base_'+pokemonIndex).value) + speedChange;
		}
		if($('burrow_'+pokemonIndex) && parseInt($('burrow_base_'+pokemonIndex).value) + speedChange >= 1) {
			$('burrow_'+pokemonIndex).innerHTML = parseInt($('burrow_base_'+pokemonIndex).value) + speedChange;
		}
	}
}

function dealDamage(dmgType, pokemonIndex) {
	var dmg = 0;
	if(dmgType == 'atk') {
		dmg = parseInt($('atk_dmg_'+pokemonIndex).value) - parseInt($('def_'+pokemonIndex).innerHTML);
		$('atk_dmg_'+pokemonIndex).value = '';
	} else if(dmgType == 'satk') {
		dmg = parseInt($('satk_dmg_'+pokemonIndex).value) - parseInt($('sdef_'+pokemonIndex).innerHTML);
		$('satk_dmg_'+pokemonIndex).value = '';
	} else if(dmgType == 'tru') {
		dmg = parseInt($('tru_dmg_'+pokemonIndex).value);
		$('tru_dmg_'+pokemonIndex).value = '';
	} else if(dmgType == 'heal') {
		dmg = -1 * parseInt($('heal_dmg_'+pokemonIndex).value);
		$('heal_dmg_'+pokemonIndex).value = '';
	}
	if(dmgType != 'heal') {
		if(dmg < 0)
			dmg = 0;
		if($('12_'+pokemonIndex).checked)
			dmg = Math.floor(dmg / 2);
		else if($('14_'+pokemonIndex).checked)
			dmg = Math.floor(dmg / 4);
		else if($('2_'+pokemonIndex).checked)
			dmg = dmg * 2;
		else if($('4_'+pokemonIndex).checked)
			dmg = dmg * 4;
	}
	$('current_hp_'+pokemonIndex).value = parseInt($('current_hp_'+pokemonIndex).value) - dmg;
	if($('current_hp_'+pokemonIndex).value > parseInt($('total_hp_'+pokemonIndex).innerHTML))
		$('current_hp_'+pokemonIndex).value = parseInt($('total_hp_'+pokemonIndex).innerHTML);
	updateCapture(pokemonIndex, $('current_hp_'+pokemonIndex).value, parseInt($('total_hp_'+pokemonIndex).innerHTML));
}

function updateCapture(pokemonIndex, currentHP, totalHP) {
	if(currentHP/totalHP > .75)
		$('capture_rate_'+pokemonIndex).innerHTML = parseInt($('base_capture_'+pokemonIndex).value) - 15;
	else if(currentHP/totalHP > .5)
		$('capture_rate_'+pokemonIndex).innerHTML = parseInt($('base_capture_'+pokemonIndex).value) - 5;
	else if(currentHP/totalHP > .25)
		$('capture_rate_'+pokemonIndex).innerHTML = parseInt($('base_capture_'+pokemonIndex).value) + 5;
	else if(currentHP > 1)
		$('capture_rate_'+pokemonIndex).innerHTML = parseInt($('base_capture_'+pokemonIndex).value) + 15;
	else if(currentHP == 1)
		$('capture_rate_'+pokemonIndex).innerHTML = parseInt($('base_capture_'+pokemonIndex).value) + 25;
	else
		$('capture_rate_'+pokemonIndex).innerHTML = 0;
}

function randomMove(pokemonIndex) {
	new Request.HTML({
		url : '/api/pokemon.get_move.php',
		onSuccess : function(tree, elems, html, java) {
			$('random_move'+pokemonIndex).innerHTML = html;
		}
	}).send({
		method : 'post'
	});
}

function showMoves(pokemonIndex, source) {
	var sources = ["learned", "tmhm", "tutor", "egg"];
	for(var i = 0; i < sources.length; i++) {
		var rows = $$('.'+sources[i]+'_move'+pokemonIndex);
		for(var j = 0; j < rows.length; j++) {
			if(sources[i] == source)
				rows[j].addClass('show');
			else
				rows[j].removeClass('show');
		}
		if(sources[i] == source && $(sources[i]+'_tab'+pokemonIndex))
			$(sources[i]+'_tab'+pokemonIndex).addClass('selected');
		else if($(sources[i]+'_tab'+pokemonIndex))
			$(sources[i]+'_tab'+pokemonIndex).removeClass('selected');
	}
}

function megaEvolve(pokemonIndex, megaType, number) {
	if($('mega_evolved'+pokemonIndex).value == 'No') {
		//Now done when combat stages are updated.
//		$('atk_'+pokemonIndex).innerHTML = parseInt($('base_atk'+pokemonIndex).value) + parseInt($('mega_atk'+pokemonIndex).value);
//		$('def_'+pokemonIndex).innerHTML = parseInt($('base_def'+pokemonIndex).value) + parseInt($('mega_def'+pokemonIndex).value);
//		$('satk_'+pokemonIndex).innerHTML = parseInt($('base_satk'+pokemonIndex).value) + parseInt($('mega_satk'+pokemonIndex).value);
//		$('sdef_'+pokemonIndex).innerHTML = parseInt($('base_sdef'+pokemonIndex).value) + parseInt($('mega_sdef'+pokemonIndex).value);
//		$('spd_'+pokemonIndex).innerHTML = parseInt($('base_spd'+pokemonIndex).value) + parseInt($('mega_spd'+pokemonIndex).value);
		
		if(megaType != '') {
			if($('pokemon_types'+pokemonIndex).innerHTML.indexOf(' / ') == -1)
				$('pokemon_types'+pokemonIndex).innerHTML += ' / '+megaType;
			else
				$('pokemon_types'+pokemonIndex).innerHTML = $('pokemon_types'+pokemonIndex).innerHTML.substring(0, $('pokemon_types'+pokemonIndex).innerHTML.indexOf(' / '))+' / '+megaType;
			
			new Request.HTML({
				url : '/api/pokemon.get_elemental_matches.php',
				onSuccess : function(tree, elems, html, java) {
					$('elemental_slider'+pokemonIndex).innerHTML = html;
				}
			}).send({
				method : 'post',
				data : 'pokemonIndex='+pokemonIndex+'&type1='+$('pokemon_type1'+pokemonIndex).value+'&type2='+megaType
			});
		}
		
		var megaAbility = $('mega_ability'+pokemonIndex);
		if(megaAbility)
			megaAbility.addClass('show');
		
		$('pokemon_image'+pokemonIndex).src = '/pokemon_images/'+number+'-Mega.png';
		$('mega_button'+pokemonIndex).innerHTML = 'End';
		if($('mega_button2'+pokemonIndex)) {
			$('mega_button2'+pokemonIndex).style.display = 'none';
		}
		$('mega_evolved'+pokemonIndex).value = 'Yes';
		
		combatStage('atk', 0, pokemonIndex);
		combatStage('def', 0, pokemonIndex);
		combatStage('satk', 0, pokemonIndex);
		combatStage('sdef', 0, pokemonIndex);
		combatStage('spd', 0, pokemonIndex);
	} else {
		//Now done when combat stages are updated.
//		$('atk_'+pokemonIndex).innerHTML = parseInt($('base_atk'+pokemonIndex).value) - parseInt($('mega_atk'+pokemonIndex).value);
//		$('def_'+pokemonIndex).innerHTML = parseInt($('base_def'+pokemonIndex).value) - parseInt($('mega_def'+pokemonIndex).value);
//		$('satk_'+pokemonIndex).innerHTML = parseInt($('base_satk'+pokemonIndex).value) - parseInt($('mega_satk'+pokemonIndex).value);
//		$('sdef_'+pokemonIndex).innerHTML = parseInt($('base_sdef'+pokemonIndex).value) - parseInt($('mega_sdef'+pokemonIndex).value);
//		$('spd_'+pokemonIndex).innerHTML = parseInt($('base_spd'+pokemonIndex).value) - parseInt($('mega_spd'+pokemonIndex).value);
		
		if(megaType != '') {
			$('pokemon_types'+pokemonIndex).innerHTML = $('pokemon_types'+pokemonIndex).innerHTML.substring(0, $('pokemon_types'+pokemonIndex).innerHTML.indexOf(' / '))
			if($('pokemon_type2'+pokemonIndex).value != '')
				$('pokemon_types'+pokemonIndex).innerHTML += ' / '+$('pokemon_type2'+pokemonIndex).value;
		}
		getElementalMatches(pokemonIndex);
		
		var megaAbility = $('mega_ability'+pokemonIndex);
		if(megaAbility)
			megaAbility.removeClass('show');
		
		$('pokemon_image'+pokemonIndex).src = '/pokemon_images/'+number+'.png';
		$('mega_button'+pokemonIndex).innerHTML = 'Mega';
		if($('mega_button2'+pokemonIndex)) {
			$('mega_button'+pokemonIndex).innerHTML += ' X';
			$('mega_button2'+pokemonIndex).style.display = 'block';
		}
		$('mega_evolved'+pokemonIndex).value = 'No';
		
		combatStage('atk', 0, pokemonIndex);
		combatStage('def', 0, pokemonIndex);
		combatStage('satk', 0, pokemonIndex);
		combatStage('sdef', 0, pokemonIndex);
		combatStage('spd', 0, pokemonIndex);
	}
}
function megaEvolve2(pokemonIndex, number) {
	if($('mega_evolved2'+pokemonIndex).value == 'No') {
		var megaAbility = $('mega_ability2'+pokemonIndex);
		if(megaAbility)
			megaAbility.addClass('show');
		
		$('pokemon_image'+pokemonIndex).src = '/pokemon_images/'+number+'-Mega2.png';
		$('mega_button2'+pokemonIndex).innerHTML = 'End';
		$('mega_button'+pokemonIndex).style.display = 'none';
		$('mega_evolved2'+pokemonIndex).value = 'Yes';
		
		combatStage('atk', 0, pokemonIndex);
		combatStage('def', 0, pokemonIndex);
		combatStage('satk', 0, pokemonIndex);
		combatStage('sdef', 0, pokemonIndex);
		combatStage('spd', 0, pokemonIndex);
	} else {
		var megaAbility = $('mega_ability2'+pokemonIndex);
		if(megaAbility)
			megaAbility.removeClass('show');
		
		$('pokemon_image'+pokemonIndex).src = '/pokemon_images/'+number+'.png';
		$('mega_button2'+pokemonIndex).innerHTML = 'Mega Y';
		$('mega_button'+pokemonIndex).style.display = 'block';
		$('mega_evolved2'+pokemonIndex).value = 'No';
		
		combatStage('atk', 0, pokemonIndex);
		combatStage('def', 0, pokemonIndex);
		combatStage('satk', 0, pokemonIndex);
		combatStage('sdef', 0, pokemonIndex);
		combatStage('spd', 0, pokemonIndex);
	}
}
function setMultiplier(pokemonIndex, multiplier) {
	if(multiplier == .5)
		$('12_'+pokemonIndex).checked = true;
	else if(multiplier == .25)
		$('14_'+pokemonIndex).checked = true;
	else if(multiplier != 0)
		$(multiplier+'_'+pokemonIndex).checked = true;
}
function getElementalMatches(pokemonIndex) {
	new Request.HTML({
		url : '/api/pokemon.get_elemental_matches.php',
		onSuccess : function(tree, elems, html, java) {
			$('elemental_slider'+pokemonIndex).innerHTML = html;
		}
	}).send({
		method : 'post',
		data : 'pokemonIndex='+pokemonIndex+'&type1='+$('pokemon_type1'+pokemonIndex).value+'&type2='+$('pokemon_type2'+pokemonIndex).value
	});
}