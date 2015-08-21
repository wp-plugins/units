=== Units ===
Contributors: kylephillips
Donate link: http://unitswitcher.com/
Tags: units, measurements, localization
Requires at least: 3.8
Tested up to: 4.3
Stable tag: 1.0.2

License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add front-end dropdowns for toggling measurement units.

== Description ==

**Why Units?**

Units provides your users with an intuitive way to choose and display their preferred unit of measurement. The user's preferred unit of measurement is saved via session, cookie, or none – configurable under the plugin settings. 

Any number of primary/alternate units can be added, along with their conversion formulas.

Visit [unitswitcher.com](http://unitswitcher.com) for more detailed information.

**Using Units**

Add primary units under Settings > Units. Alternate units may be added by providing their name and conversion formula. Multiple alternate units may be added for each primary unit.

Use the function `unit_switcher($value, $primaryunit, $round)` in your template to display the switcher. Pass the stored value as the first parameter and primary unit of measurement as the second value.

To display a single switcher, the shortcode [unit_switcher] is available for use. The shortcode requires two parameters: `unit` (the primary unit being converted) and `value` (the stored value).

For more information visit [unitswitcher.com](http://unitswitcher.com).

**Important: Unit Switcher requires WordPress version 3.8 or higher, and PHP version 5.3.2 or higher.**


== Installation ==

1. Upload unit-switcher to the wp-content/plugins/ directory
2. Activate the plugin through the Plugins menu in WordPress
3. Visit the plugin settings to add units of measurement
4. Use the unit_switcher() template function or [unit_switcher] shortcode to display the switcher

== Frequently Asked Questions ==

= Is this plugin WPML compatible? =
The plugin is not yet WPML compatible.

= How do I add a unit of measurement? =
Visit Settings > Unit Switcher. A primary unit of measurement is required, along with at least one alternate unit. Substitute the primary unit with `X` in the formula to equal the alternate formula. So, to set an alternate unit of `inches` for a primary unit of `feet`, the formula should be set to `X*12`.


== Screenshots ==

1. Display a dropdown method for users to toggle between units of measurement. 

2. Optionally save the user's preference via the session or cookie.

3. Add as many units/alternate units as needed.


== Changelog ==

= 1.0.2 =
* Bug fix - conflict with Bootstrap Javascript libary resolved.

= 1.0.1 =
* Page caching conflicts resolved. If using a page cache plugin, visit Settings > Unit Switcher to enable the fix.
* Minor bug fixes in options saving

= 1.0 =
* Initial release 


== Upgrade Notice ==

= 1.0 =
Initial release


== More Information ==

= Using the Template Function =
**unit_switcher($variable, $primaryunit, $round);**

Parameters:
* $variable - The stored value (integer or float)
* $primaryunit - The primary unit (the stored value should be stored in this unit)
* $round - Number of digits to round to (default is 2)

Visit [unitswitcher.com](http://unitswitcher.com) for more detailed information.
