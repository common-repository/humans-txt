=== Humans.txt ===
Contributors: hansvedo
Tags: credits, authors, humanstxt, robots
Requires at least: 3.0.1
Tested up to: 3.2.1
Stable tag: 1.2

A plugin to create a humans.txt (humanstxt) file that credits the developers and designers of a website.

== Description ==

Featured on the Humans.txt official website: <a href="http://humanstxt.org/H-team.html">humanstxt.org/H-team.html</a>

Humans.txt lets you credit the designers and developers of a website project.

It's based on the standard being developed by <a href="http://humanstxt.org">humanstxt.org</a>

Plugin Homepage: <a href="http://cultivate.it/apps/humans-txt-wordpress-plugin/">Humans.txt WordPress Plugin</a>

= Features =
* Clickable suggestions make building up your Humans.txt file a breeze.
* Use a [humanstxt] or [humanstxt_nested_list] shortcode to format your humans.txt file nicely on your page.
* Automatically adds the AUTHOR META tag to your WordPress theme's HEAD tag.
* Add your humans.txt file without needing FTP to upload and download files.
* TAB key support in the textarea field.

= Translations =
* German (de_DE): <a href="http://twitter.com/jhermsmeier">Jonas Hermsmeier</a>
* Norwegian (nb_NO): <a href="http://twitter.com/cultivateIT">Hans Vedo</a>
* Spanish (es_ES): <a href="http://www.cssbarcelona.com">Juanjo Bernabeu</a>

== Frequently Asked Questions ==

= What is Humans.txt? =
An initiative to know the creators of the website.

= What does the Humans.txt format look like? =
Currently it's quite flexible in how you define roles.  You can find the current standard here:
<a href="http://humanstxt.org/humans.txt">http://humanstxt.org/humans.txt</a>

= Does this plugin write a humans.txt file on the server? =
No. This plugin actually serves the humans.txt content from the WordPress database.

= What if I've already uploaded a humans.txt file? =
If you've uploaded your own humans.txt, that will actually override the content entered here.  You can just rename your existing humans.txt file to humans-backup.txt and use the plugin normally.

= Where is the plugin content stored? =
The content is saved in the WordPress database in an option called "humanstxt_text".

= Why isn't the AUTHOR META tag being added to my website? =
Ensure your theme uses the wp_head() function.

== Screenshots ==

1. screenshot-1.png: The humans.txt text editor
1. screenshot-2.png: Shortcode instructions

== Installation ==

= Via WordPress: =
1. Select Plugins/Add New in the WordPress administration area.
2. Search for Humans.txt
3. Install and select "Settings"

= Download and Upload: =
1. Download the plugin files.
2. Upload the plugin's folder to the "/wp-content/plugins/" directory
3. Activate the plugin through the "Plugins" menu in WordPress
4. Select "Settings"

== Changelog ==

= 1.2 =
* Clickable suggestions: Editors can now simply click suggested designers and contributors to add them.
* Nested lists: The shortcode can now output a nested list for easy styling with CSS (code contributed by <a href="https://twitter.com/#!/tometaxu">James Walker</a>).

= 1.1 =
* Translations: German, Norwegian, and Spanish
* Shortcode support to automatically parse and display humans.txt content on a given page.
* Bug fix: Slashes now stripped from output.

= 1.0 =
* Launched