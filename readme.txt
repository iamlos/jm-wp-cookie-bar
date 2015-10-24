=== JM WP Cookie Bar ===
Contributors: jmlapam
Tags: cookie, bar, policy
Tested up to: 4.4 alpha
Requires at least: 3.1.0
License: GPLv2 or later
Stable tag: trunk
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Easy integration of cookie warning !

== Description ==

It is now mandatory to display a warning message to your visitors to let them know you are tracking some data e.g with Google Analytics. This plugin allows you to customize the message, make it show as top bar and set an expiration time for cookie.

**Disclaimer** : you should abide by the law there could be some additional requirements in your country. This plugin is a generic tool. Please make sure all details are ok.

<a href="http://twitter.com/intent/user?screen_name=tweetpressfr">Follow me on Twitter</a>


== Installation ==

1. Upload plugin files to the /wp-content/plugins/ directory
2. Activate the plugin through the Plugins menu in WordPress
3. Go to Tool > Cookie Bar in admin panel to set your cookie bar !

== Frequently asked questions ==

**How to style it?**

There are already some basic style but you can override them. Just use the following css classes : `.cookie-message`, `.cookie-message a`, `.cookie-message` p, `.wpcb-close-btn` for the button but you can even change the button class (option), and `.cookie-rules` for the link to your cookies rules page.

You can even deactivate basic style and style it entirely in your main stylesheet.

== Screenshots ==

1. Admin page in Admin tool menu
2. Basic look in front end

== Changelog ==

# 2.0
* 24 Oct 2015
* Be careful this update breaks everything
* No option any more except  NEW PARAMETER GA ID (Google Analytics ID)
* No style or text option, it is meant to work with GA with simple text and call to action
* Still the text is translation ready
* Opt out for cookie bar !

# 1.6
* 05 May 2015
* Code refactor

# 1.5
* 30 Nov 2014
* Fix stupid fatal on activation due to wrong method call in init class

# 1.4
* 22 Nov 2014
* better init
* No more code duplication

# 1.3
* 18 Oct 2014
* fix responive and z-index

# 1.2
* 21 Sep 2014
* change wp_footer hook for appropriate hook wp_enqueue_script and use wp_localize_script() to pass vars on js
* Better performance with scripts in footer

# 1.1
* 31 Aug 2014
* Fix translation and make cookie bar design "unstyled"

# 1.0
* 29  Aug 2014
* Initial commit