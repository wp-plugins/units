jQuery(document).ready(function(){
	new UnitSwitcherDropdown;
});

var UnitSwitcherDropdown = function()
{
	var plugin = this;
	var $ = jQuery;
	plugin.dropdown = '';

	plugin.bindEvents = function(){
		$(document).on('click', '[data-unit-dropdown]', function(e){
			e.preventDefault();
			plugin.dropdown = $(this).parents('.dropdown');
			plugin.toggleDropdown();
		});
		$(document).on('click', function(e){
			plugin.closeDropdowns(e.target);
		});
	}

	plugin.init = function(){
		plugin.bindEvents();
	}

	plugin.toggleDropdown = function(){
		var content = $(plugin.dropdown).find('.dropdown-menu');
		if ( $(plugin.dropdown).hasClass('active') ){
			$(plugin.dropdown).removeClass('active');
			return;
		}
		$('.dropdown').removeClass('active');
		$(plugin.dropdown).addClass('active');
	}

	plugin.closeDropdowns = function(target){
		if ( $(target).parents('.dropdown').length === 0 ){
			$('.dropdown').removeClass('active');
		}
	}

	return plugin.init();

}