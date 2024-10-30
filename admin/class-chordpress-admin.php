<?php

/**
 * Admin functionality of the plugin
 *
 * @link       https://www.lewe.com
 * @since      1.0.0
 *
 * @package    ChordPress
 * @subpackage ChordPress/admin
 */

/**
 * Admin functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    ChordPress
 * @subpackage ChordPress/admin
 * @author     George Lewe <george@lewe.com>
 */
class ChordPress_Admin
{
    /**
     * Array of option names of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      array    $plugin_name    Array of option names of this plugin.
     */
    private $options = array();

    /**
     * The unique name (slug) of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name    The slug of this plugin.
     * @param      string    $version        The version of this plugin.
     */
    public function __construct($plugin_name, $version, $options)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->options = $options;
    }

    /**
     * Register the admin stylesheets.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/chordpress-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the admin javascripts.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/chordpress-admin.js', array('jquery'), $this->version, false);
        wp_enqueue_script($this->plugin_name . '-svguitar', plugin_dir_url(__DIR__) . 'global/js/svguitar.umd.js');
    }

    /**
     * Register Post Types
     *
     * @since    2.1.0
     */
    public function register_post_types()
    {
        $labels = array(
            'name'                  => _x('Guitar Chords', 'Post Type General Name', 'chordpress'),
            'singular_name'         => _x('Guitar Chord', 'Post Type Singular Name', 'chordpress'),
            'menu_name'             => __('Guitar Chords', 'chordpress'),
            'name_admin_bar'        => __('Guitar Chord', 'chordpress'),
            'archives'              => __('Guitar Chord Archives', 'chordpress'),
            'attributes'            => __('Guitar Chord Attributes', 'chordpress'),
            'parent_item_colon'     => __('Parent Chord:', 'chordpress'),
            'all_items'             => __('All Chords', 'chordpress'),
            'add_new_item'          => __('Add New Chord', 'chordpress'),
            'add_new'               => __('Add New', 'chordpress'),
            'new_item'              => __('New Chord', 'chordpress'),
            'edit_item'             => __('Edit Chord', 'chordpress'),
            'update_item'           => __('Update Chord', 'chordpress'),
            'view_item'             => __('View Chord', 'chordpress'),
            'view_items'            => __('View Chords', 'chordpress'),
            'search_items'          => __('Search Chord', 'chordpress'),
            'not_found'             => __('Not found', 'chordpress'),
            'not_found_in_trash'    => __('Not found in Trash', 'chordpress'),
            'featured_image'        => __('Featured Image', 'chordpress'),
            'set_featured_image'    => __('Set featured image', 'chordpress'),
            'remove_featured_image' => __('Remove featured image', 'chordpress'),
            'use_featured_image'    => __('Use as featured image', 'chordpress'),
            'insert_into_item'      => __('Insert into chord', 'chordpress'),
            'uploaded_to_this_item' => __('Uploaded to this chord', 'chordpress'),
            'items_list'            => __('Chords list', 'chordpress'),
            'items_list_navigation' => __('Chords list navigation', 'chordpress'),
            'filter_items_list'     => __('Filter chords list', 'chordpress'),
        );

        $args = array(
            'label'                 => __('Guitar Chord', 'chordpress'),
            'description'           => __('Guitar chord diagram', 'chordpress'),
            'labels'                => $labels,
            'supports'              => array('title'),
            'taxonomies'            => array('category', 'post_tag'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-format-audio',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => true,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );

        register_post_type('guitar_chord', $args);
    }

    /**
     * Register Settings.
     *
     * @since    1.0.0
     */
    public function register_settings()
    {
        foreach ($this->options as $option) {
            add_option($option, '');
            register_setting($this->plugin_name . '_options_group', $option, $this->plugin_name . '_callback');
        }

        add_meta_box(
            'guitar_chord_meta_box',
            'Guitar Chord Details',
            'display_guitar_chord_meta_box',
            'guitar_chord',
            'normal',
            'high'
        );
    }

    /**
     * Create Admin Menu
     *
     * @since    1.0.0
     */
    public function create_menu()
    {
        add_menu_page(
            'ChordPress Admin',                                                   // The title to be displayed in the browser window for this page.
            'ChordPress',                                                         // The text to be displayed for this menu item
            'manage_options',                                                     // Which type of users can see this menu item
            $this->plugin_name . '_admin_menu',                                   // The unique ID for this menu item or file reference
            null,                                                                 // The name of the function to call when rendering this menu's page (null if file ref above)
            plugin_dir_url(__FILE__) . 'images/icon-20x20.png'                    // The icon of the menu entry
        );

        add_submenu_page(
            $this->plugin_name . '_admin_menu',                                   // The parent menu slug
            'ChordPress Options',                                                 // The title to be displayed in the browser window for this page.
            'Options',                                                            // The text to be displayed for this menu item
            'manage_options',                                                     // Which type of users can see this menu item
            plugin_dir_path(__FILE__) . 'partials/chordpress-admin-options.php',  // The unique ID for this menu item or file reference
            null                                                                  // The name of the function to call when rendering this menu's page (null if file ref above)
        );

        add_submenu_page(
            $this->plugin_name . '_admin_menu',                                   // The parent menu slug
            'Guitar Chords',                                                      // The title to be displayed in the browser window for this page.
            'Guitar Chords',                                                      // The text to be displayed for this menu item
            'manage_options',                                                     // Which type of users can see this menu item
            'edit.php?post_type=guitar_chord',                                    // The unique ID for this menu item or file reference
            null                                                                  // The name of the function to call when rendering this menu's page (null if file ref above)
        );

        if (CHORDPRESS_LICENSE_REQUIRED) {
            add_submenu_page(
                $this->plugin_name . '_admin_menu',                                   // The parent menu slug
                'ChordPress License',                                                 // The title to be displayed in the browser window for this page.
                'License',                                                            // The text to be displayed for this menu item
                'manage_options',                                                     // Which type of users can see this menu item
                plugin_dir_path(__FILE__) . 'partials/chordpress-admin-license.php',  // The unique ID for this menu item or file reference
                null                                                                  // The name of the function to call when rendering this menu's page (null if file ref above)
            );
        }

        remove_submenu_page($this->plugin_name . '_admin_menu', $this->plugin_name . '_admin_menu');
    }

    /**
     * Action Links (shown underneath the plugin name on the admin plugin page)
     *
     * @since    1.0.0
     */
    public function action_links($actions, $file)
    {
        if ($file == $this->plugin_name . '/' . $this->plugin_name . '.php') {
            $settings = array('settings' => '<a href="admin.php?page=' . $this->plugin_name . '%2Fadmin%2Fpartials%2Fchordpress-admin-options.php">' . __('Settings', 'chordpress') . '</a>');
            $actions = array_merge($settings, $actions);
            $documentation = array('documentation' => '<a href="https://lewe.gitbook.io/lewe-chordpress/" target="_blank">' . __('Documentation', 'chordpress') . '</a>');
            $actions = array_merge($documentation, $actions);
        }

        return $actions;
    }

    /**
     * Meta Links (shown underneath the plugin description on the admin plugin page)
     *
     * @since    1.0.0
     */
    public function meta_links($links, $file)
    {
        if ($file == $this->plugin_name . '/' . $this->plugin_name . '.php') {
            $support_link = "https://georgelewe.atlassian.net/servicedesk/customer/portal/5";
            $donate_link = "https://www.paypal.me/GeorgeLewe";
            $review_link = "https://wordpress.org/support/plugin/chordpress/reviews/?filter=5#new-post";
            $links[] = '<a href="' . esc_url($support_link) . '" target="_blank" title="' . __('Support', 'chordpress') . '"><span style="color:#999999;margin-right:4px;" class="dashicons dashicons-sos"></span>' . __('Support', 'chordpress') . '</a>';
            if (!CHORDPRESS_LICENSE_REQUIRED) $links[] = '<a href="' . esc_url($donate_link) . '" target="_blank" title="' . __('Donate', 'chordpress') . '"><span style="color:#999999;margin-right:4px;" class="dashicons dashicons-heart"></span>' . __('Donate', 'chordpress') . '</a>';
            $links[] = '<a href="' . esc_url($review_link) . '" target="_blank"><span style="color:#999999;margin-right:4px;" class="dashicons dashicons-thumbs-up"></span>' . __('Rate and Review!', 'chordpress') . '</a>';
        }

        return $links;
    }

    /**
     * Save guitar chord post type
     *
     * @since 2.1.0
     *
     * @param  int     $post_id
     * @return void    
     */
    public function save_guitar_chord($post_id)
    {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        $post = get_post($post_id);

        if (isset($_POST['post_type']) && 'guitar_chord' == $_POST['post_type'] && $post->post_type == 'guitar_chord') {
            $meta_options = array(
                'guitar_chord_name',
                'guitar_chord_barres',
                'guitar_chord_fingers',
                'guitar_chord_frets',
                'guitar_chord_position',
                'guitar_chord_strings',
                'guitar_chord_tuning',
            );
            foreach ($meta_options as $meta_option) {
                update_post_meta($post_id, $meta_option, sanitize_text_field($_POST[$meta_option]));
            }
        }
    }

    /**
     * Set guitar chord columns
     *
     * @since 2.1.0
     *
     * @param  array $columns Current columns of the post
     * @return array Extended columns for the post
     */
    public function set_guitar_chords_columns($columns)
    {
        $mycolumns = array(
            'guitar_chord_name' => __('Name', 'chordpress'),
            'guitar_chord_strings' => __('Strings', 'chordpress'),
            'guitar_chord_shortcode' => __('Shortcode', 'chordpress'),
        );

        $columns = $this->array_insert_after($columns, 'title', $mycolumns);

        return $columns;
    }

    /**
     * Show guitar chord column
     *
     * @since 2.1.0
     *
     * @param  string    $column    Column ID
     * @param  int     $post_id
     */
    public function show_guitar_chord_column($column, $post_id)
    {
        switch ($column) {

            case 'guitar_chord_name':
                echo get_post_meta($post_id, 'guitar_chord_name', true);
                break;

            case 'guitar_chord_strings':
                echo get_post_meta($post_id, 'guitar_chord_strings', true);
                break;

            case 'guitar_chord_shortcode':
                echo '[chordpress-chord chord="' . $post_id . '"]';
                break;
        }
    }

    /**
     * Upgrade message (if Upgrade Notice section exists in readme.txt).
     *
     * @since 3.0.0
     *
     * @param  string  $data
     * @param  string  $response
     */
    public function show_plugin_update_message($data, $response)
    {
        if (isset($data['upgrade_notice'])) {
            printf('<div style="padding:8px; background-color:#fefefe; border:1px solid #a0a0a0; border-radius:4px;">%s</div>', wpautop($data['upgrade_notice']));
        }
    }

    /**
     * Insert a value or key/value pair after a specific key in an array.
     * If key doesn't exist, value is appended to the end of the array.
     *
     * @param array  $array
     * @param string $key
     * @param array  $new
     *
     * @return array
     */
    private function array_insert_after(array $array, $key, array $new)
    {
        $keys = array_keys($array);
        $index = array_search($key, $keys);
        $pos = false === $index ? count($array) : $index + 1;

        return array_merge(array_slice($array, 0, $pos), $new, array_slice($array, $pos));
    }
}
