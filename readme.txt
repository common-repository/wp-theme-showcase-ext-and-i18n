=== Plugin Name ===
Contributors: GeorgWP
Donate link: 
Tags: showcase, theme gallery, theme preview, preview, demo
Requires at least: 2.9
Tested up to: 3.0
Stable tag: 2.5.9

WP Theme Showcase ext and i18n displays themes and info from their style.css with one or two indices. Lots of features and options and a widget.

== Description ==

*WP Theme Showcase ext and i18n* (*Showcase ext* for short) displays a thumbnail index and/or a name index and then an image, a screenshot, of each theme together with information from the style.css file and user-defined files. A theme showcase with a wealth of features and &ndash; illustrated &ndash; options, *Showcase ext* was originally based on Brad Williams' [WordPress Theme Showcase Plugin](http://wordpress.org/extend/plugins/wordpress-theme-showcase-plugin). Enter <strong>[showcaseext]</strong> in a post or page to display WP Theme Showcase ext and i18n. Localization support.

*Showcase ext* has a widget that displays a theme thumbnail and a link to the showcase proper, if *Showcase ext* and the widget are set up with the necessary features and options. You can customize the text and update frequency for the widget in the widget control. *Showcase ext* comes fully prepared for CSS customization.

*Showcase ext* is able to display WP themes using the standard screenshot.png files and the information contained within the style.css files. However, *Showcase ext* is especially useful for displaying localized and/or translated themes (this is how I use it myself). Out of the box, it assumes that you have created your own screenshots in three different sizes. You can configure the filenames (incl. the extensions) to your liking, however.

This readme presupposes the default configuration, but almost everything can be changed by admin (see below).

*Showcase ext* is able to display one or two indices (two different Table of Contents). One displays thumbnails, the other lists the theme names as links.

The thumbnail index displays table with thumbnails that are linked to the presentation of each theme in the showcase proper. The showcase proper displays all &ndash; or selected &ndash; themes located in wp-content/themes with the standard or with a user-defined picture with links to an even larger theme image. If no screenshots are present, a placeholder will be shown. It also displays a number of entries from the style.css file or from user-defined files (see below). In addition, *Showcase ext* is able to add links to additional screenshots and readme files, if they exist. You must enter the filenames that you want *Showcase ext* to look for (the activation routine adds five readme filenames, if no *Showcase ext* options (version 2.5+) are present in your WordPress database).

*Almost everything* can be changed, either in the settings, which change the HTML produced by the script, or by modifying the CSS file used by the plugin. It is even possible to replace the descriptions of the themes and add separate download instructions and links from user-defined text files. UTF-8 is recommended. Options also include user-defined theme image filenames.

*Showcase ext* stores a number of default options in the WordPress database when activated first time. *Showcase ext* includes functions to reset or delete its options upon deactivation.

It is possible to get an extensive debug-report with variables, arrays, filenames etc., which makes it easier to pinpoint why a given file is not found (or where a bug may have hidden itself).

Localization is supported. You are welcome to translate the plugin. :-)

== Installation ==

1. Upload 'wp-theme-showcase-ext-and-i18n' folder to '/wp-content/plugins/' directory
1. Activate the plugin through the 'Plugins' menu in WordPress. The plugin creates the necessary default options, but be sure to enter all necessary information for the features you activate. Go to the plugin options and choose Hide themes, if you need to hide one or more themes.
1. Enter [showcaseext] in a page or post where you want to display the showcase. You can, of course, add your own text, e.g., an introduction before and/or after the shortcode.
1. Configure the plugin via the Appearance/Theme submenu and unleash its full power. You can change the appearance of the name and/or thumbnail index and customize some user instructions. Many other options are available.
1. Edit the showcaseext.css file if you want to change the appearance of the output.
1. If you want to display your own theme descriptions (e.g., because you have translated those included in the style.css of each theme and saved your translations separately), then you must create a directory for these files under wp-content and name it as specified in the Options.
1. If you want to display download instructions, you can do so by creating another directory under wp-content and placing the files you create for this purpose in this directory. See the Options page for instructions for naming these files. You can also let the plugin generate links to Download Monitor downloads.
1. If you want to use the sidebar widget, then a number of conditions must be met. Firstly, you must use thumbnails that fit the sidebar. Secondly, you *must* enter a page id for the page or post where the showcase is displayed. The page id is shown in the status bar if you hover the mouse over an Edit page link or button. *Showcase widget* will only display a new theme after at least 20 minutes (note, however, that this value and the widget screen texts can be changed in the widget control). Although you can add more than one Showcase widget, currently, they will display the same theme image for the time being, as the necessary code is generated by the plugin. This means that you must view your showcase at least once in order to generate code for the widget.

*WP Theme Showcase ext and i18n* employs three different image sizes (if optimally configured; in the default options, 'screenshot.png' is used for all three image sizes). The showcase proper, which displays all the uploaded themes with a user-defined number of pieces of information (if available), makes use of medium-size screenshot files. *Showcase ext* creates one or two indices, "Table of Contents," that employ small-size screenshot files, "thumbnails." I have found that 100x100px images fit well in the thumbnail index.

If the user clicks the medium-size screenshot files, if optimally set up, he will be shown large pictures for a closer inspection of the design of the theme. If Shutter Reloaded or a compatible plugin is activated, the users may browse all the large pictures as a set. It is the responsibility of admin to provide these images. It is also possible to preview the theme with the content from the current blog.

If admin enters multiple user-defined filenames for the medium-size screenshots, *Showcase ext* will loop through these filenames and use the first filename that matches an existing file, as the theme image of the showcase proper. Optionally, it will add links to any additional image files found. If no screenshot is found, a placeholder is used.

*Showcase ext* can search for a number of readme filenames (the Options page provides a sample of such filenames, of which five are chosen upon first-time activation). You can modify the list in the Options. *Showcase ext* will create a link for each existing readme file, in the order of the filenames entered. This is useful, e.g., if translations of the readme files are available. Of course, the same feature can  display links to license and changelog files (see my site for an example).

A later version may allow admin to enter additional directories for theme images (note that WP 2.9 supports this now; it should work with this version of the plugin as well) and readme files (thus allowing admin to keep his own files in a separate directory), especially if you tell me that you need it.

== Frequently Asked Questions ==

= Can I style the showcase and/or the widget? =

Yes. The generated HTML code includes a number of divisions, classes and id's that allow for CSS styling (see below).

If you want to style *Showcase ext*, I recommend [Firebug](http://getfirebug.com/ "A wealth of web development tools at your fingertips") as an invaluable tool.

There are four or even five divisions in the HTML output. The whole ordinary output is inside the showcaseext div's. Inside this division are three divisions: one for the thumbnail index, one for the name index, and one for the showcase proper that displays all the available themes with a configurable number of pieces of additional information. Inside the showcase division, each theme is enclosed in div tags with the class name 'theme'. See all the main selectors in the included showcaseext.css file.

The two included Shutter set classes are mentioned for your information. You should probably let Shutter Reloaded or a compatible plugin style these classes.

= Do I really need three different screenshot sizes? =

Well, yes and no. The design of the plugin assumes that you have three different sizes as explained under Installation. The thumbnail index and the theme showcase will look better if you use small thumbnails for the index and medium-size images for the showcase proper. Use of full-size screenshot is optional, however.

However, it *is* possible to use the plugin with only one screenshot size, indeed, with the standard screenshots included with themes from the WordPress theme repository. The only requirement is that the filename of the screenshots is the same for each size, e.g., screenshot.png or screenshot.jpg.

Even if you use only one or two screenshot sizes, the display of the full-size images provides extra functionality, if Shutter Reloaded or a compatible plugin is active. Then it is easy to flip through all the full-size screenshots.

= Does it run under WP 2.8? =

No, it does not, as the handling of the available themes has changed with WP 2.9. Upgrade to WP 2.9. If you, for some reasons, need to run *Showcase ext* under WP 2.7 or 2.8, then go to the plugin homepage and download the legacy version. The legacy version is tested under WP 2.8 and has no issues known to me.

= How do you translate the theme description? =

The plugin does not translate the description. You have to translate the Description field in the comment section of the style.css. *Or* you can configure *Showcase ext* to use a translation from a separate file.

= Why have you written this plugin? =

The primary reason is that I needed *WP Theme Showcase ext and i18n* for [my WordPress portal](http://wordpress.blogos.dk/ "WP tips, themes and plugins"). A second reason is that a real project makes it funnier to learn PHP etc.

= My own images or texts do not show up? =

Check if the features you are missing are enabled in the Options page.

Then try to enable the debug mode and check if the plugin looks for the right files in the right directories. If not, change the options and/or the filenames/directories to ensure a match. If you are sure that you have found a bug, go to the plugin page and file a report.

= Showcase ext disappears altogether, when I enable one feature or another? =

This was a problem with version 1.5.1 and earlier. Hopefully, it is now solved. However, if you experience this problem, try to disable Include Shutter class options. If *Showcase ext* still disappears, watch out for other plugins. *Showcase ext* *may* disappear due to a conflict with other plugins. If you have tried to disable each and every plugin, and the problem still persists, then file a bug report on the plugin homepage. Please, include a debug report and a description of what you did that caused the error.

= The variable for number of themes is wrong. What can I do? =

If you delete a theme that it marked as hidden, *Showcase ext* will detect it and print a Warning. But, currently, you have to help it update the number and names of themes marked to be hidden. On the plugin options page, go to Hide themes and click Save changes. This will update the number and names of hidden themes.


== Screenshots ==

1. Name index and thumbnail index.
2. The Showcase proper, here shown with Description and Download instruction read from separate user-defined files. All other entries are extracted from the style.css file belonging to each theme.
3. Indices options
4. Theme information options
5. User-defined theme descriptions and download instructions
6. Various options
7. Debug mode and configuration
8. Widget

== Translations ==

*WP Theme Showcase ext and i18n* is fully internationalized. If a language file for the current locale exists in the plugin directory, it will be used.

If no language file is available for your locale, you are welcome to translate it, using a program like [poEdit](http://www.poedit.net). If you notify me, I will link to your translation here. Thank you very much!

Available Translations

* [Danish](http://wordpress.blogos.dk), by myself

== Changelog ==

= 2.5.6 =
Verified 3.0 compatibility

= 2.5.3 =
Fixed debugging and debug-reports as well as a couple option names.

= 2.5.2 =

* The bug fix in 2.5.1 had side effects. I have implemented another, better solution. You now again have to select which themes you want to *hide*, not show, in the showcase. The internal changes in 2.5.1 was also dropped.

= 2.5.1 =

* Fixed the bug that the showcase disappeared if no theme was selected for being hidden. Now you have to select which themes you want to show in the showcase.

* Various internal changes.

= 2.5 =

* Only displays credits with external links, if admin has enabled it. Please, enable it! It links to my site, which is 100% non-commercial.

* *Showcase ext* now has options to hide themes from being shown in the showcase.

* *Showcase ext* now uses a registered shortcode, which will allow for multiple instances on the same page with different parameters. In version 2.5, shortcode parameters are *not yet* supported.

* Plugin options page is illustrated so that it is easier to use. It also supports whitelisting.

* *Showcase ext* is now able to display a user-defined links section read from a text file.

* Added Showcase Widget with options

* Added some data validation functions for filenames and directories

* Removed the instruction to use UTF-8 encoded files for user-defined theme description and download instruction files. Other encodings may work on your server. However, I recommend that you do use UTF-8 encoded files, as this is the WP standard.

* The debugging report was rewritten and greatly extended.

* Valid XHTML 1.0 Transitional (hopefully). Note that there are so many features and options that it is virtually impossible for me to check all combinations. Please, notify me if you find a bug.

* CSS class 'theme_readmelink' renamed to 'theme_readmelinks'

* A lot of changes that I do not really remember. Sorry about that.

= 1.5.1 =

*Bugfix in the activation database

= 1.5 =

* Now supports user-defined theme descriptions and download instructions.

* Now supports multiple user-defined screenshot filenames for display of theme image.

* Links may be displayed for available screenshots not used for the theme image.

* Now supports user-defined readme filenames. Readme links are only displayed if a given filename exists.

* Added optional extensive debug report, either appended to the showcase or as a separate HTML file.

* Added optional function to complete last row of thumbnail index table.

= 1.00 =

Initial public release

== Upgrade Notice ==

= 2.5.3 =
Various bugfixes for version 2.5, 2.5.1 and 2.5.2.

= 2.5 =
Support for WP 2.9. New widget-support. Hide themes from being viewed. Added placeholder for missing thumbnails etc. Added activation and deactivation routines. Debugging features extended. Several features added (but still no pagination, sorry).