<?php

/**
 * Admin options
 *
 * This file is used to markup the admin-facing aspects of the plugin.
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

/**
 * Get plugin information.
 */
$P = new ChordPress_Plugin();
$ptitle = $P->get_plugin_title();
$pname = $P->get_plugin_name();
$pprefix = $P->get_plugin_prefix();
$puri = $P->get_plugin_uri();
$pdonuri = $P->get_plugin_donation_uri();
$show_alert = false;

// $P->pretty_dump($_REQUEST);

/**
 * Options array
 */
$options = $P->get_options();

/**
 * ,--------------,
 * | Save Changes |
 * '--------------'
 */
if (isset($_REQUEST['submit'])) {
    $show_alert = true;
    $alert_style = 'success';
    foreach ($options as $option) {
        if (isset($_REQUEST[$option])) {
            if (get_option($option) != $_REQUEST[$option]) {
                if (!update_option($option, $_REQUEST[$option])) {
                    $alert_style = 'danger';
                }
            }
        } else {
            /**
             * Unchecked checkboxes will not be in the $_REQUEST array.
             * Make sure we set them to 0.
             */
            if (strpos($option, 'checkbox')) {
                update_option($option, 0);
            }
        }
    }
} else if (isset($_REQUEST['addchords'])) {
    $chords_major = array(
        array('chord_title' => 'A Major', 'chord_name' => 'A', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,0),(4,2,'2'),(3,2,'3'),(2,2,'4'),(1,0),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'B Major', 'chord_name' => 'B', 'chord_barres' => '5,1,2', 'chord_fingers' => "(6,'x'),(4,4,'2'),(3,4,'3'),(2,4,'4'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'C Major', 'chord_name' => 'C', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,3,'3'),(4,2,'2'),(3,0),(2,1,'1'),(1,0),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'D Major', 'chord_name' => 'D', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,'x'),(4,0),(3,2,'1'),(2,3,'3'),(1,2,'2'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'E Major', 'chord_name' => 'E', 'chord_barres' => '', 'chord_fingers' => "(6,0),(5,2,'2'),(4,2,'3'),(3,1,'1'),(2,0),(1,0),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'F Major', 'chord_name' => 'F', 'chord_barres' => '6,1,1', 'chord_fingers' => "(5,3,'3'),(4,3,'4'),(3,2,'2'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'G Major', 'chord_name' => 'G', 'chord_barres' => '', 'chord_fingers' => "(6,3,'2'),(5,2,'1'),(4,0),(3,0),(2,0),(1,3,'3'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
    );

    $chords_major_7 = array(
        array('chord_title' => 'A Major 7', 'chord_name' => 'A7', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,0),(4,2,'1'),(3,0),(2,2,'2'),(1,0),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'B Major 7', 'chord_name' => 'B7', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,2,'2'),(4,1,'1'),(3,2,'3'),(2,0),(1,2,'4'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'C Major 7', 'chord_name' => 'C7', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,3,'3'),(4,2,'2'),(3,3,'4'),(2,1,'1'),(1,0),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'D Major 7', 'chord_name' => 'D7', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,'x'),(4,0),(3,2,'2'),(2,1,'1'),(1,2,'3'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'E Major 7', 'chord_name' => 'E7', 'chord_barres' => '', 'chord_fingers' => "(6,0),(5,2,'2'),(4,0),(3,1,'1'),(2,0),(1,0),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'F Major 7', 'chord_name' => 'F7', 'chord_barres' => '6,1,1', 'chord_fingers' => "(5,3,'3'),(3,2,'2'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'G Major 7', 'chord_name' => 'G7', 'chord_barres' => '', 'chord_fingers' => "(6,3,'3'),(5,2,'2'),(4,0),(3,0),(2,0),(1,1,'1'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
    );

    $chords_major_5 = array(
        array('chord_title' => 'A Major 5', 'chord_name' => 'A5', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,0),(4,2,'3'),(3,2,'3'),(2,'x'),(1,'x'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'B Major 5', 'chord_name' => 'B5', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,2,'1'),(4,4,'3'),(3,4,'4'),(2,'x'),(1,'x'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'C Major 5', 'chord_name' => 'C5', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,'x'),(4,'x'),(3,0),(2,1,'1'),(1,'x'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'D Major 5', 'chord_name' => 'D5', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,'x'),(4,0),(3,2,'1'),(2,3,'2'),(1,'x'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'E Major 5', 'chord_name' => 'E5', 'chord_barres' => '', 'chord_fingers' => "(6,0),(5,2,'1'),(4,'x'),(3,'x'),(2,'x'),(1,'x'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'F Major 5', 'chord_name' => 'F5', 'chord_barres' => '', 'chord_fingers' => "(6,1,'1'),(5,3,'3'),(4,'x'),(3,'x'),(2,'x'),(1,'x'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'G Major 5', 'chord_name' => 'G5', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,'x'),(4,0),(3,0),(2,'x'),(1,'x'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
    );

    $chords_minor = array(
        array('chord_title' => 'A Minor', 'chord_name' => 'Am', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,0),(4,2,'2'),(3,2,'3'),(2,1,'1'),(1,0),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'B Minor', 'chord_name' => 'Bm', 'chord_barres' => '5,1,2', 'chord_fingers' => "(6,'x'),(4,4,'3'),(3,4,'4'),(2,3,'2'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'C Minor', 'chord_name' => 'Cm', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,3,'3'),(4,1,'1'),(3,0),(2,1,'2'),(1,3,'4'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'D Minor', 'chord_name' => 'Dm', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,'x'),(4,0),(3,2,'2'),(2,3,'3'),(1,1,'1'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'E Minor', 'chord_name' => 'Em', 'chord_barres' => '', 'chord_fingers' => "(6,0),(5,2,'2'),(4,2,'3'),(3,0),(2,0),(1,0),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'F Minor', 'chord_name' => 'Fm', 'chord_barres' => '6,1,1', 'chord_fingers' => "(5,3,'3'),(4,3,'4'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'G Minor', 'chord_name' => 'Gm', 'chord_barres' => '6,1,3', 'chord_fingers' => "(5,5,'3'),(4,5,'4'),", 'chord_frets' => '5', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
    );

    $chords_minor_7 = array(
        array('chord_title' => 'A Minor 7', 'chord_name' => 'Am7', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,0),(4,2,'2'),(3,0),(2,1,'1'),(1,0),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'B Minor 7', 'chord_name' => 'Bm7', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,0),(4,0),(3,2,'1'),(2,0),(1,2,'2'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'C Minor 7', 'chord_name' => 'Cm7', 'chord_barres' => '4,2,1', 'chord_fingers' => "(6,'x'),(5,3,'3'),(3,3,'4'),(1,'x'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'D Minor 7', 'chord_name' => 'Dm7', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,'x'),(4,0),(3,2,'3'),(2,1,'1'),(1,1,'2'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'E Minor 7', 'chord_name' => 'Em7', 'chord_barres' => '', 'chord_fingers' => "(6,0),(5,2,'2'),(4,0),(3,0),(2,0),(1,0),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'F Minor 7', 'chord_name' => 'Fm7', 'chord_barres' => '6,1,1', 'chord_fingers' => "(5,3,'3'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'G Minor 7', 'chord_name' => 'Gm7', 'chord_barres' => '6,1,3', 'chord_fingers' => "(5,5,'3'),", 'chord_frets' => '5', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
    );

    $chords_dim = array(
        array('chord_title' => 'A Dim', 'chord_name' => 'A dim', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,0),(4,1,'1'),(3,2,'3'),(2,1,'2'),(1,'x'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'B Dim', 'chord_name' => 'B dim', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,2,'1'),(4,3,'2'),(3,4,'4'),(2,3,'3'),(1,'x'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'C Dim', 'chord_name' => 'C dim', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,3,'1'),(4,4,'2'),(3,5,'4'),(2,4,'3'),(1,'x'),", 'chord_frets' => '5', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'D Dim', 'chord_name' => 'D dim', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,5,'1'),(4,6,'2'),(3,7,'4'),(2,6,'3'),(1,'x'),", 'chord_frets' => '7', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'E Dim', 'chord_name' => 'E dim', 'chord_barres' => '', 'chord_fingers' => "(6,0),(5,1,'1'),(4,2,'2'),(3,0),(2,'x'),(1,'x'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'F Dim', 'chord_name' => 'F dim', 'chord_barres' => '6,3,1', 'chord_fingers' => "(5,2,'2'),(4,3,'3'),(2,'x'),(1,'x'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'G Dim', 'chord_name' => 'G dim', 'chord_barres' => '6,3,3', 'chord_fingers' => "(5,4,'2'),(4,5,'3'),(2,'x'),(1,'x'),", 'chord_frets' => '5', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
    );

    $chords_dim_7 = array(
        array('chord_title' => 'A Dim 7', 'chord_name' => 'A dim7', 'chord_barres' => '4,2,1', 'chord_fingers' => "(6,2,'2'),(5,'x'),(3,3,'2'),(1,'x'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'B Dim 7', 'chord_name' => 'B dim7', 'chord_barres' => '', 'chord_fingers' => "(6,1,'1'),(5,'x'),(4,0),(3,1,'2'),(2,0),(1,'x'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'C Dim 7', 'chord_name' => 'C dim7', 'chord_barres' => '4,2,1', 'chord_fingers' => "(6,2,'2'),(5,'x'),(3,2,'3'),(1,'x'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'C Dim 7', 'chord_name' => 'D dim7', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,'x'),(4,0),(3,1,'1'),(2,0),(1,1,'2'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'E Dim 7', 'chord_name' => 'E dim7', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,1,'1'),(4,2,'2'),(3,0),(2,2,'3'),(1,'x'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'F Dim 7', 'chord_name' => 'F dim7', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,2,'2'),(4,3,'3'),(3,1,'1'),(2,3,'4'),(1,'x'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'G Dim 7', 'chord_name' => 'G dim7', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,1,'1'),(4,2,'2'),(3,0),(2,2,'3'),(1,'x'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
    );

    $chords_aug = array(
        array('chord_title' => 'A Aug', 'chord_name' => 'A aug', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,0),(4,3,'4'),(3,2,'2'),(2,2,'3'),(1,1,'1'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'B Aug', 'chord_name' => 'B aug', 'chord_barres' => '', 'chord_fingers' => "(6,7,'3'),(5,6,'2'),(4,5,'1'),(3,0),(2,0),(1,'x'),", 'chord_frets' => '7', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'C Aug', 'chord_name' => 'C aug', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,3,'4'),(4,2,'3'),(3,1,'1'),(2,1,'2'),(1,0),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'D Aug', 'chord_name' => 'D aug', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,'x'),(4,0),(3,3,'2'),(2,3,'3'),(1,2,'1'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'E Aug', 'chord_name' => 'E aug', 'chord_barres' => '', 'chord_fingers' => "(6,0),(5,3,'4'),(4,2,'3'),(3,1,'1'),(2,1,'2'),(1,0),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'F Aug', 'chord_name' => 'F aug', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,'x'),(4,3,'4'),(3,2,'2'),(2,2,'3'),(1,1,'1'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'G Aug', 'chord_name' => 'G aug', 'chord_barres' => '', 'chord_fingers' => "(6,3,'3'),(5,2,'2'),(4,1,'1'),(3,0),(2,0),(1,3,'4'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
    );

    $chords_sus_2 = array(
        array('chord_title' => 'A Sus 2', 'chord_name' => 'A sus2', 'chord_barres' => '4,3,2', 'chord_fingers' => "(6,'x'),(5,0),(2,0),(1,0),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'B Sus 2', 'chord_name' => 'B sus2', 'chord_barres' => '5,1,2', 'chord_fingers' => "(6,'x'),(4,4,'3'),(3,4,'4'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'C Sus 2', 'chord_name' => 'C sus2', 'chord_barres' => '5,1,3', 'chord_fingers' => "(6,'x'),(4,5,'3'),(3,5,'4'),", 'chord_frets' => '5', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'D Sus 2', 'chord_name' => 'D sus2', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,'x'),(4,0),(3,2,'1'),(2,3,'2'),(1,0),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'E Sus 2', 'chord_name' => 'E sus2', 'chord_barres' => '4,1,2', 'chord_fingers' => "(6,'x'),(5,'x'),(3,4,'3'),(2,5,'4'),", 'chord_frets' => '5', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'F Sus 2', 'chord_name' => 'F sus2', 'chord_barres' => '4,1,3', 'chord_fingers' => "(6,'x'),(5,'x'),(3,5,'3'),(2,6,'4'),", 'chord_frets' => '6', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'G Sus 2', 'chord_name' => 'G sus2', 'chord_barres' => '4,1,5', 'chord_fingers' => "(6,'x'),(5,'x'),(3,7,'3'),(2,8,'4'),", 'chord_frets' => '8', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
    );

    $chords_sus_4 = array(
        array('chord_title' => 'A Sus 4', 'chord_name' => 'A sus4', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,0),(4,2,'1'),(3,2,'2'),(2,3,'4'),(1,0),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'B Sus 4', 'chord_name' => 'B sus4', 'chord_barres' => '5,1,2', 'chord_fingers' => "(6,'x'),(4,4,'2'),(3,4,'3'),(2,5,'4'),", 'chord_frets' => '5', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'C Sus 4', 'chord_name' => 'C sus4', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,3,'3'),(4,3,'4'),(3,0),(2,1,'1'),(1,'x'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'D Sus 4', 'chord_name' => 'D sus4', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,'x'),(4,0),(3,2,'1'),(2,3,'2'),(1,3,'3'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'E Sus 4', 'chord_name' => 'E sus4', 'chord_barres' => '', 'chord_fingers' => "(6,0),(5,1,'1'),(4,1,'1'),(3,1,'1'),(2,0),(1,0),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'F Sus 4', 'chord_name' => 'F sus4', 'chord_barres' => '6,1,1', 'chord_fingers' => "(5,3,'2'),(4,3,'3'),(3,3,'4'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'G Sus 4', 'chord_name' => 'G sus4', 'chord_barres' => '6,1,3', 'chord_fingers' => "(5,5,'2'),(4,5,'3'),(3,5,'4'),", 'chord_frets' => '5', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
    );

    $chords_maj_7 = array(
        array('chord_title' => 'A Maj 7', 'chord_name' => 'A maj7', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,0),(4,2,'2'),(3,1,'1'),(2,2,'3'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'B Maj 7', 'chord_name' => 'B maj7', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,'x'),(4,1,'1'),(3,3,'4'),(2,0),(1,2,'3'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'C Maj 7', 'chord_name' => 'C maj7', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,'x'),(4,2,'2'),(3,4,'4'),(2,1,'1'),(1,3,'3'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'D Maj 7', 'chord_name' => 'D maj7', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,'x'),(4,0),(3,2,'1'),(2,2,'1'),(1,2,'1'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'E Maj 7', 'chord_name' => 'E maj7', 'chord_barres' => '', 'chord_fingers' => "(6,0),(5,'x'),(4,1,'1'),(3,1,'1'),(2,0),(1,'x'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'F Maj 7', 'chord_name' => 'F maj7', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,'x'),(4,3,'3'),(3,2,'2'),(2,1,'1'),(1,0),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'G Maj 7', 'chord_name' => 'G maj7', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,2,'2'),(4,0),(3,0),(2,0),(1,2,'3'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
    );

    $chords_7_sus_4 = array(
        array('chord_title' => 'A 7 Sus 4', 'chord_name' => 'A 7sus4', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,0),(4,2,'2'),(3,0),(2,3,'4'),(1,0),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'B 7 Sus 4', 'chord_name' => 'B 7sus4', 'chord_barres' => '5,1,2', 'chord_fingers' => "(6,'x'),(4,4,'3'),(2,5,'4'),", 'chord_frets' => '5', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'C 7 Sus 4', 'chord_name' => 'C 7sus4', 'chord_barres' => '5,1,3', 'chord_fingers' => "(6,'x'),(4,5,'3'),(2,6,'4'),", 'chord_frets' => '6', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'D 7 Sus 4', 'chord_name' => 'D 7sus4', 'chord_barres' => '', 'chord_fingers' => "(6,'x'),(5,'x'),(4,0),(3,2,'2'),(2,1,'1'),(1,3,'4'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'E 7 Sus 4', 'chord_name' => 'E 7sus4', 'chord_barres' => '', 'chord_fingers' => "(6,0),(5,2,'1'),(4,0),(3,2,'2'),(2,0),(1,0),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'F 7 Sus 4', 'chord_name' => 'F 7sus4', 'chord_barres' => '6,1,1', 'chord_fingers' => "(5,3,'3'),(3,3,'4'),", 'chord_frets' => '4', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
        array('chord_title' => 'G 7 Sus 4', 'chord_name' => 'G 7sus4', 'chord_barres' => '6,1,3', 'chord_fingers' => "(5,5,'3'),(3,5,'4'),", 'chord_frets' => '5', 'chord_position' => '1', 'chord_strings' => '6', 'chord_tuning' => 'E,A,D,G,B,E',),
    );

    // $P->dnd($_REQUEST);
    $chordSets = array(
        'chords_major',
        'chords_major_5',
        'chords_major_7',
        'chords_minor',
        'chords_minor_7',
        'chords_dim',
        'chords_dim_7',
        'chords_aug',
        'chords_sus_2',
        'chords_sus_4',
        'chords_maj_7',
        'chords_7_sus_4',
    );

    foreach ($chordSets as $set) {
        if (isset($_REQUEST[$pname . '_' . $set])) {
            foreach (${$set} as $chord) {
                $success = $P->add_guitar_chord($chord);
                if ($success) {
                    $show_alert = true;
                    $alert_styles[] = 'chordsadded';
                } else {
                    $show_alert = true;
                    $alert_styles[] = 'chordserror';
                }
            }
        }
    }

    $alert_style = 'chordsadded';
    if (in_array('chordserror', $alert_styles)) {
        $alert_style = 'chordserror';
    }
}

/**
 * Save response message
 */
if ($show_alert) {
    if ($alert_style == 'success') {
        $alert_title = esc_html(__('Success', 'chordpress'));
        $alert_text = esc_html(__('The changes were saved successfully.', 'chordpress'));
    } else if ($alert_style == 'chordsadded') {
        $alert_title = esc_html(__('Success', 'chordpress'));
        $alert_text = esc_html(__('The chords were saved successfully.', 'chordpress'));
    } else if ($alert_style == 'chordserror') {
        $alert_title = esc_html(__('Success', 'chordpress'));
        $alert_text = esc_html(__('At least one of the chords could not be saved. Please check the chord posts for missing chords and add them manually.', 'chordpress'));
    } else {
        $alert_title = esc_html(__('Error', 'chordpress'));
        $alert_text = esc_html(__('An error occurred while trying to save your settings.', 'chordpress'));
    }
}

?>

<div class="cpress-options">

    <div class="cpress-options-header">
        <img src="<?php echo plugins_url('../images/icon-80x80.png', __FILE__); ?>" alt="" class="cpress-options-header-icon">
        <div class="cpress-options-header-title"><?php echo CHORDPRESS_NAME . " " . CHORDPRESS_VERSION; ?></div>
        <div class="cpress-options-header-subtitle">
            <?php echo esc_html(__('Render ChordPro texts on your WordPress website', 'chordpress')); ?>
            <div class="cpress-options-header-buttons">
                <a href="<?php echo $puri; ?>" target="_blank" class="<?php echo $pprefix; ?>-btn <?php echo $pprefix; ?>-btn-info <?php echo $pprefix; ?>-btn-xs"><?php echo esc_html(__('Documentation', 'chordpress')); ?></a>
                <?php if (!CHORDPRESS_LICENSE_REQUIRED) { ?><a href="<?php echo $pdonuri; ?>" target="_blank" class="<?php echo $pprefix; ?>-btn <?php echo $pprefix; ?>-btn-primary <?php echo $pprefix; ?>-btn-xs"><?php echo esc_html(__('Donate', 'chordpress')); ?></a><?php } ?>
            </div>
        </div>
    </div>

    <div class="wrap">

        <?php
        if ($show_alert) echo $P->alert($alert_style, $alert_title, 'h3', $alert_text, true, '98%');
        settings_errors();
        $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'tab_output';
        ?>

        <div style="clear:both;">

            <div class="<?php echo $pprefix; ?>-alert <?php echo $pprefix; ?>-alert-info">
                <?php echo __('Please consider a donation if you like the plugin.', 'chordpress'); ?><a href="<?php echo $pdonuri; ?>" target="_blank" class="<?php echo $pprefix; ?>-btn <?php echo $pprefix; ?>-btn-primary <?php echo $pprefix; ?>-btn-xs" style="margin-left:20px;"><?php echo esc_html(__('Donate', 'chordpress')); ?></a>
            </div>

            <!-- Tabs -->
            <h2 class="nav-tab-wrapper">
                <a href="?page=<?php echo __FILE__; ?>&tab=tab_output" class="nav-tab <?php echo $active_tab == 'tab_output' ? 'nav-tab-active cpress-tab-active' : 'cpress-tab-inactive'; ?>"><?php echo esc_html(__('Output Options', 'chordpress')); ?></a>
                <a href="?page=<?php echo __FILE__; ?>&tab=tab_formatting" class="nav-tab <?php echo $active_tab == 'tab_formatting' ? 'nav-tab-active cpress-tab-active' : 'cpress-tab-inactive'; ?>"><?php echo esc_html(__('Formatting Options', 'chordpress')); ?></a>
                <a href="?page=<?php echo __FILE__; ?>&tab=tab_chord" class="nav-tab <?php echo $active_tab == 'tab_chord' ? 'nav-tab-active cpress-tab-active' : 'cpress-tab-inactive'; ?>"><?php echo esc_html(__('Chord Diagram Options', 'chordpress')); ?></a>
                <a href="?page=<?php echo __FILE__; ?>&tab=tab_samples" class="nav-tab <?php echo $active_tab == 'tab_samples' ? 'nav-tab-active cpress-tab-active' : 'cpress-tab-inactive'; ?>"><?php echo esc_html(__('Add Chords', 'chordpress')); ?></a>
                <a href="?page=<?php echo __FILE__; ?>&tab=tab_plugin_options" class="nav-tab <?php echo $active_tab == 'tab_plugin_options' ? 'nav-tab-active ' . $pprefix . '-tab-active' : 'cpress-tab-inactive'; ?>"><?php echo esc_html(__('Plugin Options', 'chordpress')); ?></a>
                <a href="?page=<?php echo __FILE__; ?>&tab=tab_plugin_info" class="nav-tab <?php echo $active_tab == 'tab_plugin_info' ? 'nav-tab-active ' . $pprefix . '-tab-active' : 'cpress-tab-inactive'; ?>"><?php echo esc_html(__('Plugin Info', 'chordpress')); ?></a>
            </h2>

            <form name="form" action="<?php echo admin_url('admin.php?page=' . $pname . '%2Fadmin%2Fpartials%2Fchordpress-admin-options.php') ?>" method="post">

                <?php settings_fields($pname . '_options_group'); ?>

                <?php
                //  ,--------------,
                // _| Tab: Output  |_
                //
                if ($active_tab == 'tab_output') $display = "display:block;";
                else $display = "display:none;";
                ?>
                <div style="<?php echo $display; ?>">
                    <div class="<?php echo $pprefix; ?>-callout <?php echo $pprefix; ?>-callout-info">
                        <?php echo esc_html(__('Use this tab to select what sections and directives will be part of the rendered ChordPro text output.', 'chordpress')); ?>
                    </div>
                    <table class="form-table" style="margin-left:16px;">
                        <tbody>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Hide Artist', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_checkbox_hide_artist' name='<?php echo $pname; ?>_checkbox_hide_artist' <?php checked(get_option($pname . '_checkbox_hide_artist'), 1); ?> value='1'>
                                    <p class="description"><?php echo esc_html(__('With this option selected, the', 'chordpress')); ?> <a href="https://www.chordpro.org/chordpro/Directives-artist.html" target="_blank"><?php echo esc_html(__('artist directive', 'chordpress')); ?></a> <?php echo esc_html(__('will not be displayed', 'chordpress')); ?>.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Hide Chords', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_checkbox_hide_chords' name='<?php echo $pname; ?>_checkbox_hide_chords' <?php checked(get_option($pname . '_checkbox_hide_chords'), 1); ?> value='1'>
                                    <p class="description"><?php echo esc_html(__('With this option selected, only the lyrics will be printed (no chords above them). You can overwrite this setting per shortcut with "hidechords=yes/no"', 'chordpress')); ?>.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Hide Comments', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_checkbox_hide_comments' name='<?php echo $pname; ?>_checkbox_hide_comments' <?php checked(get_option($pname . '_checkbox_hide_comments'), 1); ?> value='1'>
                                    <p class="description"><?php echo esc_html(__('With this option selected, the', 'chordpress')); ?> <a href="https://www.chordpro.org/chordpro/Directives-comment.html" target="_blank"><?php echo esc_html(__('comment directive', 'chordpress')); ?></a> <?php echo esc_html(__('will not be displayed. You can overwrite this setting per shortcut with "hidecomments=yes/no"', 'chordpress')); ?>.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Hide Composer', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_checkbox_hide_composer' name='<?php echo $pname; ?>_checkbox_hide_composer' <?php checked(get_option($pname . '_checkbox_hide_composer'), 1); ?> value='1'>
                                    <p class="description"><?php echo esc_html(__('With this option selected, the', 'chordpress')); ?> <a href="https://www.chordpro.org/chordpro/Directives-composer.html" target="_blank"><?php echo esc_html(__('composer directive', 'chordpress')); ?></a> <?php echo esc_html(__('will not be displayed. You can overwrite this setting per shortcut with "hidecomposer=yes/no"', 'chordpress')); ?>.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Hide Subtitle', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_checkbox_hide_subtitle' name='<?php echo $pname; ?>_checkbox_hide_subtitle' <?php checked(get_option($pname . '_checkbox_hide_subtitle'), 1); ?> value='1'>
                                    <p class="description"><?php echo esc_html(__('With this option selected, the', 'chordpress')); ?> <a href="https://www.chordpro.org/chordpro/Directives-subtitle.html" target="_blank"><?php echo esc_html(__('subtitle directive', 'chordpress')); ?></a> <?php echo esc_html(__('will not be displayed. You can overwrite this setting per shortcut with "hidesubtitle=yes/no"', 'chordpress')); ?>.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Hide Title', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_checkbox_hide_title' name='<?php echo $pname; ?>_checkbox_hide_title' <?php checked(get_option($pname . '_checkbox_hide_title'), 1); ?> value='1'>
                                    <p class="description"><?php echo esc_html(__('With this option selected, the', 'chordpress')); ?> <a href="https://www.chordpro.org/chordpro/Directives-title.html" target="_blank"><?php echo esc_html(__('title directive', 'chordpress')); ?></a> <?php echo esc_html(__('will not be displayed. You can overwrite this setting per shortcut with "hidetitle=yes/no"', 'chordpress')); ?>.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Hide Year', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_checkbox_hide_year' name='<?php echo $pname; ?>_checkbox_hide_year' <?php checked(get_option($pname . '_checkbox_hide_year'), 1); ?> value='1'>
                                    <p class="description"><?php echo esc_html(__('With this option selected, the', 'chordpress')); ?> <a href="https://www.chordpro.org/chordpro/Directives-year.html" target="_blank"><?php echo esc_html(__('year directive', 'chordpress')); ?></a> <?php echo esc_html(__('will not be displayed. You can overwrite this setting per shortcut with "hideyear=yes/no"', 'chordpress')); ?>.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Hide Transpose', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_checkbox_hide_transpose' name='<?php echo $pname; ?>_checkbox_hide_transpose' <?php checked(get_option($pname . '_checkbox_hide_transpose'), 1); ?> value='1'>
                                    <p class="description"><?php echo esc_html(__('With this option selected, the transpose drop down will be hidden in interactive mode. You can overwrite this setting per shortcut with "hidetranspose=yes/no"', 'chordpress')); ?>.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Hide Print', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_checkbox_hide_print' name='<?php echo $pname; ?>_checkbox_hide_print' <?php checked(get_option($pname . '_checkbox_hide_print'), 1); ?> value='1'>
                                    <p class="description"><?php echo esc_html(__('With this option selected, the print button will be hidden in interactive mode. You can overwrite this setting per shortcut with "hideprint=yes/no"', 'chordpress')); ?>.</p>
                                </td>
                            </tr>
                            <tr>
                              <th scope="row"><?php echo esc_html(__('Numeric Transpose', 'chordpress')); ?></th>
                              <td>
                                <input type='checkbox' id='<?php echo $pname; ?>_checkbox_show_numeric_transpose' name='<?php echo $pname; ?>_checkbox_show_numeric_transpose' <?php checked(get_option($pname . '_checkbox_show_numeric_transpose'), 1); ?> value='1'>
                                <p class="description"><?php echo esc_html(__('With this option selected, the transpose drop down will be replaced by a numeric plus/minus input field. This setting has no effect if Hide Transpose is checked. You can overwrite this setting per shortcut with "numerictranspose=yes/no""', 'chordpress')); ?>.</p>
                              </td>
                            </tr>
                            <tr>
                              <th scope="row"><?php echo esc_html(__('Fixed Interaction', 'chordpress')); ?></th>
                              <td>
                                <input type='checkbox' id='<?php echo $pname; ?>_checkbox_fixed_interaction' name='<?php echo $pname; ?>_checkbox_fixed_interaction' <?php checked(get_option($pname . '_checkbox_fixed_interaction'), 1); ?> value='1'>
                                <p class="description"><?php echo esc_html(__('With this option selected, the interaction menu will be fixed at the bottom of the page. Note, that this might lead to unexpected results depending on the WordPress theme you use. You can overwrite this setting per shortcut with "fixedinteraction=yes/no"', 'chordpress')); ?>.</p>
                              </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('H/B Notation', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_checkbox_hb_notation' name='<?php echo $pname; ?>_checkbox_hb_notation' <?php checked(get_option($pname . '_checkbox_hb_notation'), 1); ?> value='1'>
                                    <p class="description"><?php echo esc_html(__('With this option selected, chords are displayed in H/B notation: H is used instead of B, B is used insetad of Bb. This notation is used in some European countries. Read more about it', 'chordpress')); ?> <a href="https://sayandsound.lewe.com/note-h/" target="_blank"><?php echo esc_html(__('here', 'chordpress')); ?></a>.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Show Chord Sheet', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_checkbox_show_chord_sheet' name='<?php echo $pname; ?>_checkbox_show_chord_sheet' <?php checked(get_option($pname . '_checkbox_show_chord_sheet'), 1); ?> value='1'>
                                    <p class="description"><?php echo esc_html(__('With this option selected, a chord sheet is displayed at the bottom or top of the rendered song, showing ', 'chordpress')); ?> <a href="https://github.com/omnibrain/svguitar" target="_blank"><?php echo esc_html(__('SVGuitar Chords', 'chordpress')); ?></a> <?php echo esc_html(__(' diagrams of each chord used in the song. This requires that you create a ', 'chordpress')); ?> <a href="edit.php?post_type=guitar_chord" target="_blank"><?php echo esc_html(__('guitar chord post', 'chordpress')); ?></a> <?php echo esc_html(__('for each of them. You can overwrite this setting per shortcut with "showchordsheet=yes/no"', 'chordpress')); ?>.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Show Chord Sheet on top', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_checkbox_show_chord_sheet_on_top' name='<?php echo $pname; ?>_checkbox_show_chord_sheet_on_top' <?php checked(get_option($pname . '_checkbox_show_chord_sheet_on_top'), 1); ?> value='1'>
                                    <p class="description"><?php echo esc_html(__('If one fo the Chord Sheet options is selected, this option will display it on top before the song instead of at the bottom after it. You can overwrite this setting per shortcut with "showchordsheetontop=yes/no"', 'chordpress')); ?>.</p>
                                </td>
                            </tr>
                            <tr>
                                <th sope="row" colspan="2"><?php submit_button(); ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <?php
                //  ,-----------------,
                // _| Tab: Formatting |_
                //
                if ($active_tab == 'tab_formatting') $display = "display:block;";
                else $display = "display:none;";
                $inputSize = '60';
                ?>
                <div style="<?php echo $display; ?>">
                    <div class="<?php echo $pprefix; ?>-callout <?php echo $pprefix; ?>-callout-info">
                        <?php echo esc_html(__('Use this tab to select styles and formats of the rendered ChordPro text.', 'chordpress')); ?><br>
                    </div>
                    <table class="form-table" style="margin-left:16px;">
                        <tbody>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_select_title_level"><?php echo esc_html(__('Title Level', 'chordpress')); ?></label></th>
                                <td>
                                    <?php
                                    $defaultValue = 'h1';
                                    $selection = get_option($pname . '_select_title_level');
                                    if (!strlen($selection)) $selection = $defaultValue;
                                    ?>
                                    <select id="<?php echo $pname; ?>_select_title_level" name="<?php echo $pname; ?>_select_title_level">
                                        <option value='h1' <?php echo ($selection == 'h1') ? "selected" : ""; ?>>Header 1</option>
                                        <option value='h2' <?php echo ($selection == 'h2') ? "selected" : ""; ?>>Header 2</option>
                                        <option value='h3' <?php echo ($selection == 'h3') ? "selected" : ""; ?>>Header 3</option>
                                        <option value='h4' <?php echo ($selection == 'h4') ? "selected" : ""; ?>>Header 4</option>
                                        <option value='h5' <?php echo ($selection == 'h5') ? "selected" : ""; ?>>Header 5</option>
                                        <option value='h6' <?php echo ($selection == 'h6') ? "selected" : ""; ?>>Header 6</option>
                                    </select>
                                    <p class="description"><?php echo esc_html(__('Select the header level for the title directive.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_select_subtitle_level"><?php echo esc_html(__('Subtitle Level', 'chordpress')); ?></label></th>
                                <td>
                                    <?php
                                    $defaultValue = 'h2';
                                    $selection = get_option($pname . '_select_subtitle_level');
                                    if (!strlen($selection)) $selection = $defaultValue;
                                    ?>
                                    <select id="<?php echo $pname; ?>_select_subtitle_level" name="<?php echo $pname; ?>_select_subtitle_level">
                                        <option value='h1' <?php echo ($selection == 'h1') ? "selected" : ""; ?>>Header 1</option>
                                        <option value='h2' <?php echo ($selection == 'h2') ? "selected" : ""; ?>>Header 2</option>
                                        <option value='h3' <?php echo ($selection == 'h3') ? "selected" : ""; ?>>Header 3</option>
                                        <option value='h4' <?php echo ($selection == 'h4') ? "selected" : ""; ?>>Header 4</option>
                                        <option value='h5' <?php echo ($selection == 'h5') ? "selected" : ""; ?>>Header 5</option>
                                        <option value='h6' <?php echo ($selection == 'h6') ? "selected" : ""; ?>>Header 6</option>
                                    </select>
                                    <p class="description"><?php echo esc_html(__('Select the header level for the subtitle directive.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_text_meta_style"><?php echo esc_html(__('Meta Information Style', 'chordpress')); ?></label></th>
                                <td>
                                    <input size="<?php echo $inputSize; ?>" type="text" id="<?php echo $pname; ?>_text_meta_style" name="<?php echo $pname; ?>_text_meta_style" value="<?php echo get_option($pname . '_text_meta_style'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Enter CSS for the meta header block, e.g.', 'chordpress')); ?>:<br>
                                    <code>font-style: italic;</code></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_text_line_style"><?php echo esc_html(__('Line Style', 'chordpress')); ?></label></th>
                                <td>
                                    <input size="<?php echo $inputSize; ?>" type="text" id="<?php echo $pname; ?>_text_line_style" name="<?php echo $pname; ?>_text_line_style" value="<?php echo get_option($pname . '_text_line_style'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Enter CSS for the lines here or leave empty to use the default (margin: 1em 0 1em 0;).', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_text_chord_style"><?php echo esc_html(__('Chord Style', 'chordpress')); ?></label></th>
                                <td>
                                    <input size="<?php echo $inputSize; ?>" type="text" id="<?php echo $pname; ?>_text_chord_style" name="<?php echo $pname; ?>_text_chord_style" value="<?php echo get_option($pname . '_text_chord_style'); ?>" />
                                    <p class="description"><?php echo esc_html(__("Enter CSS for the chords here or leave empty to use the page default. E.g. try this for red text on a light yellow badge", 'chordpress')); ?>:<br>
                                    <code>background-color: #F7F1AF; border-radius: 0.3em; color: #990000; padding: 0.1em 0.3em 0.1em 0.3em;</code></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_text_lyrics_style"><?php echo esc_html(__('Lyrics Style', 'chordpress')); ?></label></th>
                                <td>
                                    <input size="<?php echo $inputSize; ?>" type="text" id="<?php echo $pname; ?>_text_lyrics_style" name="<?php echo $pname; ?>_text_lyrics_style" value="<?php echo get_option($pname . '_text_lyrics_style'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Enter CSS for the lyrics here or leave empty to use the page default.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_text_comment_style"><?php echo esc_html(__('Comment Style', 'chordpress')); ?></label></th>
                                <td>
                                    <input size="<?php echo $inputSize; ?>" type="text" id="<?php echo $pname; ?>_text_comment_style" name="<?php echo $pname; ?>_text_comment_style" value="<?php echo get_option($pname . '_text_comment_style'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Enter CSS for comments, e.g.', 'chordpress')); ?>:<br>
                                    <code>background-color: #606060; font-style: italic; padding: 4px;</code></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_text_chorus_style"><?php echo esc_html(__('Chorus Style', 'chordpress')); ?></label></th>
                                <td>
                                    <input size="<?php echo $inputSize; ?>" type="text" id="<?php echo $pname; ?>_text_chorus_style" name="<?php echo $pname; ?>_text_chorus_style" value="<?php echo get_option($pname . '_text_chorus_style'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Enter CSS for the', 'chordpress')); ?> <a href="https://www.chordpro.org/chordpro/Directives-env_chorus.html" target="_blank"><?php echo esc_html(__('chorus sections', 'chordpress')); ?>.</a></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_text_verse_style"><?php echo esc_html(__('Verse Style', 'chordpress')); ?></label></th>
                                <td>
                                    <input size="<?php echo $inputSize; ?>" type="text" id="<?php echo $pname; ?>_text_verse_style" name="<?php echo $pname; ?>_text_verse_style" value="<?php echo get_option($pname . '_text_verse_style'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Enter CSS for the', 'chordpress')); ?> <a href="https://www.chordpro.org/chordpro/Directives-env_verse.html" target="_blank"><?php echo esc_html(__('verse sections', 'chordpress')); ?>.</a></p>
                                </td>
                            </tr>
                            <tr>
                                <th sope="row" colspan="2"><?php submit_button(); ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <?php
                //  ,--------------------,
                // _| Tab: Chord Options |_
                //
                if ($active_tab == 'tab_chord') $display = "display:block;";
                else $display = "display:none;";
                ?>
                <div style="<?php echo $display; ?>">
                    <div class="<?php echo $pprefix; ?>-callout <?php echo $pprefix; ?>-callout-info">
                        <?php echo __('Use this tab to specify global styles and formats for the ChordPress guitar chord diagrams.<br>For single chords using the <code>[chordpress-chord]</code> shortcode, some of them can be overwritten by shortcode parameters.', 'chordpress'); ?><br>
                    </div>
                    <table class="form-table" style="margin-left:16px;">
                        <tbody>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Sample Display', 'chordpress')); ?></th>
                                <td>
                                    <?php
                                    $C = new ChordPress_Chord();
                                    $C->setProperty('title', 'C Major');
                                    $C->setProperty('fingers', $C->replace_brackets("(2,1,'1'),(4,2,'2'),(5,3,'3')"));
                                    $C->setProperty('frets', 4);
                                    $C->setProperty('position', 1);
                                    $C->setProperty('strings', 6);
                                    $C->setTuning("E,A,D,G,B,E");
                                    echo $C->createSvgChord();
                                    ?>
                                    <p class="description"><?php echo esc_html(__('This is a sample display based on your settings. You might need to refresh the page to show the diagram.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_text_chord_backgroundColor"><?php echo esc_html(__('Background Color', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="text" maxlength="7" id="<?php echo $pname; ?>_text_chord_backgroundColor" name="<?php echo $pname; ?>_text_chord_backgroundColor" value="<?php echo get_option($pname . '_text_chord_backgroundColor'); ?>" />
                                    <p class="description"><?php echo esc_html(__('The background CSS color of the chord diagram, e.g. #FFFFFF. To set the background to transparent (default) either set this to \'none\' or leave empty.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_number_chord_barreChordRadius"><?php echo esc_html(__('Barre Border Radius', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="number" step="0.01" id="<?php echo $pname; ?>_number_chord_barreChordRadius" name="<?php echo $pname; ?>_number_chord_barreChordRadius" value="<?php echo get_option($pname . '_number_chord_barreChordRadius'); ?>" />
                                    <p class="description"><?php echo esc_html(__('The barre chord rectangle border radius relative to the nutSize (eg. 1 means completely round endges, 0 means not rounded at all). Leave empty for the default: 0.25.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_text_chord_barreChordStrokeColor"><?php echo esc_html(__('Barre Bar Stroke Color', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="text" maxlength="7" id="<?php echo $pname; ?>_text_chord_barreChordStrokeColor" name="<?php echo $pname; ?>_text_chord_barreChordStrokeColor" value="<?php echo get_option($pname . '_text_chord_barreChordStrokeColor'); ?>" />
                                    <p class="description"><?php echo esc_html(__('The stroke CSS color of a barre chord. Defaults to the nut color if not set. Leave empty for the default \'Nut Color\'.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_number_chord_barreChordStrokeWidth"><?php echo esc_html(__('Barre Bar Stroke Width', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="number" id="<?php echo $pname; ?>_number_chord_barreChordStrokeWidth" name="<?php echo $pname; ?>_number_chord_barreChordStrokeWidth" value="<?php echo get_option($pname . '_number_chord_barreChordStrokeWidth'); ?>" />
                                    <p class="description"><?php echo esc_html(__('The stroke width of a barre chord in pixel. Leave empty for the default 0.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_number_chord_canvasWidth"><?php echo esc_html(__('Canvas Width', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="number" id="<?php echo $pname; ?>_number_chord_canvasWidth" name="<?php echo $pname; ?>_number_chord_canvasWidth" value="<?php echo get_option($pname . '_number_chord_canvasWidth'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Enter the width of the chord diagrams canvas in pixel. Leave emtpy for the default of 180. The height will be adjusted automatically.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_text_chord_color"><?php echo esc_html(__('Global Color', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="text" maxlength="7" id="<?php echo $pname; ?>_text_chord_color" name="<?php echo $pname; ?>_text_chord_color" value="<?php echo get_option($pname . '_text_chord_color'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Global color of the whole chart. Can be overridden with more specific color settings such as \'Title Color\' or \'String Color\'. Leave empty for the default #000000.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_number_chord_emptyStringIndicatorSize"><?php echo esc_html(__('Empty String Indicator Size', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="number" step="0.01" id="<?php echo $pname; ?>_number_chord_emptyStringIndicatorSize" name="<?php echo $pname; ?>_number_chord_emptyStringIndicatorSize" value="<?php echo get_option($pname . '_number_chord_emptyStringIndicatorSize'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Size of the Xs and Os above empty strings relative to the space between two strings. Leave empty for the default: 0.6.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Fixed Diagram Position', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_checkbox_chord_fixedDiagramPosition' name='<?php echo $pname; ?>_checkbox_chord_fixedDiagramPosition' <?php checked(get_option($pname . '_checkbox_chord_fixedDiagramPosition'), 1); ?> value='1'>
                                    <p class="description"><?php echo esc_html(__('With this option selected, the distance between the chord diagram and the top of the SVG stays the same, no matter if a title is defined or not. Default is off.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_text_chord_fontFamily"><?php echo esc_html(__('Font Family', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="text" id="<?php echo $pname; ?>_text_chord_fontFamily" name="<?php echo $pname; ?>_text_chord_fontFamily" value="<?php echo get_option($pname . '_text_chord_fontFamily'); ?>" />
                                    <p class="description"><?php echo esc_html(__('The font family used for all letters and numbers. Leave empty for the default: \'Arial, "Helvetica Neue", Helvetica, sans-serif\'.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_text_chord_fretColor"><?php echo esc_html(__('Fret Color', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="text" maxlength="7" id="<?php echo $pname; ?>_text_chord_fretColor" name="<?php echo $pname; ?>_text_chord_fretColor" value="<?php echo get_option($pname . '_text_chord_fretColor'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Fret color. Leave empty for default: \'Global Color\'.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_text_chord_fretLabelColor"><?php echo esc_html(__('Fret Label Color', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="text" maxlength="7" id="<?php echo $pname; ?>_text_chord_fretLabelColor" name="<?php echo $pname; ?>_text_chord_fretLabelColor" value="<?php echo get_option($pname . '_text_chord_fretLabelColor'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Fret label color. Leave empty for default: \'Global Color\'.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_number_chord_fretLabelFontSize"><?php echo esc_html(__('Fret Label Font Size', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="number" id="<?php echo $pname; ?>_number_chord_fretLabelFontSize" name="<?php echo $pname; ?>_number_chord_fretLabelFontSize" value="<?php echo get_option($pname . '_number_chord_fretLabelFontSize'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Font size of the fret label. Leave empty for the default: 38.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_number_chord_frets"><?php echo esc_html(__('Frets', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="number" maxlength="2" id="<?php echo $pname; ?>_number_chord_frets" name="<?php echo $pname; ?>_number_chord_frets" value="<?php echo get_option($pname . '_number_chord_fretLabelFontSize'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Number of frets to show in the chart. Leave empty for the default: 4.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_number_chord_fretSize"><?php echo esc_html(__('Fret Height', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="number" step="0.01" id="<?php echo $pname; ?>_number_chord_fretSize" name="<?php echo $pname; ?>_number_chord_fretSize" value="<?php echo get_option($pname . '_number_chord_fretSize'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Height of a fret, relative to the space between two strings. Leave empty for the default: 1.5.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_number_chord_nutSize"><?php echo esc_html(__('Nut Size', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="number" step="0.01" id="<?php echo $pname; ?>_number_chord_nutSize" name="<?php echo $pname; ?>_number_chord_nutSize" value="<?php echo get_option($pname . '_number_chord_nutSize'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Size of a nut relative to the string spacing. Leave empty for the default: 0.85.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_text_chord_nutColor"><?php echo esc_html(__('Nut Color', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="text" maxlength="7" id="<?php echo $pname; ?>_text_chord_nutColor" name="<?php echo $pname; ?>_text_chord_nutColor" value="<?php echo get_option($pname . '_text_chord_nutColor'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Color of a finger/nut. Leave empty for default: \'Global Color\'.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_text_chord_nutStrokeColor"><?php echo esc_html(__('Nut Stroke Color', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="text" maxlength="7" id="<?php echo $pname; ?>_text_chord_nutStrokeColor" name="<?php echo $pname; ?>_text_chord_nutStrokeColor" value="<?php echo get_option($pname . '_text_chord_nutStrokeColor'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Stroke color of a nut. Leave empty for default: \'Nut Color\'. If nut color is not set it defaults to \'Global Color\'.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_number_chord_nutStrokeWidth"><?php echo esc_html(__('Nut Stroke Width', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="number" maxlength="3" id="<?php echo $pname; ?>_number_chord_nutStrokeWidth" name="<?php echo $pname; ?>_number_chord_nutStrokeWidth" value="<?php echo get_option($pname . '_number_chord_nutStrokeWidth'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Stroke width of a nut. Leave empty for the default: 0.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_text_chord_nutTextColor"><?php echo esc_html(__('Nut Text Color', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="text" maxlength="7" id="<?php echo $pname; ?>_text_chord_nutTextColor" name="<?php echo $pname; ?>_text_chord_nutTextColor" value="<?php echo get_option($pname . '_text_chord_nutTextColor'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Text color of a nut. Leave empty for default: #FFFFFF.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_number_chord_nutTextSize"><?php echo esc_html(__('Nut Text Size', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="number" id="<?php echo $pname; ?>_number_chord_nutTextSize" name="<?php echo $pname; ?>_number_chord_nutTextSize" value="<?php echo get_option($pname . '_number_chord_nutTextSize'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Font size of the nut label. Leave empty for the default: 24.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_number_chord_position"><?php echo esc_html(__('Position', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="number" maxlength="2" id="<?php echo $pname; ?>_number_chord_position" name="<?php echo $pname; ?>_number_chord_position" value="<?php echo get_option($pname . '_number_chord_position'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Default start fret position (first fret is 1). Leave empty for the default: 1.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_number_chord_sidePadding"><?php echo esc_html(__('Side Padding', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="number" step="0.01" id="<?php echo $pname; ?>_number_chord_sidePadding" name="<?php echo $pname; ?>_number_chord_sidePadding" value="<?php echo get_option($pname . '_number_chord_sidePadding'); ?>" />
                                    <p class="description"><?php echo esc_html(__('The minimum side padding (from the guitar to the edge of the chart) relative to the whole width. This is only applied if it\'s larger than the letters inside of the padding (eg the starting fret). Leave empty for the default: 0.2.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_text_chord_stringColor"><?php echo esc_html(__('String Color', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="text" maxlength="7" id="<?php echo $pname; ?>_text_chord_stringColor" name="<?php echo $pname; ?>_text_chord_stringColor" value="<?php echo get_option($pname . '_text_chord_stringColor'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Text color of a nut. Leave empty for default: \'Global Color\'.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_select_chord_strings"><?php echo esc_html(__('Strings', 'chordpress')); ?></label></th>
                                <td>
                                    <?php
                                    $defaultValue = '6';
                                    $selection = get_option($pname . '_select_chord_strings');
                                    if (!strlen($selection)) $selection = $defaultValue;
                                    ?>
                                    <select id="<?php echo $pname; ?>_select_chord_strings" name="<?php echo $pname; ?>_select_chord_strings">
                                        <option value='4' <?php echo ($selection == '4') ? "selected" : ""; ?>>4</option>
                                        <option value='6' <?php echo ($selection == '6') ? "selected" : ""; ?>>6</option>
                                    </select>
                                    <p class="description"><?php echo esc_html(__('Number of strings. Default is \'6\'.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_number_chord_strokeWidth"><?php echo esc_html(__('Stroke Width', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="number" maxlength="3" id="<?php echo $pname; ?>_number_chord_strokeWidth" name="<?php echo $pname; ?>_number_chord_strokeWidth" value="<?php echo get_option($pname . '_number_chord_strokeWidth'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Global stroke width. Leave empty for the default: 2.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_select_chord_style"><?php echo esc_html(__('Style', 'chordpress')); ?></label></th>
                                <td>
                                    <?php
                                    $defaultValue = 'normal';
                                    $selection = get_option($pname . '_select_chord_style');
                                    if (!strlen($selection)) $selection = $defaultValue;
                                    ?>
                                    <select id="<?php echo $pname; ?>_select_chord_style" name="<?php echo $pname; ?>_select_chord_style">
                                        <option value='handdrawn' <?php echo ($selection == 'handdrawn') ? "selected" : ""; ?>>Handdrawn</option>
                                        <option value='normal' <?php echo ($selection == 'normal') ? "selected" : ""; ?>>Normal</option>
                                    </select>
                                    <p class="description"><?php echo esc_html(__('Select between \'Normal\' and \'Handdrawn\'. Default is \'Normal\'.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_number_chord_titleBottomMargin"><?php echo esc_html(__('Title Bottom Margin', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="number" maxlength="3" id="<?php echo $pname; ?>_number_chord_titleBottomMargin" name="<?php echo $pname; ?>_number_chord_titleBottomMargin" value="<?php echo get_option($pname . '_number_chord_titleBottomMargin'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Space between the title and the chart. Leave empty for the default: 0.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_text_chord_titleColor"><?php echo esc_html(__('Title Color', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="text" maxlength="7" id="<?php echo $pname; ?>_text_chord_titleColor" name="<?php echo $pname; ?>_text_chord_titleColor" value="<?php echo get_option($pname . '_text_chord_titleColor'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Text color of the title. Leave empty for default: \'Global Color\'.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_number_chord_titleFontSize"><?php echo esc_html(__('Title Font Size', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="number" id="<?php echo $pname; ?>_number_chord_titleFontSize" name="<?php echo $pname; ?>_number_chord_titleFontSize" value="<?php echo get_option($pname . '_number_chord_titleFontSize'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Font size of the title. This is only the initial font size. If the title doesn\'t fit, the title is automatically scaled so that it fits. Leave empty for the default: 48.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_number_chord_topFretWidth"><?php echo esc_html(__('Top Fret Width', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="number" maxlength="3" id="<?php echo $pname; ?>_number_chord_topFretWidth" name="<?php echo $pname; ?>_number_chord_topFretWidth" value="<?php echo get_option($pname . '_number_chord_topFretWidth'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Top fret width (only used if position is 1). Leave empty for the default: 10.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_text_chord_tuning"><?php echo esc_html(__('Tuning', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="text" id="<?php echo $pname; ?>_text_chord_tuning" name="<?php echo $pname; ?>_text_chord_tuning" value="<?php echo get_option($pname . '_text_chord_tuning'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Labels under the strings for their tuning. Leave empty for default: [ \'E\', \'A\', \'D\', \'G\', \'B\', \'E\' ].', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_text_chord_tuningsColor"><?php echo esc_html(__('Tunings Color', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="text" maxlength="7" id="<?php echo $pname; ?>_text_chord_tuningsColor" name="<?php echo $pname; ?>_text_chord_tuningsColor" value="<?php echo get_option($pname . '_text_chord_tuningsColor'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Tunings color. Leave empty for default: \'Global Color\'.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_number_chord_tuningsFontSize"><?php echo esc_html(__('Tunings Font Size', 'chordpress')); ?></label></th>
                                <td>
                                    <input type="number" id="<?php echo $pname; ?>_number_chord_tuningsFontSize" name="<?php echo $pname; ?>_number_chord_tuningsFontSize" value="<?php echo get_option($pname . '_number_chord_tuningsFontSize'); ?>" />
                                    <p class="description"><?php echo esc_html(__('Font size of the tunig labels. Leave empty for the default: 28.', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th sope="row" colspan="2"><?php submit_button(); ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <?php
                //  ,-----------------,
                // _| Tab: Add Chords |_
                //
                if ($active_tab == 'tab_samples') $display = "display:block;";
                else $display = "display:none;";
                ?>
                <div style="<?php echo $display; ?>">
                    <div class="<?php echo $pprefix; ?>-callout <?php echo $pprefix; ?>-callout-info">
                        <?php echo __('Use this tab to create chord diagrams. These diagram are saved as "Guitar Chord" posts. They will be added to the ones that already exist.', 'chordpress'); ?><br>
                    </div>
                    <table class="form-table" style="margin-left:16px;">
                        <tbody>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Major Chords', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_chords_major' name='<?php echo $pname; ?>_chords_major' value='1'>
                                    <p class="description"><?php echo esc_html(__('Imports a common version of the major chords for the base notes A, B, C, D, E, F and G.', 'chordpress')); ?>.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Major 7 Chords', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_chords_major_7' name='<?php echo $pname; ?>_chords_major_7' value='1'>
                                    <p class="description"><?php echo esc_html(__('Imports a common version of the major 7 chords for the base notes A, B, C, D, E, F and G.', 'chordpress')); ?>.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Major 5 Chords', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_chords_major_5' name='<?php echo $pname; ?>_chords_major_5' value='1'>
                                    <p class="description"><?php echo esc_html(__('Imports a common version of the major 5 chords for the base notes A, B, C, D, E, F and G.', 'chordpress')); ?>.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Minor Chords', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_chords_minor' name='<?php echo $pname; ?>_chords_minor' value='1'>
                                    <p class="description"><?php echo esc_html(__('Imports a common version of the minor chords for the base notes A, B, C, D, E, F and G.', 'chordpress')); ?>.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Minor 7 Chords', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_chords_minor_7' name='<?php echo $pname; ?>_chords_minor_7' value='1'>
                                    <p class="description"><?php echo esc_html(__('Imports a common version of the minor 7 chords for the base notes A, B, C, D, E, F and G.', 'chordpress')); ?>.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Diminished Chords', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_chords_dim' name='<?php echo $pname; ?>_chords_dim' value='1'>
                                    <p class="description"><?php echo esc_html(__('Imports a common version of the diminished chords for the base notes A, B, C, D, E, F and G.', 'chordpress')); ?>.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Diminished 7 Chords', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_chords_dim_7' name='<?php echo $pname; ?>_chords_dim_7' value='1'>
                                    <p class="description"><?php echo esc_html(__('Imports a common version of the diminished 7 chords for the base notes A, B, C, D, E, F and G.', 'chordpress')); ?>.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Augurated Chords', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_chords_aug' name='<?php echo $pname; ?>_chords_aug' value='1'>
                                    <p class="description"><?php echo esc_html(__('Imports a common version of the augurated chords for the base notes A, B, C, D, E, F and G.', 'chordpress')); ?>.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Suspended 2 Chords', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_chords_sus_2' name='<?php echo $pname; ?>_chords_sus_2' value='1'>
                                    <p class="description"><?php echo esc_html(__('Imports a common version of the suspended 2 chords for the base notes A, B, C, D, E, F and G.', 'chordpress')); ?>.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Suspended 4 Chords', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_chords_sus_4' name='<?php echo $pname; ?>_chords_sus_4' value='1'>
                                    <p class="description"><?php echo esc_html(__('Imports a common version of the suspended 4 chords for the base notes A, B, C, D, E, F and G.', 'chordpress')); ?>.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Suspended 7_4 Chords', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_chords_7_sus_4' name='<?php echo $pname; ?>_chords_7_sus_4' value='1'>
                                    <p class="description"><?php echo esc_html(__('Imports a common version of the suspended 7_4 chords for the base notes A, B, C, D, E, F and G.', 'chordpress')); ?>.</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo esc_html(__('Maj 7 Chords', 'chordpress')); ?></th>
                                <td>
                                    <input type='checkbox' id='<?php echo $pname; ?>_chords_maj_7' name='<?php echo $pname; ?>_chords_maj_7' value='1'>
                                    <p class="description"><?php echo esc_html(__('Imports a common version of the Maj 7 chords for the base notes A, B, C, D, E, F and G.', 'chordpress')); ?>.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="submit"><input type="submit" name="addchords" id="addchords" class="button button-primary" value="Add Chords" /></p>
                </div>

                <?php
                //  ,---------------------,
                // _| Tab: Plugin Options |_
                //
                if ($active_tab == 'tab_plugin_options') $display = "display:block;";
                else $display = "display:none;";
                ?>
                <div style="<?php echo $display; ?>">
                    <div class="<?php echo $pprefix; ?>-callout <?php echo $pprefix; ?>-callout-info">
                        <?php echo esc_html(__('Select general options for this plugin.', 'chordpress')); ?><br>
                    </div>
                    <table class="form-table" style="margin-left:16px;">
                        <tbody>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_checkbox_uninstall_delete_options"><?php echo esc_html(__('Remove options on delete', 'chordpress')); ?></label></th>
                                <td>
                                    <p><input type="checkbox" id="<?php echo $pname; ?>_checkbox_uninstall_delete_options" name="<?php echo $pname; ?>_checkbox_uninstall_delete_options" <?php checked(get_option($pname . '_checkbox_uninstall_delete_options'), 1); ?> value='1'>&nbsp;<?php echo esc_html(__('Yes', 'chordpress')); ?></p>
                                    <p class="description"><?php echo esc_html(__('Remove plugin options and settings from the database when the plugin is deleted (does not apply when the plugin is just deactivated).', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="<?php echo $pname; ?>_checkbox_uninstall_delete_chordposts"><?php echo esc_html(__('Remove guitar chord posts on delete', 'chordpress')); ?></label></th>
                                <td>
                                    <p><input type="checkbox" id="<?php echo $pname; ?>_checkbox_uninstall_delete_chordposts" name="<?php echo $pname; ?>_checkbox_uninstall_delete_chordposts" <?php checked(get_option($pname . '_checkbox_uninstall_delete_chordposts'), 1); ?> value='1'>&nbsp;<?php echo esc_html(__('Yes', 'chordpress')); ?></p>
                                    <p class="description"><?php echo esc_html(__('Remove all guitar chord posts from the database when the plugin is deleted (does not apply when the plugin is just deactivated).', 'chordpress')); ?></p>
                                </td>
                            </tr>
                            <tr>
                                <th sope="row" colspan="2"><?php submit_button(); ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <?php
                //  ,---------------------,
                // _| Tab: Plugin Info    |_
                //
                if ($active_tab == 'tab_plugin_info') $display = "display:block;";
                else $display = "display:none;";
                ?>
                <div style="<?php echo $display; ?>"">
               <table class=" about-table" style="margin-top:20px;margin-left:16px;">
                    <tbody>
                        <tr>
                            <th><img src="<?php echo plugins_url('../images/icon-128x128.png', __FILE__); ?>" alt=""></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row"><?php echo esc_html(__('Name', 'chordpress')); ?></th>
                            <td>
                                <p class="description"><?php echo CHORDPRESS_NAME; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php echo esc_html(__('Version', 'chordpress')); ?></th>
                            <td>
                                <p class="description"><?php echo CHORDPRESS_VERSION; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php echo esc_html(__('Author', 'chordpress')); ?></th>
                            <td>
                                <p class="description"><a href="<?php echo CHORDPRESS_AUTHOR_URI; ?>" target="_blank"><?php echo CHORDPRESS_AUTHOR; ?></a></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php echo esc_html(__('Documentation', 'chordpress')); ?></th>
                            <td>
                                <p class="description"><a href="<?php echo CHORDPRESS_DOC_URI; ?>" target="_blank"><?php echo CHORDPRESS_DOC_URI; ?></a></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php echo esc_html(__('Support', 'chordpress')); ?></th>
                            <td>
                                <p class="description"><a href="<?php echo CHORDPRESS_SUPPORT_URI; ?>" target="_blank"><?php echo CHORDPRESS_SUPPORT_URI; ?></a></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php echo esc_html(__('Credits', 'chordpress')); ?></th>
                            <td>
                                <ul class="description" style="list-style: square; margin-left:12px;">
                                    <li>The <a href="https://www.chordpro.org" title="ChordPro" rel="nofollow ugc" target="_blank">ChordPro</a> team</li>
                                    <li><a href="https://profiles.wordpress.org/rlisle/" title="@rlisle" rel="nofollow ugc" target="_blank">@rlisle</a> for his work on the ChordsAndLyrics plugin that he created in 2009</li>
                                    <li>Ahkâm for the beautiful <a href="https://www.freeiconspng.com/img/17579" title="ChordPress Plugin Icon" rel="nofollow ugc" target="_blank">ChordPress Plugin Icon</a></li>
                                    <li>The fine people maintaining the <a href="https://github.com/omnibrain/svguitar" title="SVGuitar" rel="nofollow ugc" target="_blank">SVGuitar</a> module</li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>

            </form>
        </div>
    </div>
    <hr>

</div>
