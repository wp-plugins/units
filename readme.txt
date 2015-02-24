=== Units ===
Contributors: kylephillips
Donate link: http://unitswitcher.com/
Tags: units, measurements, localization
Requires at least: 3.8
Tested up to: 4.1
Stable tag: 1.0

License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add front end dropdown for toggling and saving of units and measurements.

== Description ==

**Why Unit Switcher?**

Units provides your users with a way to choose and display their preferred unit of measurement on the fly. The user's preferred unit of measurement is saved via session, cookie, or none – configurable under the plugin settings. 

One example of usage would be for a real estate listing website. If land size is stored as acres, it may be helpful to provide a method for users to toggle between acres and kilometers squared as their preferred method of measurement. Another example may be a recipe site, where it may be helpful to provide users with a way to toggle between ingredient measurement units.

Units may be added as needed, along with alternate units and the conversion formulas.

Visit [unitswitcher.com](http://unitswitcher.com) for more detailed information.

**Using Units**

First, add primary units under settings > Units. Alternate units may be added by providing their name, singular name and conversion formula. Multiple alternate units may be set.

Use the function `unit_switcher($variable, $primaryunit)` in your template to display the switcher. Pass the stored value as the first paramter and primary unit of measurement as the second value.

To display a single switcher, the shortcode [unit_switcher] is available for use. The shortcode requires two parameters, `unit` (the primary unit being converted) and `value` (the stored value).

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

= 0.1 =
* Initial release 


== Upgrade Notice ==

= 0.1 =
Initial release


== More Information ==

= Using the Template Function =
**unit_switcher($variable, $primaryunit, $round);**

Parameters:
* $variable - The stored value (integer or float)
* $primaryunit - The primary unit (the stored value should be stored in this unit)
* $round - Number of digits to round to (default is 2)

Visit [unitswitcher.com](http://unitswitcher.com) for more detailed information.
