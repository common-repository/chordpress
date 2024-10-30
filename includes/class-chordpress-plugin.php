<?php

/**
 * Plugin core class serving both, public and admin functionalities.
 *
 * This is used to define internationalization, public and admin hooks.
 * It maintains the unique identifier of this plugin as well as the current
 * version of the plugin and other plugin-wide attributes.
 *
 * @since      2.0.0
 * @package    ChordPress
 * @subpackage ChordPress/includes
 * @author     George Lewe <george@lewe.com>
 * @link       https://www.lewe.com
 */
class ChordPress_Plugin
{
    /**
     * HTML heading levels.
     *
     * @since    1.0.0
     * @access   protected
     * @var      array     $heading_levels    Array of HTML heading levels.
     */
    protected $heading_levels = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'strong');

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      ChordPress_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * Array of option names.
     *
     * @since    1.0.0
     * @access   protected
     * @var      array        $plugin_name    Array of option names.
     */
    protected $options = array();

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The unique prefix of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_prefix    The prefix to uniquely identify this plugin.
     */
    protected $plugin_prefix;

    /**
     * The title of of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_title    The title of this plugin.
     */
    protected $plugin_title;

    /**
     * The URI of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_uri    The prefix to uniquely identify this plugin.
     */
    protected $plugin_uri;

    /**
     * Bootstrap alert box styles.
     *
     * @since    1.0.0
     * @access   protected
     * @var      array     $styles    Array of Bootstrap 4 styles.
     */
    protected $styles = array('danger', 'dark', 'info', 'light', 'primary', 'secondary', 'success', 'warning');

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    //--------------------------------------------------------------------------
    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    2.0.0
     */
    public function __construct()
    {
        if (defined('CHORDPRESS_VERSION')) {
            $this->version = CHORDPRESS_VERSION;
        } else {
            $this->version = 'n/a';
        }

        $this->plugin_title = 'ChordPress';
        $this->plugin_name = 'chordpress';
        $this->plugin_prefix = 'cpress';
        $this->plugin_uri = 'https://lewe.gitbook.io/lewe-chordpress/';
        $this->plugin_donation_uri = 'https://www.paypal.me/GeorgeLewe';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
        $this->load_tinymce_buttons(); // Comment out if you don't need

        $this->options = array(

            $this->plugin_name . '_checkbox_fixed_interaction',
            $this->plugin_name . '_checkbox_hide_album',
            $this->plugin_name . '_checkbox_hide_artist',
            $this->plugin_name . '_checkbox_hide_chords',
            $this->plugin_name . '_checkbox_hide_comments',
            $this->plugin_name . '_checkbox_hide_composer',
            $this->plugin_name . '_checkbox_hide_print',
            $this->plugin_name . '_checkbox_hide_subtitle',
            $this->plugin_name . '_checkbox_hide_title',
            $this->plugin_name . '_checkbox_hide_transpose',
            $this->plugin_name . '_checkbox_hide_year',
            $this->plugin_name . '_checkbox_hb_notation',
            $this->plugin_name . '_checkbox_show_chord_sheet',
            $this->plugin_name . '_checkbox_show_jtab_sheet',
            $this->plugin_name . '_checkbox_show_chord_sheet_on_top',
            $this->plugin_name . '_checkbox_show_numeric_transpose',

            $this->plugin_name . '_select_title_level',
            $this->plugin_name . '_select_subtitle_level',
            $this->plugin_name . '_text_meta_style',
            $this->plugin_name . '_text_chord_style',
            $this->plugin_name . '_text_lyrics_style',
            $this->plugin_name . '_text_comment_style',
            $this->plugin_name . '_text_chorus_style',
            $this->plugin_name . '_text_verse_style',
            $this->plugin_name . '_text_line_style',

            $this->plugin_name . '_text_chord_backgroundColor',
            $this->plugin_name . '_number_chord_barreChordRadius',
            $this->plugin_name . '_text_chord_barreChordStrokeColor',
            $this->plugin_name . '_number_chord_barreChordStrokeWidth',
            $this->plugin_name . '_number_chord_canvasWidth',
            $this->plugin_name . '_text_chord_color',
            $this->plugin_name . '_number_chord_emptyStringIndicatorSize',
            $this->plugin_name . '_checkbox_chord_fixedDiagramPosition',
            $this->plugin_name . '_text_chord_fontFamily',
            $this->plugin_name . '_text_chord_fretColor',
            $this->plugin_name . '_text_chord_fretLabelColor',
            $this->plugin_name . '_text_chord_fretLabelColor',
            $this->plugin_name . '_select_chord_fretLabelPosition',
            $this->plugin_name . '_number_chord_fretLabelFontSize',
            $this->plugin_name . '_number_chord_frets',
            $this->plugin_name . '_number_chord_fretSize',
            $this->plugin_name . '_number_chord_nutSize',
            $this->plugin_name . '_text_chord_nutColor',
            $this->plugin_name . '_text_chord_nutStrokeColor',
            $this->plugin_name . '_number_chord_nutStrokeWidth',
            $this->plugin_name . '_text_chord_nutTextColor',
            $this->plugin_name . '_number_chord_nutTextSize',
            $this->plugin_name . '_number_chord_position',
            $this->plugin_name . '_number_chord_sidePadding',
            $this->plugin_name . '_text_chord_stringColor',
            $this->plugin_name . '_select_chord_strings',
            $this->plugin_name . '_number_chord_strokeWidth',
            $this->plugin_name . '_select_chord_style',
            $this->plugin_name . '_number_chord_titleBottomMargin',
            $this->plugin_name . '_text_chord_titleColor',
            $this->plugin_name . '_number_chord_titleFontSize',
            $this->plugin_name . '_number_chord_topFretWidth',
            $this->plugin_name . '_text_chord_tuning',
            $this->plugin_name . '_text_chord_tuningsColor',
            $this->plugin_name . '_number_chord_tuningsFontSize',

            $this->plugin_name . '_checkbox_uninstall_delete_options',
            $this->plugin_name . '_checkbox_uninstall_delete_chordposts'

        );
    }

    //--------------------------------------------------------------------------
    /**
     * Load the required dependencies for this plugin.
     *
     * Create an instance of the loader which will be used to register the hooks with WordPress.
     *
     * @since    2.0.0
     * @access   private
     */
    private function load_dependencies()
    {
        /**
         * The class responsible for orchestrating the actions and filters of the core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-chordpress-loader.php';

        /**
         * The class responsible for defining internationalization functionality of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-chordpress-i18n.php';

        /**
         * The class responsible for license management.
         */
        if (CHORDPRESS_LICENSE_REQUIRED) require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-chordpress-license.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-chordpress-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-chordpress-public.php';

        $this->loader = new ChordPress_Loader();
    }

    //--------------------------------------------------------------------------
    /**
     * Load TinyMCE buttons.
     *
     * Registers and adds TinyMCE buttons for your plugin. Leave empty if you don't need any.
     * If you add buttons, make sure you configure them in admin/js/tinymce_buttons.js
     *
     * @since    2.0.0
     * @access   private
     */
    private function load_tinymce_buttons()
    {
        if (!function_exists('cpress_theme_setup')) {
            function cpress_theme_setup()
            {
                add_action('init', 'cpress_buttons');
            }
        }
        add_action('after_setup_theme', 'cpress_theme_setup');

        if (!function_exists('cpress_buttons')) {
            function cpress_buttons()
            {
                if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
                    return;
                }
                if (get_user_option('rich_editing') !== 'true') {
                    return;
                }
                add_filter('mce_external_plugins', 'cpress_add_buttons');
                add_filter('mce_buttons', 'cpress_register_buttons');
            }
        }

        if (!function_exists('cpress_add_buttons')) {
            function cpress_add_buttons($plugin_array)
            {
                $plugin_array['cpressbtn'] = plugins_url('../admin/js/tinymce_buttons.js', __FILE__);
                return $plugin_array;
            }
        }

        if (!function_exists('cpress_register_buttons')) {
            function cpress_register_buttons($buttons)
            {
                array_push($buttons, '|');
                array_push($buttons, 'cpressbtn');
                return $buttons;
            }
        }
    }

    //--------------------------------------------------------------------------
    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the i18n class in order to set the domain and to register the hook with WordPress.
     *
     * @since    2.0.0
     * @access   private
     */
    private function set_locale()
    {
        $plugin_i18n = new ChordPress_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    //--------------------------------------------------------------------------
    /**
     * Register admin hooks.
     *
     * @since    2.0.0
     * @access   private
     */
    private function define_admin_hooks()
    {
        $plugin_admin = new ChordPress_Admin($this->get_plugin_name(), $this->get_version(), $this->get_options());

        $this->loader->add_filter('plugin_action_links', $plugin_admin, 'action_links', 10, 5);
        $this->loader->add_filter('plugin_row_meta', $plugin_admin, 'meta_links', 10, 2);
        $this->loader->add_filter('manage_guitar_chord_posts_columns', $plugin_admin, 'set_guitar_chords_columns');

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
        $this->loader->add_action('admin_menu', $plugin_admin, 'create_menu');
        $this->loader->add_action('admin_init', $plugin_admin, 'register_settings');
        $this->loader->add_action('init', $plugin_admin, 'register_post_types');
        $this->loader->add_action('save_post_guitar_chord', $plugin_admin, 'save_guitar_chord');
        $this->loader->add_action('add_post_guitar_chord', $plugin_admin, 'add_guitar_chord');
        $this->loader->add_action('manage_guitar_chord_posts_custom_column', $plugin_admin, 'show_guitar_chord_column', 10, 2);
        $this->loader->add_action('in_plugin_update_message-chordpress/chordpress.php', $plugin_admin, 'show_plugin_update_message', 10, 2);
    }

    //--------------------------------------------------------------------------
    /**
     * Register public hooks.
     *
     * @since    2.0.0
     * @access   private
     */
    private function define_public_hooks()
    {
        $plugin_public = new ChordPress_Public($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
        $this->loader->add_shortcode('chordpress', $plugin_public, 'shortcode_chordpress');
        $this->loader->add_shortcode('chordpress-chord', $plugin_public, 'shortcode_chordpress_chord');
        $this->loader->add_shortcode('chordpress-jtab', $plugin_public, 'shortcode_chordpress_jtab');
    }

    //--------------------------------------------------------------------------
    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    2.0.0
     */
    public function run()
    {
        $this->loader->run();
    }

    //--------------------------------------------------------------------------
    /**
     * Get the option names of the plugin.
     *
     * @since     2.0.0
     * @return    string    Get the option names of the plugin.
     */
    public function get_options()
    {
        return $this->options;
    }

    //--------------------------------------------------------------------------
    /**
     * Get the title of the plugin.
     *
     * @since     2.0.0
     * @return    string    The title of the plugin.
     */
    public function get_plugin_title()
    {
        return $this->plugin_title;
    }

    //--------------------------------------------------------------------------
    /**
     * Get the name of the plugin.
     * It is used to uniquely identify it within the context of WordPress and to define internationalization functionality.
     *
     * @since     2.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name()
    {
        return $this->plugin_name;
    }

    //--------------------------------------------------------------------------
    /**
     * Get the prefix of the plugin.
     *
     * @since     2.0.0
     * @return    string    The prefix of the plugin.
     */
    public function get_plugin_prefix()
    {
        return $this->plugin_prefix;
    }

    //--------------------------------------------------------------------------
    /**
     * Get the URI of the plugin.
     *
     * @since     2.0.0
     * @return    string    The URI of the plugin.
     */
    public function get_plugin_uri()
    {
        return $this->plugin_uri;
    }

    //--------------------------------------------------------------------------
    /**
     * Get the donation URI of the plugin.
     *
     * @since     2.0.0
     * @return    string    The donation URI of the plugin.
     */
    public function get_plugin_donation_uri()
    {
        return $this->plugin_donation_uri;
    }

    //--------------------------------------------------------------------------
    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     2.0.0
     * @return    ChordPress_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader()
    {
        return $this->loader;
    }

    //--------------------------------------------------------------------------
    /**
     * Get the version number of the plugin.
     *
     * @since     2.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version()
    {
        return $this->version;
    }

    // -------------------------------------------------------------------------
    /**
     * Returns a Bootstrap alert box based on the given parameters.
     *
     * @since     2.0.0
     *
     * @param string    $style           Bootstrap style
     * @param string    $heading         Heading of the alert box
     * @param string    $headingLevel    HTML heading level to use for the heading
     * @param string    $content         Content of the alert box
     * @param string    $dismissible     Whether the alert box shall be dismissible or not: yes/no
     * @param string    $width           Width of the alert box in pixel or percent
     *
     * @return string HTML code of the alert box
     */
    public function alert($style, $heading, $headinglevel, $content, $dismissible, $width = '100%')
    {
        /**
         * Prepare the HTML frame.
         */
        $identifier    = "\n\n<!-- " . $this->plugin_title . " Alert Box -->\n";
        $startTag      = "<div role=\"alert\" class=\"" . $this->plugin_prefix . "-alert " . $this->plugin_prefix . "-alert-%style%\" style=\"width:%width%;\">\n";
        $dismissButton = "   <span aria-hidden=\"true\" onclick=\"dismissParent(this);\" class=\"dashicons dashicons-hidden float-right action-icon " . $this->plugin_prefix . "-text-%style%\"></span>\n";
        $headingTag    = "   <%headingLevel% class=\"" . $this->plugin_prefix . "-mt-0\">%headingText%</%headingLevel%>\n   <hr>\n   ";
        $endTag        = "\n</div>\n";

        /**
         * Add the requested styles.
         */
        if (in_array($style, $this->styles)) {
            $startTag = str_replace('%style%', $style, $startTag);
            $dismissButton = str_replace('%style%', $style, $dismissButton);
        } else {
            $startTag = str_replace('%style%', 'primary', $startTag);
            $dismissButton = str_replace('%style%', 'primary', $dismissButton);
        }

        /**
         * Add the requested heading.
         */
        if (strlen($heading)) {
            $headingTag = str_replace('%headingText%', $heading, $headingTag);
            if (in_array(strtolower($headinglevel), $this->heading_levels)) {
                $headingTag = str_replace('%headingLevel%', $headinglevel, $headingTag);
            } else {
                $headingTag = str_replace('%headingLevel%', 'h3', $headingTag);
            }
        } else {
            $headingTag = '';
        }

        /**
         * Remove dismissible button if so requested.
         */
        if (strtolower($dismissible) == 'no') {
            $dismissButton = '';
        }

        /**
         * Add the requested width.
         */
        if (strpos($width, 'px') || strpos($width, '%')) {
            $startTag = str_replace('%width%', $width, $startTag);
        } else {
            $startTag = str_replace('%width%', '100%', $startTag);
        }

        /**
         * Return the alert box.
         */
        return $identifier . $startTag . $dismissButton . $headingTag . $content . $endTag;
    }

    // ---------------------------------------------------------------------------
    /**
     * Pretty prints an array.
     *
     * @since    2.0.0
     * @param    array    $a    Array to print out pretty
     * @return   string
     */
    function pretty_dump($a)
    {
        return highlight_string("<?php\n\$data =\n" . var_export($a, true) . ";\n?>");
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
    public function dnd($a, $die = true)
    {
        $dump = highlight_string("<?php\n\$data =\n" . var_export($a, true) . ";\n?>");
        if ($die) die($dump);
        else return $dump;
    }

    /**
     * Meta Links (shown underneath the plugin description on the admin plugin page)
     *
     * @since    1.0.0
     */
    public function create_option_row($type, $name, $label, $description)
    {
        $output = "
        <tr>
            <th scope=\"row\"><label for=\"" . $name . "\">" . $label . "</label></th>
            <td>";

        switch ($type) {

            case 'text':
                $output .= "<input type=\"text\" id=\"" . $name . "\" name=\"" . $name . "\" value=\"" . get_option($name) . "\" />";
                break;

            case 'checkbox':
                $output .= "<input type=\"checkbox\" id=\"" . $name . "\" name=\"" . $name . "\" " . checked(get_option($name), 1) . " value=\"1\" />";
                break;
        }

        $output .= "<p class=\"description\">" . $description . "</p>
            </td>
        </tr>";

        return $output;
    }

    /**
     * Insert a new guitar chord post
     *
     * @since 3.3.0
     * @param array $chord
     * @return void
     */
    public function add_guitar_chord($chord)
    {
        if (!current_user_can('edit_posts')) {
            return;
        }

        $chord_post = array(
            'post_author'   => 1,
            'post_content'  => '',
            'post_title'    => wp_strip_all_tags($chord['chord_title']),
            'post_status'   => 'publish',
            'post_type'   => 'guitar_chord',
            'comment_status'   => 'closed',
            'ping_status'   => 'closed',
        );

        // Insert the post into the database
        $post_id = wp_insert_post($chord_post);

        if ($post_id) {
            $meta_options = array(
                'guitar_chord_name' => $chord['chord_name'],
                'guitar_chord_barres' => $chord['chord_barres'],
                'guitar_chord_fingers' => $chord['chord_fingers'],
                'guitar_chord_frets' => $chord['chord_frets'],
                'guitar_chord_position' => $chord['chord_position'],
                'guitar_chord_strings' => $chord['chord_strings'],
                'guitar_chord_tuning' => $chord['chord_tuning'],
            );
            foreach ($meta_options as $key => $val) {
                update_post_meta($post_id, $key, $val);
            }
        }
        return $post_id;
    }
}
