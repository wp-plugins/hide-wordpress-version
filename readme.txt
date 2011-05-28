=== Hide WordPress Version ===
Contributors: Kawauso
Tags: version, security, paranoia
Requires at least: 3.0
Tested up to: 3.1
Stable tag: 1.0

Hides your WordPress version from prying eyes.

== Description ==

Removes the WordPress version string from:

* The `$wp_version` global variable (frontend only)
* Generator tag output (removed entirely)
* Admin dashboard footer (non-admins)
* Scripts and stylesheets enqueued without a version declared
* HTTP queries
* XML-RPC responses
* Pingbacks
* Bloginfo() calls

<strong>Note:</strong> Security through obscurity is no alternative to real security. Always keep your WordPress install and all plugins/themes up-to-date.

<strong>Note 2:</strong> It is still possible to determine reasonably accurately what version a WordPress site is running with appropriate know-how. This just makes it harder.

== Installation ==

1. Upload `hide-wordpress-version.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Will this make my install secure? =
No. You still need to keep up-to-date with the latest WordPress version. This plugin will stop those less knowledgeable from finding out your version, but it is still possible to find this out.

== Changelog ==

= 1.0 =
* First public release