/**
* Scripts Required by Unit Switcher Plugin in Admin Area
* @author Kyle Phillips
*/
jQuery(function($){


/**
* --------------------------------------------------------------------
* Toggle dependency content under general settings
* --------------------------------------------------------------------
*/

$(document).ready(function(){
	var items = $('.unitswitcher-dependency');
	$.each(items, function(i, v){
		toggle_dependency_content($(this));
	});
});

$('.unitswitcher-dependency-cb').on('change', function(){
	var item = $(this).parents('.unitswitcher-dependency');
	toggle_dependency_content(item);
});

function toggle_dependency_content(item)
{
	if ( $(item).find('.unitswitcher-dependency-cb').is(':checked') ){
		$(item).find('.unitswitcher-dependency-content').hide();
	} else {
		$(item).find('.unitswitcher-dependency-content').show();
	}
}


/**
* --------------------------------------------------------------------
* Add & Remove Units
* --------------------------------------------------------------------
*/
$(document).on('click', '.unitswitcher-add-unit', function(e){
	e.preventDefault();
	add_unit($(this));
});

$(document).on('click', '.unitswitcher-remove-unit', function(e){
	e.preventDefault();
	remove_unit($(this));
});

/**
* Add a Unit
*/
function add_unit(item)
{
	var add_after = $(item).parents('.unitswitcher-unit-item');
	var html = '<li class="unitswitcher-unit-item"><table class="unitswitcher-unit-table"><tr><td><div class="unitswitcher-defaults"><input type="text" placeholder="' + unit_switcher.name + '" class="unitswitcher-name"><input type="text" placeholder="' + unit_switcher.singular_name + '" class="unitswitcher-singular"></div></td><td><ul class="unitswitcher-alternates"><li class="unitswitcher-alternate-item"><div class="formula"><input type="text" class="unitswitcher-formula" placeholder="' + unit_switcher.formula + '"><span class="equals">=</span></div><div class="alternates"><input type="text" placeholder="' + unit_switcher.name + '" class="unitswitcher-alt-name"><input type="text" placeholder="' + unit_switcher.singular_name + '" class="unitswitcher-alt-singular"></div><div class="unitswitcher-add-remove-unit unitswitcher-btn-group"><a href="#" class="unitswitcher-remove-alternate">-</a><a href="#" class="unitswitcher-add-alternate">+</a></div></li></ul></td></tr></table><div class="unitswitcher-add-remove-unit unitswitcher-btn-group"><a href="#" class="unitswitcher-remove-unit">-</a><a href="#" class="unitswitcher-add-unit">+</a></div></li>';
	$(add_after).after(html);
	renumber_units();
}

/**
* Remove a Unit
*/
function remove_unit(item)
{
	$(item).parents('.unitswitcher-unit-item').fadeOut('fast', function(){
		$(this).remove();
		renumber_units();
	});
}


/**
* --------------------------------------------------------------------
* Add & Remove Alternates
* --------------------------------------------------------------------
*/
$(document).on('click', '.unitswitcher-add-alternate', function(e){
	e.preventDefault();
	add_alternate($(this));
});

$(document).on('click', '.unitswitcher-remove-alternate', function(e){
	e.preventDefault();
	remove_alternate($(this));
});

function add_alternate(item)
{
	var add_after = $(item).parents('.unitswitcher-alternate-item');
	var html = '<li class="unitswitcher-alternate-item"><div class="formula"><input type="text" class="unitswitcher-formula" placeholder="' + unit_switcher.formula + '"><span class="equals">=</span></div><div class="alternates"><input type="text" placeholder="' + unit_switcher.name + '" class="unitswitcher-alt-name"><input type="text" placeholder="' + unit_switcher.singular_name + '" class="unitswitcher-alt-singular"></div><div class="unitswitcher-add-remove-unit unitswitcher-btn-group"><a href="#" class="unitswitcher-remove-alternate">-</a><a href="#" class="unitswitcher-add-alternate">+</a></div></li>';
	$(add_after).after(html);
	renumber_units();
}

function remove_alternate(item)
{
	$(item).parents('.unitswitcher-alternate-item').fadeOut('fast', function(){
		$(this).remove();
	});
	renumber_units();
}


/**
* --------------------------------------------------------------------
* Renumber Field Arrays
* --------------------------------------------------------------------
*/
function renumber_units()
{
	var units = $('.unitswitcher-unit-item');
	$.each(units, function(i, v){
		$(this).find('.unitswitcher-name').attr('name', 'unitswitcher_units[' + i + '][default]');
		$(this).find('.unitswitcher-singular').attr('name', 'unitswitcher_units[' + i + '][default_singular]');
		renumber_alternates($(this), i);
	});
}

function renumber_alternates(unit, count)
{
	var alternates = $(unit).find('.unitswitcher-alternate-item');
	$.each(alternates, function(i, v){
		$(this).find('.unitswitcher-formula').attr('name', 'unitswitcher_units[' + count + '][alternates][' + i + '][formula]');
		$(this).find('.unitswitcher-alt-name').attr('name', 'unitswitcher_units[' + count + '][alternates][' + i + '][name]');
		$(this).find('.unitswitcher-alt-singular').attr('name', 'unitswitcher_units[' + count + '][alternates][' + i + '][name_singular]');
	});
}

}); // jQuery