/**
 * TinyMCE Buttons
 *
 * Custom Javascript functions for adding menu buttons to TinyMCE.
 *
 * @link       https://www.lewe.com
 * @since      1.0.0
 *
 * @package    ChordPress
 * @subpackage ChordPress/admin/js
 */

(function () {

    tinymce.PluginManager.add('cpressbtn', function (editor, url) {

        //
        // Submenu Array
        //
        var menu_array = [];

        //
        // Chordpress
        //
        menu_array.push({

            text: "[chordpress]",
            value: '[chordpress float="none" format="yes" hbnotation="no" interactive="no" transpose="0"]%content%[/chordpress]',
            onclick: function () {
                var selected_text = editor.selection.getContent({ 'format': 'html' });
                return_text = this.value().replace("%content%", selected_text);
                editor.execCommand('mceReplaceContent', false, return_text);
            }

        });

        //
        // Chordpress Chord (ID)
        //
        menu_array.push({

            text: "[chordpress-chord] (Chord ID)",
            value: '[chordpress-chord chord="99"]',
            onclick: function () {
                var selected_text = editor.selection.getContent({ 'format': 'html' });
                return_text = this.value().replace("%content%", selected_text);
                editor.execCommand('mceReplaceContent', false, return_text);
            }

        });

        //
        // Chordpress Chord (Custom)
        //
        menu_array.push({

            text: "[chordpress-chord] (custom)",
            value: '[chordpress-chord fingers="(3,2,\'2\'),(4,3,\'4\'),(5,3,\'3\')" frets="5" title="F# Major" position=1 tuning="E,A,D,G,X,Y" barre="6,1,1"]',
            onclick: function () {
                var selected_text = editor.selection.getContent({ 'format': 'html' });
                return_text = this.value().replace("%content%", selected_text);
                editor.execCommand('mceReplaceContent', false, return_text);
            }

        });

        //
        // Separator
        //
        menu_array.push({

            text: "---",
            value: '',
            onclick: function () { }

        });

        //
        // Documentation
        //
        menu_array.push({

            text: "Documentation...",
            value: '',
            onclick: function () { window.open('https://lewe.gitbook.io/lewe-chordpress/', '_blank'); }

        });

        //
        // Add the submenu button
        //
        editor.addButton('cpressbtn', {

            title: 'ChordPress',
            type: 'menubutton',
            image: url + '../../images/icon-20x20.png',
            menu: menu_array

        });

        //
        // Single menu button
        //
        // editor.addButton('bsvbtn', {
        //    title: 'Bootstrap Visuals - Click button to add a Shortcoe',
        //    cmd: 'bsvbtn',
        //    image: url + '/bsvbtn.png',
        // });

        // editor.addCommand('bsvbtn', function() {
        //    var selected_text = editor.selection.getContent({
        //       'format': 'html'
        //    });
        //    var open_column = '[bs-alert]' + selected_text + '[/bsv-alert]';
        //    var close_column = '';
        //    var return_text = '';
        //    return_text = open_column + close_column;
        //    editor.execCommand('mceReplaceContent', false, return_text);
        //    return;
        // });

    });
})();