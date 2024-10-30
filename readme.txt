=== Lewe ChordPress - ChordPro Text Formatter ===
Contributors: glewe,rlisle
Donate link: https://www.paypal.me/GeorgeLewe
Tags: chordpro,chord,chords,lyrics,music,notes,sheet,sound,guitar
Requires at least: 4.0
Tested up to: 6.5
Stable tag: 3.6.2
Requires PHP: 5.2.4
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.html

Lewe ChordPress for WordPress pretty-prints ChordPro formatted text and chord diagrams on your pages or posts.

== Description ==
Lewe ChordPress pretty-prints ChordPro formatted text files on your pages and posts. You can configure output and formatting options. With 'interactive' mode on, you can transpose the chords up and down and also print the output right from the page.

Lewe ChordPress supports [SVGuitar](https://github.com/omnibrain/svguitar "SVGuitar chord renderer") for visual chord representation.

Your input to Lewe ChordPress needs to be a valid ChordPro formatted text. ChordPro is a simple text-based syntax used to write lead sheets, the lyrics and chords of a song. ChordPro also comes with a command line tool that pretty prints that text into other formats like PDF.
You can read all about ChordPro here:
[ChordPro](https://www.chordpro.org/chordpro/ChordPro-File-Format-Specification.html "ChordPro file format specification")

The Lewe ChordPress plugin allows to put ChordPro text inside its shortcode tags on a page or post and will pretty print it when the web page is displayed.

Simply insert a ChordPro text inbetween the [chordpress] and [/chordpress] tags and it will be rendered based on the default options of the plugin. You can change output and formatting settings on the plugin's admin page.

A TinyMCE editor integration is also included, providing an editor menu button to insert the shortcode for you with its default paramaters, e.g. wrapping it around selected text.

The `[chordpress]` shortag allows specifying custom options for rendering ChordPro texts. For example:

1. `[chordpress transpose="1"]` will transpose the chords rendered by one semitone.
2. `[chordpress interactive="yes"]` will allow you to transpose the chords up and down and also print the output right from the rendered page.

Check out this example:
[Lewe ChordPress Demo](https://sayandsound.lewe.com/heart-of-gold/ "Lewe ChordPress Demo")

The `[chordpress-chord]` shortag allows you to display a guitar chord as a diagram. For example:

1. `[chordpress-chord chord="112"]` will show the guitar chord post with ID 112 as a diagram.
2. `[chordpress-chord barre="5,1,1" fingers="(3,2,'2'),(4,3,'4'),(5,3,'3')" title="F# Major" tuning="E,A,D,G,H,E"]` will show a custom guitar chord.

Check out this example:
[Lewe ChordPress Guitar Chord Demo](https://sayandsound.lewe.com/guitar-chords/ "Lewe ChordPress Guitar Chord Demo")

If not from the WordPress marketplace, get the plugin here:
[Lewe ChordPress Homepage](https://www.lewe.com/chordpress/ "Lewe ChordPress Homepage")

== Features ==
* renders the lyrics/chord format of ChordPro
* configure output and formatting
* transpose up and down on the fly from the rendered page
* print the rendered output
* show chord diagrams

Lewe ChordPress supports the following ChordPro tags:

* `{album}`
* `{artist}`
* `{composer}`
* `{subtitle}`
* `{title}`
* `{year}`
* `{meta}` for all of the above

Lewe ChordPress supports custom CSS for the following ChordPro tags:

* `{comment}`
* `{start_of_chorus}`, `{end_of_chorus}`
* `{start_of_verse}`, `{end_of_verse}`

Lewe ChordPress supports note/chord translations

* Chord transponation
* [H/B Notation](https://sayandsound.lewe.com/note-h/)

== Usage ==
1. Enter a `[chordpress]` shortcode in your page or post editor
2. Paste your ChordPro text right after it
3. Enter the closing `[/chordpress]` shortcode

Optional shortcode parameters

* `float=`  Forces the rendered text block to float left or right.
* `hbnotation=`  [Input is H/B notation](https://sayandsound.lewe.com/note-h/) (using H for B and Bb for B). Wether it is displayed as such is defined on the Options page.
* `interactive=`  Enables interactive mode. A listbox will be shown on the right of the title that allows you to transpose the chords on the fly. Also, a print button will be shown fopr printing out the rendered ChordPro text.
* `transpose=`  Enter a positive or negative number for the amount of semitones to transpose the chords

Use the "Lewe ChordPress" admin menu of your backend to change the default settings.

== Documentation ==
[Lewe ChordPress User Manual](https://lewe.gitbook.io/lewe-chordpress/ "Lewe ChordPress User Manual")

== Support ==
Choose your preferred support channel:
1. [Wordpress Support Forum](https://wordpress.org/support/plugin/chordpress/ "Wordpress Support Forum")
2. [Lewe Service Desk](https://georgelewe.atlassian.net/servicedesk/customer/portal/5 "Lewe Service Desk")
4. [Lewe ChordPress User Manual](https://lewe.gitbook.io/lewe-chordpress/ "Lewe ChordPress User Manual")

== Credits ==
* The [ChordPro](https://profiles.wordpress.org/rlisle/ "ChordPro") team of course
* [@rlisle](https://profiles.wordpress.org/rlisle/ "@rlisle") for his work on the ChordsAndLyrics plugin that he created in 2009
* Ahkâm for the beautiful [Lewe ChordPress Plugin Icon](https://www.freeiconspng.com/img/17579 "Lewe ChordPress Plugin Icon")
* The developers of the [SVGuitar](https://github.com/omnibrain/svguitar "SVGuitar") chord rendering module

== Screenshots ==
1. Lewe ChordPress Output Options
2. Chord Diagram Options
3. Shortcut with ChordPro text in editor
4. Rendered text on webpage
5. Optional chord sheet for each song

== Frequently Asked Questions ==
= Why are empty ChordPro lines not rendered ? =
Empty lines are stripped from shortcode content and are not passed to the plugin. A good way to work around that is to use the {start_of_verse}/{start_of_chorus} tags and give them a top/bottom margin on the options page.
= What is the H/B notation ? =
The H/B notation uses H instead of B and B is used insetad of Bb. This notation is used in some European countries. Read more about it here: [H/BN Notation](https://sayandsound.lewe.com/note-h/ "H/B Notation").

== Installation ==
= Backend Installation =
1. Go to Plugin page
2. Click Add New
3. Enter "chordpress" in search field
4. Install and Activate

= Manual Installation =
1. Download the plugin ZIP file from [here](https://wordpress.org/plugins/chordpress/ "Download Lewe ChordPress...")
2. Unpack the ZIP file locally
3. Upload the 'chordpress' folder to your '/wp-content/plugins/' directory
4. Activate the plugin on the 'Plugins' page of your WordPress backend

== Changelog ==
= 3.6.2 =
* 2024-04-17
* Added '1' - '9' as allowed chord prefix

= 3.6.1 =
* 2024-04-09
* WordPress 6.5 compatibility
* Added '-' as allowed chord prefix

= 3.6.0 =
* 2023-11-15
* Added alternative transpose input (numeric plus/minus)
* Added interactive font size change (percentage plus/minus)
* Fixed Print button

= 3.5.2 =
* 2023-09-21
* Fixed unclosed div bug

= 3.5.1 =
* 2023-09-17
* Ghost barres bugfix in chord sheet

= 3.5.0 =
* 2023-09-16
* Added support for monospace sections
* Added support for Italian key names
* Made output options available as shortcode params as well

= 3.4.1 =
* 2023-08-22
* Fixed randomly missing chords in cord sheet

= 3.4.0 =
* 2023-03-09
* Allow "yes", "1" and "true" for shortcode parameters
* Updated delete function (option to delete settings and chord posts)

= 3.3.3 =
* 2023-03-04
* Corrected some chord shortnames
* Allow multiple interactive songs on one page

= 3.3.2 =
* 2023-02-26
* Async GuitarChord draw

= 3.3.1 =
* 2023-01-16
* Support for more special characters iun chords: ~, |, /, .

= 3.3.0 =
* 2022-12-22
* Added a set of 84 common guitar chords

= 3.2.1 =
* 2022-10-15
* Updated documentation and support link

= 3.2.0 =
* 2022-10-11
* Added VI7 and vi7 to the bluegrass chords
* Changed display name of plugin to 'Lewe ChordPress'

= 3.1.2 =
* 2022-07-10
* Added custom line CSS

= 3.1.1 =
* 2022-07-05
* Rendering bugfix

= 3.1.0 =
* 2022-07-05
* When 'Key' is given, transpose shows new key

= 3.0.4 =
* 2022-06-12
* WordPress 6.0 compatibility check

= 3.0.3 =
* 2022-01-26
* WordPress 5.9 compatibility check

= 3.0.2 (2021-11-03) =
* Transpose and print can now be hidden in interactive mode

= 3.0.1 (2021-10-17) =
* Fixed a bug for chord formatting in the rendered song
* Added 'No chords' in the transpose listbox

= 3.0.0 (2021-10-08) =
* Removal of the Vexchjord module
* Removal of the jTab module
* Introduction of the SVGuitar module
* Minor bugfixes
* Options page overhaul

= 2.5.4 (2021-09-13) =
* jTab formatting fix
* Plugin Info tab in admin backend

= 2.5.3 (2021-09-10) =
* Minor bug fixes
* Notification about rtetiring the Vexchords module

= 2.5.2 (2021-08-31) =
* Added support for nested shortcodes
* Added missing term langage support

= 2.5.1 (2021-08-08) =
* Added missing class file

= 2.5.0 (2021-08-05) =
* jTab support

= 2.4.2 (2021-08-05) =
* Number of strings bugfix

= 2.4.1 (2021-07-19) =
* WordPress 5.8 compatibility

= 2.4.0 (2021-01-06) =
* Added Bluegrass and Nashville chord notation

= 2.3.1 (2020-11-07) =
* Fixed barre bug in chord sheet

= 2.3.0 (2020-08-10) =
* Any CSS now for chords and lyrics

= 2.2.0 (2020-06-06) =
* Directive support for capo, key, time, tempo
* Chord sheet on top option

= 2.1.0 (2020-02-23) =
* Vexchords support
* Chord diagrams

= 2.0.0 (2020-01-26) =
* Completely rewritten plugin framework
* Adeded option to remove plugin data from database when it is deleted
* Added language translation support
* Character '~' can now be used in chord brackets as chord placeholder or strumming indicator
* Fixed TinyMCE ChordPress menu shortcut bug

= 1.5.0 =
* Reworked the options page and fixed the tab save bug

= 1.4.0 =
* Added print feature for interactive mode

= 1.3.0 =
* Added interactive mode

= 1.2.0 =
* Fixed duplicate plugin entry bug
* Reworked the plugins settings page
* Added TinyMCE integration

= 1.0.5 =
* Updated documentation and support links
* Compatibility: WordPress 5.3.2

= 1.0.4 =
* Fixed: Bass notes were not rendered correctly, e.g. A/C#
* Compatibility: WordPress 5.1

= 1.0.3 =
* Readme update

= 1.0.2 =
* Added screenshots, icons and banners

= 1.0.1 =
* Fixed hard coded image path

= 1.0.0 =
* Initital development for http://sayandsound.lewe.com

== Upgrade Notice ==
= 3.2.0 =
Enjoy 84 common guitar chords ready to add as Guitar Chord post...
