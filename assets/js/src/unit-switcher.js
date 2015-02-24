/**
* Scripts Required by Unit Switcher Plugin in Front End
*/
jQuery(function($){


/**
* --------------------------------------------------------------------
* Unit Switcher
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
			nonce : unit_switcher.nonce
		}
	});
}


}); // jQuery