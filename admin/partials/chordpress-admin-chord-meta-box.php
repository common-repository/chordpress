<?php

/**
 * Chord content type meta box
 *
 * @link       https://www.lewe.com
 * @since      1.0.0
 *
 * @package    ChordPress
 * @subpackage ChordPress/admin/partials
 */

/**
 * If this file is called directly, abort.
 */
if (!defined('WPINC')) {
    die;
}

function display_guitar_chord_meta_box($guitar_chord)
{
    $C = new ChordPress_Chord();

    /**
     * Retrieve current values
     */
    if (!strlen($guitar_chord_name     = esc_html(get_post_meta($guitar_chord->ID, 'guitar_chord_name', true))))     $guitar_chord_name = '';
    if (!strlen($guitar_chord_barres   = esc_html(get_post_meta($guitar_chord->ID, 'guitar_chord_barres', true))))   $guitar_chord_barres = '';
    if (!strlen($guitar_chord_fingers  = esc_html(get_post_meta($guitar_chord->ID, 'guitar_chord_fingers', true))))  $guitar_chord_fingers = $C->getProperty('fingers');
    if (!strlen($guitar_chord_frets    = esc_html(get_post_meta($guitar_chord->ID, 'guitar_chord_frets', true))))    $guitar_chord_frets = $C->getProperty('frets');
    if (!strlen($guitar_chord_strings  = esc_html(get_post_meta($guitar_chord->ID, 'guitar_chord_strings', true))))  $guitar_chord_strings = $C->getProperty('strings');
    if (!strlen($guitar_chord_position = esc_html(get_post_meta($guitar_chord->ID, 'guitar_chord_position', true)))) $guitar_chord_position = $C->getProperty('position');
    if (!strlen($guitar_chord_tuning   = esc_html(get_post_meta($guitar_chord->ID, 'guitar_chord_tuning', true))))   $guitar_chord_tuning = 'E,A,D,G,B,E';

    /**
     * Prepare sample diagram
     */
    $C->setProperty('title', $guitar_chord->post_title);
    $C->setBarres($guitar_chord_barres);
    $C->setProperty('fingers', $C->replace_brackets($guitar_chord_fingers));
    $C->setProperty('frets', $guitar_chord_frets);
    $C->setProperty('position', $guitar_chord_position);
    $C->setProperty('strings', $guitar_chord_strings);
    $C->setTuning($guitar_chord_tuning);

    $leftwidth = "20%";
?>

    <div style="height:20px;"></div>
    <table>

        <tr>
            <td style="width: <?php echo $leftwidth; ?>; vertical-align:top;"><?php echo esc_html(__('Name', 'chordpress')); ?></td>
            <td>
                <input type="text" name="guitar_chord_name" value="<?php echo $guitar_chord_name; ?>" />
                <p class="description"><?php echo esc_html(__('Enter the short name of the chord here like you would use it in a ChordPro text. For example, you could title the post \'E minor\' but use \'Em\' as the short name.', 'chordpress')); ?></p>
            </td>
        </tr>

        <tr>
            <td style="width: <?php echo $leftwidth; ?>; vertical-align:top;"><?php echo esc_html(__('Base Fret', 'chordpress')); ?></td>
            <td>
                <select style="width: 100px" name="guitar_chord_position">
                    <?php for ($pos = 1; $pos <= 12; $pos++) { ?>
                        <option value="<?php echo $pos; ?>" <?php echo ($pos == $guitar_chord_position) ? " selected" : ""; ?>><?php echo $pos; ?>. fret</option>
                    <?php } ?>
                </select>
                <p class="description"><?php echo esc_html(__('At what fret shall the diagram start to draw?', 'chordpress')); ?></p>
            </td>
        </tr>

        <tr>
            <td style="width: <?php echo $leftwidth; ?>; vertical-align:top;"><?php echo esc_html(__('Number of Frets', 'chordpress')); ?></td>
            <td>
                <input type="number" maxlength="2" name="guitar_chord_frets" value="<?php echo $guitar_chord_frets; ?>" />
                <p class="description"><?php echo esc_html(__('Enter the number of frets to show in the chart.', 'chordpress')); ?></p>
            </td>
        </tr>

        <tr>
            <td style="width: <?php echo $leftwidth; ?>; vertical-align:top;"><?php echo esc_html(__('Number of Strings', 'chordpress')); ?></td>
            <td>
                <select style="width: 100px" name="guitar_chord_strings">
                    <option value="4" <?php echo ('4' == $guitar_chord_strings) ? " selected" : ""; ?>>4</option>
                    <option value="6" <?php echo ('6' == $guitar_chord_strings) ? " selected" : ""; ?>>6</option>
                </select>
                <p class="description"><?php echo esc_html(__('Select the number of strings. Default is 6.', 'chordpress')); ?></p>
            </td>
        </tr>

        <tr>
            <td style="width: <?php echo $leftwidth; ?>; vertical-align:top;"><?php echo esc_html(__('Tuning', 'chordpress')); ?></td>
            <td>
                <input type="text" name="guitar_chord_tuning" value="<?php echo $guitar_chord_tuning; ?>" />
                <p class="description"><?php echo esc_html(__('Labels under the strings for their tuning. Enter each note separated by a comma, e.g.', 'chordpress')); ?>: <code>E,A,D,G,B,E</code></p>
            </td>
        </tr>

        <tr>
            <td style="width: <?php echo $leftwidth; ?>; vertical-align:top;"><?php echo esc_html(__('Fingers', 'chordpress')); ?></td>
            <td>
                <input type="text" name="guitar_chord_fingers" value="<?php echo $guitar_chord_fingers; ?>" />
                <p class="description"><?php echo esc_html(__('Enter a triplet for each finger on a string, separated by a comma. Each triplet must be formatted as', 'chordpress')); ?>: <code>(string,fret,'text')</code><br>
                    <?php echo esc_html(__('Exmaple: (3,2,\'2\') => Third string (G), second fret, text \'2\'.', 'chordpress')); ?>
                </p>
            </td>
        </tr>

        <tr>
            <td style="width: <?php echo $leftwidth; ?>; vertical-align:top;"><?php echo esc_html(__('Barres', 'chordpress')); ?></td>
            <td>
                <input type="text" name="guitar_chord_barres" value="<?php echo $guitar_chord_barres; ?>" />
                <p class="description"><?php echo esc_html(__('Enter the barre information using this notation', 'chordpress')); ?>: <code>fromString,toString,fret</code><br>
                    <?php echo esc_html(__('Exmaple: 6,1,1 => Full barre in the first fret. 6 = lower E, 1 = higher E', 'chordpress')); ?>
                </p>
            </td>
        </tr>

        <tr>
            <td style="width: <?php echo $leftwidth; ?>; vertical-align:top;"><?php echo esc_html(__('Preview', 'chordpress')); ?></td>
            <td>
                <?php echo $C->createSvgChord(); ?>
                <p class="description">
                    <?php echo esc_html(__('The above diagram uses the', 'chordpress')); ?> <a href="admin.php?page=chordpress/admin/partials/chordpress-admin-options.php&tab=tab_chord" target="_blank"><?php echo esc_html(__('global guitar chord styles.', 'chordpress')); ?></a><br>
                    <?php echo esc_html(__('You might have to refresh, save or update your chord again for the preview to show.', 'chordpress')); ?>
                </p>
            </td>
        </tr>

        <tr>
            <td style="width: <?php echo $leftwidth; ?>; vertical-align:top;"><?php echo esc_html(__('Shortcode', 'chordpress')); ?></td>
            <td>
                <input type="text" size="36" value='[chordpress-chord chord="<?php echo $guitar_chord->ID ?>"]' id="chordpress-chord-shortcode" style="background-color:#f4f4f4;">
                <button type="button" class="cpress-btn cpress-btn-info cpress-btn-sm" onclick="copyToClipboard('chordpress-chord-shortcode')">Copy shortcode</button>
                <p class="description"><?php echo esc_html(__('Use this shortcode to display this chord in a post or page.', 'chordpress')); ?></p>
            </td>
        </tr>

    </table>

    <script>
        function copyToClipboard(domID) {
            var copyText = document.getElementById(domID);
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */
            navigator.clipboard.writeText(copyText.value);
            alert("Shortcode copied:\n" + copyText.value);
        }
    </script>

<?php

}
