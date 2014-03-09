=== WP Pace ===
Contributors: jamesdbruner
Donate link: http://jamesdbruner.com/donate
Tags: pace, loading animation, loading, progress bar
Requires at least: 3.0.1
Tested up to: 3.6.1
Stable tag: 2.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easily add good looking, customizable progress bars to your website/blog. Based on <a href="http://github.hubspot.com/pace/docs/welcome/">Pace - Automatic page load progress bar</a>.

== Description ==

Create an automatic page load progress bar. Based on <a href="http://github.hubspot.com/pace/docs/welcome/">Pace - Automatic page load progress bar</a>. Javascript by <a href="https://twitter.com/zackbloom">Zack Bloom</a> CSS by <a href="https://twitter.com/adamfschwartz">Adam Schwartz</a>. Themes inspired by <a href="http://tympanus.net/codrops/2013/09/18/creative-loading-effects/">Mary Lou</a>

See a working demo here: <a href="http://pace.jamesdbruner.com">pace.jamesdbruner.com</a>

Cool Features:

* Customize the color of the progress bar with an easy to use color picker
* Choose which progress bar 'theme' you want to use from a dropdown list
* Decide whether you want to have the progress bar on every page or use the shortcode to add it to just a few specific pages/posts
* The shortcode allows you to have different colored progress bars with varying themes on a page to page basis.

How to use the shortcode:

There are two attributes you can use

*   color
*   theme

Example: `[pace color="#29d9dd" theme="minimal"]` or just `[pace]` will work fine. (the default color is #29d9dd and the default theme is minimal)

There are ten themes to choose from

* Minimal
* Flash
* Barbershop
* MacOSX
* Fill-Left
* Flat-Top
* CornderIndicator
* Bounce
* Big Counter
* Center Circle

== Installation ==

How to get started:

1. Upload `wp-pace.zip` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Navigate to the Plugins page and select Settings
1. Choose the settings you would like then check the Sitewide option and save
1. Alternatively you can uncheck the sitewide option and use the shortcode on any page or post

== Frequently Asked Questions ==

= How big is this plugin? =

Currently it's sitting at: ~43.3KB
This is largely due to the fact that every pace theme is included in this plugin.  That's not to say that every theme is loaded.  Only the theme you choose is loaded onto your page.


== Screenshots ==

To view it in action you can go to <a href="http://pace.jamesdbruner.com/">pace.jamesdbruner.com</a>

1. Settings Page
2. Big Counter Example

== Changelog ==

= 2.0 =
* Refactored the plugin to work within the pace class now
* Added 2 more effects Big Counter and Center Circle
* Minified the css for all of the efects
* Minified pace.js

= 1.0 =
* First commit
* Comes with a global option or you can use the shortcodes
* Customize the color and choose a theme for your progress bar(s)

== Upgrade Notice ==

= 2.0 =
It's better code that's less likely to conflict with other plugins.  Also I've reduced the size of all the css and js files and included two more cool effects.

= 1.0 =
Why update?  Because all the cool kids are doing it.