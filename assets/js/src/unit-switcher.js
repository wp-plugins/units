/**
* Scripts Required by Unit Switcher Plugin in Front End
*/
jQuery(function($){

/**
* --------------------------------------------------------------------
* Generate a Nonce (fix for cached pages)
* --------------------------------------------------------------------
*/
$(document).ready(function(){
	generate_nonce();
});

/**
* Get a New Nonce
*/
function generate_nonce()
{
	$.ajax({
		url: unit_switcher.ajaxurl,
		type: 'post',
		datatype: 'json',
		data: {
			action : 'unitswitchernonce'
		},
		success: function(data){
			appendNonce(data.nonce);
		}
	});
}

/**
* Append the new nonce
*/
function appendNonce(nonce)
{
	var script = '<script type="text/javascript"> var unit_switcher_nonce = "' + nonce + '" ;</script>';
	$('head').append(script);
}


/**
* --------------------------------------------------------------------
* Process a Unit Switch
* --------------------------------------------------------------------
*/
$(document).on('click', '*[data-unitswitcher]', function(e){
	e.preventDefault();
	switch_units($(this));
});

/**
* Process the switch
*/
function switch_units(item)
{
	var parent = $(item).attr('data-parentunit');
	var selected_unit = $(item).attr('data-alternate');
	var allunits = $('*[data-unit="' + parent + '"]');

	$.each(allunits, function(i, v){
		var newunit = $(this).siblings('ul').find('*[data-alternate="' + selected_unit + '"]');
		var newnumber = $(newunit).attr('data-unitvalue');
		$(this).find('.unit-switcher-value').text(newnumber + ' ' + selected_unit);
	});

	// Close the menu
	$('.unit-switcher-switch').removeClass('open');
	save_user_pref(parent, selected_unit);
}

/**
* Save the user preference
* @param string parent_unit
* @param string selected_unit
*/
function save_user_pref(parent_unit, selected_unit)
{
	$.ajax({
		url: unit_switcher.ajaxurl,
		type: 'post',
		datatype: 'json',
		data: {
			action : 'unitswitcher',
			parent_unit : parent_unit,
			selected_unit : selected_unit,
			nonce : unit_switcher_nonce
		}
	});
}


/**
* --------------------------------------------------------------------
* Lazy Load Dropdowns – Cached Pages
* --------------------------------------------------------------------
*/
$(document).ready(function(){
	if ( unit_switcher.cache === '1' ){
		load_unit_dropdowns();
	}
});

/**
* Get all the dropdowns
*/
function load_unit_dropdowns()
{
	var all_dropdowns = $('*[data-unit-dropdown]');
	var dropdowns = [];
	$.each(all_dropdowns, function(i, v){
		dropdowns[i] = {
			id : i,
			value : $(this).data('value'),
			unit : $(this).data('unit'),
			round : $(this).data('round')
		}
	});
	send_dropdown_data(dropdowns);
}

/**
* Send the droddown data
*/
function send_dropdown_data(dropdowns)
{
	$.ajax({
		url: unit_switcher.ajaxurl,
		type: 'post',
		datatype: 'json',
		data: {
			action: 'unitswitcher_dropdowns',
			dropdowns: dropdowns
		},
		success: function(data){
			console.log(data);
		}
	});
}

/**
* Replace the dropdowns
*/
function replace_dropdowns(dropdowns)
{
	var all_dropdowns = $('.unit-switcher-switch');
	for ( var i = 0; i < all_dropdowns.length; i++ ){
		var newhtml = dropdowns[i];
		$(all_dropdowns[i]).html(newhtml);
	}
}


}); // jQuery