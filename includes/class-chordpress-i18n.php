<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.lewe.com
 * @since      2.0.0
 *
 * @package    ChordPress
 * @subpackage ChordPress/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      2.0.0
 * @package    ChordPress
 * @subpackage ChordPress/includes
 * @author     George Lewe <george@lewe.com>
 */
class ChordPress_i18n
{
    /**
     * Load the plugin text domain for translation.
     *
     * @since    2.0.0
     */
    public function load_plugin_textdomain()
    {

        load_plugin_textdomain(
            'chordpress',
            false,
            dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );
    }
}
