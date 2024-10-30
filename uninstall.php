<?php
/** ===========================================================================
 *  Fired when the plugin is uninstalled.
 *
 * @link       https://www.lewe.com
 * @since      2.0.0
 *
 * @package    ChordPress
 * @subpackage Uninstall
 */

/**
 * If uninstall not called from WordPress, then exit.
 */
if (!defined('WP_UNINSTALL_PLUGIN')) {
  exit;
}

/**
 * @var string $pname The unique name of this plugin.
 */
$pname = 'chordpress';

/**
 * Exit if admin did not select to delete the plugin data upon uninstall/delete.
 */
if (!get_option($pname . '_checkbox_uninstall_delete_options') && !get_option($pname . '_checkbox_uninstall_delete_chordposts')) return false;

// ----------------------------------------------------------------------------
/**
 * Delete plugin options.
 */
if (get_option($pname . '_checkbox_uninstall_delete_options')) {
  $options = array(
    $pname . '_checkbox_fixed_interaction',
    $pname . '_checkbox_hide_album',
    $pname . '_checkbox_hide_artist',
    $pname . '_checkbox_hide_chords',
    $pname . '_checkbox_hide_comments',
    $pname . '_checkbox_hide_composer',
    $pname . '_checkbox_hide_print',
    $pname . '_checkbox_hide_subtitle',
    $pname . '_checkbox_hide_title',
    $pname . '_checkbox_hide_transpose',
    $pname . '_checkbox_hide_year',
    $pname . '_checkbox_hb_notation',
    $pname . '_checkbox_show_chord_sheet',
    $pname . '_checkbox_show_jtab_sheet',
    $pname . '_checkbox_show_chord_sheet_on_top',
    $pname . '_checkbox_show_numeric_transpose',
    $pname . '_select_title_level',
    $pname . '_select_subtitle_level',
    $pname . '_text_meta_style',
    $pname . '_text_chord_style',
    $pname . '_text_lyrics_style',
    $pname . '_text_comment_style',
    $pname . '_text_chorus_style',
    $pname . '_text_verse_style',
    $pname . '_text_line_style',
    $pname . '_text_chord_backgroundColor',
    $pname . '_number_chord_barreChordRadius',
    $pname . '_text_chord_barreChordStrokeColor',
    $pname . '_number_chord_barreChordStrokeWidth',
    $pname . '_number_chord_canvasWidth',
    $pname . '_text_chord_color',
    $pname . '_number_chord_emptyStringIndicatorSize',
    $pname . '_checkbox_chord_fixedDiagramPosition',
    $pname . '_text_chord_fontFamily',
    $pname . '_text_chord_fretColor',
    $pname . '_text_chord_fretLabelColor',
    $pname . '_text_chord_fretLabelColor',
    $pname . '_select_chord_fretLabelPosition',
    $pname . '_number_chord_fretLabelFontSize',
    $pname . '_number_chord_frets',
    $pname . '_number_chord_fretSize',
    $pname . '_number_chord_nutSize',
    $pname . '_text_chord_nutColor',
    $pname . '_text_chord_nutStrokeColor',
    $pname . '_number_chord_nutStrokeWidth',
    $pname . '_text_chord_nutTextColor',
    $pname . '_number_chord_nutTextSize',
    $pname . '_number_chord_position',
    $pname . '_number_chord_sidePadding',
    $pname . '_text_chord_stringColor',
    $pname . '_select_chord_strings',
    $pname . '_number_chord_strokeWidth',
    $pname . '_select_chord_style',
    $pname . '_number_chord_titleBottomMargin',
    $pname . '_text_chord_titleColor',
    $pname . '_number_chord_titleFontSize',
    $pname . '_number_chord_topFretWidth',
    $pname . '_text_chord_tuning',
    $pname . '_text_chord_tuningsColor',
    $pname . '_number_chord_tuningsFontSize',
  );

  foreach ($options as $option) {
    delete_option($option);
  }
}

// ----------------------------------------------------------------------------
/**
 * Delete guitar chord posts and post type.
 */
if (get_option($pname . '_checkbox_uninstall_delete_chordposts')) {
  $args = array(
    'post_type' => 'guitar_chord',
    'posts_per_page' => -1
  );
  $query = new WP_Query ($args);
  while ($query->have_posts()) {
    $query->the_post();
    $id = get_the_ID();
    wp_delete_post($id, true);
  }
  wp_reset_postdata();

  global $wp_post_types;
  if (isset($wp_post_types['guitar_chord'])) {
    unset($wp_post_types['guitar_chord']);
  }
}
