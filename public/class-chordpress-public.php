<?php

/**
 * Public functionality of the plugin
 *
 * @link       https://www.lewe.com
 * @since      2.0.0
 *
 * @package    ChordPress
 * @subpackage ChordPress/public
 */

/**
 * Public functionality of the plugin.
 *
 * - Defines the plugin name and version
 * - Enqueues stylesheet and JavaScript
 * - Shortcode handlers
 *
 * @package    ChordPress
 * @subpackage ChordPress/includes
 * @author     George Lewe <george@lewe.com>
 */
class ChordPress_Public
{
    /**
     * The unique name (slug) of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of the plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the public stylesheets.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/chordpress-public.css', array(), $this->version, 'all');
    }

    /**
     * Register the public javascripts.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/chordpress-public.js', array('jquery'), $this->version, null);
        wp_enqueue_script($this->plugin_name . '-svguitar', plugin_dir_url(__DIR__) . 'global/js/svguitar.umd.js');
    }

    /**
     * Shortcode: chordpress.
     *
     * Shortcode arguments
     *   float=          Rendered text div float style: none/left/right. Default: none.
     *   format=         Whether to render the text or not: yes/no. Default: yes.
     *   hbnotation=     Whether to use H/B notation or not: yes/no. Default: no.
     *   interactive=    Interactive elements on page: yes/no. Default: no.
     *   transpose=      Positive number of semitones to transpose the chords. Default: 0.
     *
     * @param array $atts Array of settings from shortcode
     * @param string $content Content wrapped in shortcode
     * @return string            Formatted HTML to display on page
     */
    public function shortcode_chordpress($atts, $content = null, $tag = '')
    {
        $CPR = new ChordPress_Renderer();
        $output = '';

        /**
         * Get shortcode arguments and change to lower case
         */
        $atts = array_change_key_case((array)$atts, CASE_LOWER);
//        $this->dnd($atts);

        /**
         * Set shortcode argument defaults
         */
        $args = shortcode_atts(
            [
                'float' => 'none',
                'format' => 'yes',
                'hbnotation' => 'no',
                'interactive' => 'no',
                'transpose' => '0',
                'numerictranspose' => '0',
                'fixedinteraction' => '0',
            ],
            $atts,
            $tag
        );
//        $this->dnd($atts);
        $content = do_shortcode($content);

        /**
         * If no formatting is requested, get out of here and display the text as is
         */
        if ($args['format'] != 'yes') return "[chordpress]" . apply_filters('the_content', $content) . "[/chordpress]";

        /**
         * Check content
         */
        if (!is_null($content)) {
            /**
             * Initiate ChordPress properties
             */
            $CPR->setFloat($args['float']);
            if (isset($atts['hbnotation'])) $CPR->setHBNotation($atts['hbnotation']);
            if (isset($atts['hidechords'])) $CPR->setHideChords($atts['hidechords']);
            if (isset($atts['hidecomments'])) $CPR->setHideComments($atts['hidecomments']);
            if (isset($atts['hidecomposer'])) $CPR->setHideComposer($atts['hidecomposer']);
            if (isset($atts['hidesubtitle'])) $CPR->setHideSubtitle($atts['hidesubtitle']);
            if (isset($atts['hidetitle'])) $CPR->setHideTitle($atts['hidetitle']);
            if (isset($atts['hideyear'])) $CPR->setHideYear($atts['hideyear']);
            if (isset($atts['hidetranspose'])) $CPR->setHideTranspose($atts['hidetranspose']);
            if (isset($atts['hideprint'])) $CPR->setHidePrint($atts['hideprint']);
            if (isset($atts['showchordsheet'])) $CPR->setShowChordSheet($atts['showchordsheet']);
            if (isset($atts['showchordsheetontop'])) $CPR->setShowChordSheetOnTop($atts['showchordsheetontop']);
            if (isset($atts['numerictranspose'])) $CPR->setNumericTranspose($atts['numerictranspose']);
            if (isset($atts['fixedinteraction'])) $CPR->setFixedInteraction($atts['fixedinteraction']);
            $CPR->setInteractive($args['interactive']);
            $CPR->setTranspose($args['transpose']);

            /**
             * Break content into separate lines
             */
            $lines = explode("\n", $content);

            /**
             * Process the directives of the ChordPro text
             */
            $CPR->getDirectives($lines);

            /**
             * Process and return the whole thing
             */
            $output = $CPR->displayText($lines);
        }

        return $output;
    }

    /**
     * Shortcode: chordpress-chord.
     *
     * @param array $atts Array of settings from shortcode
     * @param string $content Content wrapped in shortcode
     * @return string              Formatted HTML to display on page
     */
    function shortcode_chordpress_chord($atts, $content = null, $tag = '')
    {
        $P = new ChordPress_Plugin();
        $C = new ChordPress_Chord();
        $id = $this->random_string(true);
        $output = '';

        /**
         * Get shortcode arguments and change to lower case
         */
        $atts = array_change_key_case((array)$atts, CASE_LOWER);

        /**
         * Set shortcode argument defaults
         */
        $args = shortcode_atts(
            [
                'chord' => '',
                'barre' => '',
                'fingers' => '',
                'frets' => '',
                'strings' => '',
                'position' => '',
                'title' => '',
                'tuning' => '',
            ],
            $atts,
            $tag
        );

        if (strlen($args['chord'])) {
            if ($post = get_post($args['chord'])) {
                /**
                 * Retrieve chord data from chord post
                 */
                $guitar_chord_barres = esc_html(get_post_meta($args['chord'], 'guitar_chord_barres', true));
                $guitar_chord_fingers = esc_html(get_post_meta($args['chord'], 'guitar_chord_fingers', true));
                $guitar_chord_frets = esc_html(get_post_meta($args['chord'], 'guitar_chord_frets', true));
                $guitar_chord_strings = esc_html(get_post_meta($args['chord'], 'guitar_chord_strings', true));
                $guitar_chord_position = esc_html(get_post_meta($args['chord'], 'guitar_chord_position', true));
                $guitar_chord_title = get_the_title($args['chord']);
                $guitar_chord_tuning = esc_html(get_post_meta($args['chord'], 'guitar_chord_tuning', true));

                /**
                 * Set chord properties
                 */
                $C->setBarres($guitar_chord_barres);
                $C->setProperty('fingers', $guitar_chord_fingers);
                $C->setProperty('frets', $guitar_chord_frets);
                $C->setProperty('position', $guitar_chord_position);
                $C->setProperty('strings', $guitar_chord_strings);
                $C->setProperty('title', $guitar_chord_title);
                $C->setTuning($guitar_chord_tuning);
            } else {
                /**
                 * Chord post not found. Return warning message.
                 */
                $alert_style = 'warning';
                $alert_title = __('ChordPress Warning', 'chordpress');
                $alert_text = __('There is no chord record with the ID ' . $args['chord'] . '.', 'chordpress') . ' ' . __('Please check your input or create a proper post for this chord first.', 'chordpress');
                $output = $P->alert($alert_style, $alert_title, 'strong', $alert_text, true, '98%');
                return $output;
            }
        } else {
            /**
             * Retrieve chord data from shortcode parameters
             */
            if (strlen($args['barre'])) $C->setBarres($args['barre']);
            if (strlen($args['fingers'])) $C->setProperty('fingers', $C->replace_brackets($args['fingers']));
            if (strlen($args['frets'])) $C->setProperty('frets', $args['frets']);
            if (strlen($args['position'])) $C->setProperty('position', $args['position']);
            if (strlen($args['strings'])) $C->setProperty('strings', $args['strings']);
            if (strlen($args['title'])) $C->setProperty('title', $args['title']);
            else $C->setProperty('title', __('No Title', 'chordpress'));
            if (strlen($args['tuning'])) $C->setTuning($args['tuning']);
        }

        $output = $C->createSvgChord();
        // $C->setProperty('titleBottomMargin', 80);
        // $output .= $this->create_modal_chord($args['chord'],$C->createSvgChord());

        return $output;
    }

    /**
     * Create a modal guitar chord dialog.
     *
     * @param integer $postid ID of the chord post
     * @param string $chord SVGuitar HTML
     * @return string                Modal chord dialog HTML
     */
    private function create_modal_chord($postid, $chord)
    {
        $modal_chord = '<button id="cpress-chord-' . $postid . '-modal-button">Click here to trigger the modal!</button>
        <div id="cpress-chord-' . $postid . '-modal" class="cpress-modal">
            <div class="cpress-modal-content">
                <span id="cpress-chord-' . $postid . '-modal-close" class="cpress-modal-close">&times;</span>
                ' . $chord . '
            </div>
        </div>
        <script>
        var cpress_' . $postid . '_modal = document.getElementById("cpress-chord-' . $postid . '-modal");
        var cpress_' . $postid . '_btn = document.getElementById("cpress-chord-' . $postid . '-modal-button");
        var cpress_' . $postid . '_close = document.getElementById("cpress-chord-' . $postid . '-modal-close");

        cpress_' . $postid . '_btn.onclick = function()   { cpress_' . $postid . '_modal.style.display = "block"; }
        cpress_' . $postid . '_close.onclick = function() { cpress_' . $postid . '_modal.style.display = "none"; }

        window.onclick = function(event) {
            if (event.target == cpress_' . $postid . '_modal) {
                cpress_' . $postid . '_modal.style.display = "none";
            }
        } 
        </script>';

        return $modal_chord;
    }

    /**
     * Find a guitar chord type post by shortname.
     *
     * @param string $shortname Shortname of the guitar post to look for.
     * @return integer                 Post ID or NULL
     */
    private function find_guitar_chord_post($shortname)
    {
        $query_args = array(
            'posts_per_page' => 1,
            'post_type' => 'guitar_chord',
            'meta_key' => 'guitar_chord_name',
            'meta_value' => $shortname
        );
        $query_result = new WP_Query($query_args);

        return $query_result->posts[0]->ID;
    }

    /**
     * Build a guitar chord from post ID.
     *
     * @param string $postid Post ID
     * @return string               SVGuitar HTML
     */
    private function build_guitar_chord_from_postid($postid)
    {
        /**
         * Retrieve chord data from chord post
         */
        $guitar_chord_barres = esc_html(get_post_meta($positid, 'guitar_chord_barres', true));
        $guitar_chord_fingers = esc_html(get_post_meta($positid, 'guitar_chord_fingers', true));
        $guitar_chord_frets = esc_html(get_post_meta($positid, 'guitar_chord_frets', true));
        $guitar_chord_strings = esc_html(get_post_meta($positid, 'guitar_chord_strings', true));
        $guitar_chord_position = esc_html(get_post_meta($positid, 'guitar_chord_position', true));
        $guitar_chord_title = get_the_title($positid);
        $guitar_chord_tuning = esc_html(get_post_meta($positid, 'guitar_chord_tuning', true));

        /**
         * Set chord properties
         */
        $C->setBarres($guitar_chord_barres);
        $C->setProperty('fingers', $guitar_chord_fingers);
        $C->setProperty('frets', $guitar_chord_frets);
        $C->setProperty('position', $guitar_chord_position);
        $C->setProperty('strings', $guitar_chord_strings);
        $C->setProperty('title', $guitar_chord_title);
        $C->setTuning($guitar_chord_tuning);

        return $C->createSvgChord();
    }

    /**
     * Generate random string.
     *
     * @param boolean $alphaonly - Whether to only use alpha charaters
     * @param integer $length - Length of random string to generate.
     * @return false|string
     */
    private function random_string($alphaonly = false, $length = 15)
    {
        if ($alphaonly) {
            return substr(str_shuffle(str_repeat($x = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
        } else {
            return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
        }
    }

    // ---------------------------------------------------------------------------
    /**
     * Dump and Die.
     *
     * @since 3.2.0
     * @param array $a Array to print out pretty
     * @param bool  $die Flag to die after dump or not
     * @return string
     */
    private function dnd($a, $die = true)
    {
        $dump = highlight_string("<?php\n\$data =\n" . var_export($a, true) . ";\n?>");
        if ($die) die($dump);
        else return $dump;
    }
}
