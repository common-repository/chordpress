<?php

/**
 * SVGuitar chord class.
 *
 * This class is based open source module "SVGuitar"
 * (https://github.com/omnibrain/svguitar).
 *
 * @since      3.0.0
 * @package    ChordPress
 * @subpackage ChordPress/includes
 */
class ChordPress_Chord
{
    /**
     * Background color.
     *
     * @since    3.0.0
     * @access   private
     * @var      string $backgroundColor The background color of the chord diagram. By default the background is transparent.
     *                                         To set the background to transparent either set this to 'none' or undefined. Default: 'none'
     */
    private $backgroundColor;

    /**
     * Barre Chord Radius.
     *
     * @since    3.0.0
     * @access   private
     * @var      integer $barreChordRadius Barre chord rectangle border radius relative to the nutSize (eg. 1 means completely round endges,
     *                                           0 means not rounded at all). Default: 0.25
     */
    private $barreChordRadius;

    /**
     * Barre Chord Stroke Color.
     *
     * @since    3.0.0
     * @access   private
     * @var      string $barreChordStrokeColor Stroke color of a barre chord. Defaults to the nut color if not set. Default: '#000000'
     */
    private $barreChordStrokeColor;

    /**
     * Barre Chord Stroke Width.
     *
     * @since    3.0.0
     * @access   private
     * @var      integer $barreChordStrokeWidth Stroke width of a barre chord. Default: 0
     */
    private $barreChordStrokeWidth;

    /**
     * Barres.
     * Example:
     * barres:
     *    { fromString: 5, toString: 1, fret: 1, text: '1', color: '#0F0', textColor: '#F00' }
     *
     * @since    3.0.0
     * @access   private
     * @var      string $barres Javascript array of [fromString, toString, fret, text, color, textColor]
     */
    private $barres;

    /**
     * Canvas Width.
     *
     * @since    3.0.0
     * @access   private
     * @var      integer $canvasWidth Canvas width in pixel. The height is automatically adjusted.
     */
    private $canvasWidth;

    /**
     * Color.
     *
     * @since    3.0.0
     * @access   private
     * @var      string $color Global color of the whole chart. Can be overridden with more specifig color settings such as
     *                               $titleColor or $stringColor etc. Default: '#000000'
     */
    private $color;

    /**
     * Empty String Indicator Size.
     *
     * @since    3.0.0
     * @access   private
     * @var      integer $emptyStringIndicatorSize Size of the Xs and Os above empty strings relative to the space between two strings. Default: 0.6
     */
    private $emptyStringIndicatorSize;

    /**
     * Fingers.
     * Example:
     *    [1, 2, '2'],                           // finger at string 1, fret 2, with text '2'
     *    [2, 3, { text: '3', color: '#F00' }],  // finger at string 2, fret 3, with text '3', colored red
     *    [3, 3, { shape: 'triangle' }],         // finger is triangle shaped
     *    [6, 'x']
     *
     * @since    3.0.0
     * @access   private
     * @var      string $fingers Javascript array of [string, fret, text | options]
     */
    private $fingers;

    /**
     * Fixed Diagram Position.
     *
     * @since    3.0.0
     * @access   private
     * @var      string $fixedDiagramPosition When set to 'true' the distance between the chord diagram and the top of the SVG stayes the same,
     *                                              no matter if a title is defined or not. Default: 'false'
     */
    private $fixedDiagramPosition;

    /**
     * Font Family.
     *
     * @since    3.0.0
     * @access   private
     * @var      string $fontFamily The font family used for all letters and numbers. Default: 'Arial, "Helvetica Neue", Helvetica, sans-serif'
     */
    private $fontFamily;

    /**
     * Fret Color.
     *
     * @since    3.0.0
     * @access   private
     * @var      string $fretColor Fret color (overrides $color). Default: '#000000'
     */
    private $fretColor;

    /**
     * Fret Label Color.
     *
     * @since    3.0.0
     * @access   private
     * @var      string $fretLabelColor Fret position color (overrides $color). Default: '#000000'
     */
    private $fretLabelColor;

    /**
     * Fret Label Position.
     *
     * @since    3.0.0
     * @access   private
     * @var      string $fretLabelPosition Position of the fret label (eg. "3fr"). Default: 'right'
     */
    private $fretLabelPosition;

    /**
     * Fret Label Font Size.
     *
     * @since    3.0.0
     * @access   private
     * @var      integer $fretLabelFontSize Font size of the fret label. Default: 38
     */
    private $fretLabelFontSize;

    /**
     * Frets.
     *
     * @since    3.0.0
     * @access   private
     * @var      integer $frets Number of frets to show. Default: 4
     */
    private $frets;

    /**
     * Fret Size.
     *
     * @since    3.0.0
     * @access   private
     * @var      integer $fretSize Height of a fret, relative to the space between two strings. Default: 1.5
     */
    private $fretSize;

    /**
     * Nut Size.
     *
     * @since    3.0.0
     * @access   private
     * @var      integer $nutSize Size of a nut relative to the string spacing. Default: 0.65
     */
    private $nutSize;

    /**
     * Nut Color.
     *
     * @since    3.0.0
     * @access   private
     * @var      string $nutColor Color of a finger/nut. Default: '#000000'
     */
    private $nutColor;

    /**
     * Nut Stroke Color.
     *
     * @since    3.0.0
     * @access   private
     * @var      string $nutStrokeColor Stroke color of a nut. Defaults to the nut color if not set. Default: '#000000'
     */
    private $nutStrokeColor;

    /**
     * Nut Stroke Width.
     *
     * @since    3.0.0
     * @access   private
     * @var      integer $nutStrokeWidth Stroke width of a nut. Default: 0
     */
    private $nutStrokeWidth;

    /**
     * Nut Text Color.
     *
     * @since    3.0.0
     * @access   private
     * @var      string $nutTextColor Color of text inside nuts. Default: '#FFF'
     */
    private $nutTextColor;

    /**
     * Nut Text Size.
     *
     * @since    3.0.0
     * @access   private
     * @var      integer $nutTextSize Size of text inside nuts. Default: 22
     */
    private $nutTextSize;

    /**
     * Position.
     *
     * @since    3.0.0
     * @access   private
     * @var      integer $position Default position if no positon is provided (first fret is 1). Default: 1
     */
    private $position;

    /**
     * Side Padding.
     *
     * @since    3.0.0
     * @access   private
     * @var      integer $sidePadding The minimum side padding (from the guitar to the edge of the SVG) relative to the whole width.
     *                                      This is only applied if it's larger than the letters inside of the padding (eg the starting fret). Default: 0.2
     */
    private $sidePadding;

    /**
     * String Color.
     *
     * @since    3.0.0
     * @access   private
     * @var      string $stringColor Strings color (overrides $color). Default: '#000000'
     */
    private $stringColor;

    /**
     * Strings.
     *
     * @since    3.0.0
     * @access   private
     * @var      integer $strings Number of strings. Default: 6
     */
    private $strings;

    /**
     * Stroke Width.
     *
     * @since    3.0.0
     * @access   private
     * @var      integer $strokeWidth Global stroke width. Default: 2
     */
    private $strokeWidth;

    /**
     * Style.
     *
     * @since    3.0.0
     * @access   private
     * @var      string $style Select between 'normal' and 'handdrawn'. Default: 'normal'
     */
    private $style;

    /**
     * Title.
     *
     * @since    3.0.0
     * @access   private
     * @var      string $title Chart title. Default: 'F# minor'
     */
    private $title;

    /**
     * Title Bottom Margin.
     *
     * @since    3.0.0
     * @access   private
     * @var      integer $titleBottomMargin Space between the title and the chart. Default: 0
     */
    private $titleBottomMargin;

    /**
     * Title Color.
     *
     * @since    3.0.0
     * @access   private
     * @var      string $titleColor Title color (overrides color). Default: '#000000'
     */
    private $titleColor;

    /**
     * Title Font Size.
     *
     * @since    3.0.0
     * @access   private
     * @var      integer $titleFontSize Font size of the title. This is only the initial font size. If the title doesn't fit,
     *                                        the title is automatically scaled so that it fits. Default: 48
     */
    private $titleFontSize;

    /**
     * Top Fret Width.
     *
     * @since    3.0.0
     * @access   private
     * @var      integer $topFretWidth Top fret width (only used if position is 1). Default: 10
     */
    private $topFretWidth;

    /**
     * Tuning.
     *
     * @since    3.0.0
     * @access   private
     * @var      string $tuning Labels under the strings. Can be any string. Default: '[ 'E', 'A', 'D', 'G', 'B', 'E' ]'
     */
    private $tuning;

    /**
     * Tunings Color.
     *
     * @since    3.0.0
     * @access   private
     * @var      string $tuningsColor Tunings color (overrides $color). Default: '#000000'
     */
    private $tuningsColor;

    /**
     * Tunings Font Size.
     *
     * @since    3.0.0
     * @access   private
     * @var      integer $tuningsFontSize Font size of the tuning labels. Default: 28
     */
    private $tuningsFontSize;

    //--------------------------------------------------------------------------

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
        /**
         * Set chord defaults
         */
        // $this->barres = "{ fromString: 5, toString: 1, fret: 1, text: '1', color: '#808080', textColor: '#ffffff' }";
        $this->barres = "6,1,1";
        $this->fingers = "(3,2,'2'),(4,3,'4'),(5,3,'3')";
        $this->title = 'F# major';

        /**
         * Get global options or set diagram defaults
         */
        if (!$this->color = get_option('chordpress_text_chord_color')) $this->color = '#000000';                                // Global color of the whole chart. Can be overridden with more specifig color settings such as @link titleColor or @link stringColor etc. | '#000000'
        if (!$this->nutColor = get_option('chordpress_text_chord_nutColor')) $this->nutColor = $this->color;                    // Color of a finger / nut | '#000'

        if (!$this->backgroundColor = get_option('chordpress_text_chord_backgroundColor')) $this->backgroundColor = "none";     // The background CSS color of the chord diagram. By default the background is transparent. To set the background to transparent either set this to 'none' or undefined | 'none'
        if (!$this->barreChordRadius = get_option('chordpress_number_chord_barreChordRadius')) $this->barreChordRadius = 0.25;  // Barre chord rectangle border radius relative to the nutSize (eg. 1 means completely round endges, 0 means not rounded at all) | 0.25
        if (!$this->barreChordStrokeColor = get_option('chordpress_text_chord_barreChordStrokeColor')) $this->barreChordStrokeColor = $this->nutColor; // Stroke color of a barre chord. Defaults to the nut color if not set | '#000000'
        if (!$this->barreChordStrokeWidth = get_option('chordpress_number_chord_barreChordStrokeWidth')) $this->barreChordStrokeWidth = 0; // Stroke width of a barre chord | 0
        if (!$this->canvasWidth = get_option('chordpress_number_chord_canvasWidth')) $this->canvasWidth = 180;                  // Canvas width of the chart
        if (!$this->emptyStringIndicatorSize = get_option('chordpress_number_chord_emptyStringIndicatorSize')) $this->emptyStringIndicatorSize = 0.6; // Size of the Xs and Os above empty strings relative to the space between two strings | 0.6
        if (!$this->fixedDiagramPosition = get_option('chordpress_checkbox_chord_fixedDiagramPosition')) $this->fixedDiagramPosition = 'false';
        else $this->fixedDiagramPosition = 'true'; // When set to true the distance between the chord diagram and the top of the SVG stayes the same, no matter if a title is defined or not. | false
        if (!$this->fontFamily = get_option('chordpress_text_chord_fontFamily')) $this->fontFamily = 'Arial, "Helvetica Neue", Helvetica, sans-serif'; // The font family used for all letters and numbers | 'Arial, "Helvetica Neue", Helvetica, sans-serif'
        if (!$this->fretColor = get_option('chordpress_text_chord_fretColor')) $this->fretColor = $this->color;                 // Fret color (overrides color) | color
        if (!$this->fretLabelColor = get_option('chordpress_text_chord_fretLabelColor')) $this->fretLabelColor = $this->color;  // Fret position color (overrides color) | color
        if (!$this->fretLabelPosition = get_option('chordpress_select_chord_fretLabelPosition')) $this->fretLabelPosition = 'right';  // Position of the fret label (eg. "3fr") | 'right'
        if (!$this->fretLabelFontSize = get_option('chordpress_number_chord_fretLabelFontSize')) $this->fretLabelFontSize = 38; // Font size of the fret label | 38
        if (!$this->frets = get_option('chordpress_number_chord_frets')) $this->frets = 4;                                      // Number of frets | 4
        if (!$this->fretSize = get_option('chordpress_number_chord_fretSize')) $this->fretSize = 1.5;                           // Height of a fret, relative to the space between two strings | 1.5
        if (!$this->nutSize = get_option('chordpress_number_chord_nutSize')) $this->nutSize = 0.85;                             // Size of a nut relative to the string spacing | 0.65
        if (!$this->nutStrokeColor = get_option('chordpress_text_chord_nutStrokeColor')) $this->nutStrokeColor = $this->nutColor;     // Stroke color of a nut. Defaults to the nut color if not set | nutColor
        if (!$this->nutStrokeWidth = get_option('chordpress_number_chord_nutStrokeWidth')) $this->nutStrokeWidth = 0;           // Stroke width of a nut | 0
        if (!$this->nutTextColor = get_option('chordpress_text_chord_nutTextColor')) $this->nutTextColor = '#FFFFFF';           // Color of text inside nuts | '#FFF'
        if (!$this->nutTextSize = get_option('chordpress_number_chord_nutTextSize')) $this->nutTextSize = 24;                   // Size of text inside nuts | 22
        if (!$this->position = get_option('chordpress_number_chord_position')) $this->position = 1;                             // Default position if no positon is provided (first fret is 1) | 1
        if (!$this->sidePadding = get_option('chordpress_number_chord_sidePadding')) $this->sidePadding = 0.2;                  // The minimum side padding (from the guitar to the edge of the SVG) relative to the whole width. This is only applied if it's larger than the letters inside of the padding (eg the starting fret) | 0.2
        if (!$this->stringColor = get_option('chordpress_text_chord_stringColor')) $this->stringColor = $this->color;           // Strings color (overrides color) | color
        if (!$this->strings = get_option('chordpress_select_chord_strings')) $this->strings = 6;                                // Number of strings | 6
        if (!$this->strokeWidth = get_option('chordpress_number_chord_strokeWidth')) $this->strokeWidth = 2;                    // Global stroke width | 2
        if (!$this->style = get_option('chordpress_select_chord_style')) $this->style = 'normal';                               // Select between 'normal' and 'handdrawn' | 'normal'
        if (!$this->titleBottomMargin = get_option('chordpress_number_chord_titleBottomMargin')) $this->titleBottomMargin = 0;  // Space between the title and the chart | 0
        if (!$this->titleColor = get_option('chordpress_text_chord_titleColor')) $this->titleColor = $this->color;              // Title color (overrides color) | color
        if (!$this->titleFontSize = get_option('chordpress_number_chord_titleFontSize')) $this->titleFontSize = 48;             // Font size of the title. This is only the initial font size. If the title doesn't fit, the title is automatically scaled so that it fits. | 48
        if (!$this->topFretWidth = get_option('chordpress_number_chord_topFretWidth')) $this->topFretWidth = 10;                // Top fret width (only used if position is 1) | 10
        if (!$this->tuning = get_option('chordpress_text_chord_tuning')) $this->tuning = "['E','A','D','G','B','E']";           // Labels under the strings. Can be any string. | [ 'E', 'A', 'D', 'G', 'B', 'E' ]
        if (!$this->tuningsColor = get_option('chordpress_text_chord_tuningsColor')) $this->tuningsColor = $this->color;        // Tunings color (overrides color) | color
        if (!$this->tuningsFontSize = get_option('chordpress_number_chord_tuningsFontSize')) $this->tuningsFontSize = 28;       // Font size of the string labels | 28

    }

    //--------------------------------------------------------------------------

    /**
     * Build the SVGuitar Javascript chord parameters
     *
     * @return    string
     * @since     3.0.0
     */
    public function buildChordParmeters()
    {
        $this->fingers = $this->replace_brackets($this->fingers);
        if (!strpos($this->barres, 'fromString')) $this->barres = $this->setBarres($this->barres);

        $output = ".chord({
            title: '" . $this->title . "',
            fingers: [" . htmlspecialchars_decode($this->fingers, ENT_QUOTES) . "],
            barres: [" . htmlspecialchars_decode($this->barres, ENT_QUOTES) . "],
            position: " . $this->position . ",
         })\n";

        return $output;
    }

    //--------------------------------------------------------------------------

    /**
     * Build the SVGuitar Javascript configure parameters
     *
     * @return    string
     * @since     3.0.0
     */
    public function buildConfigureParmeters()
    {
        $output = ".configure({
            backgroundColor: '" . $this->backgroundColor . "',
            barreChordRadius: " . $this->barreChordRadius . ",
            barreChordStrokeColor: '" . $this->barreChordStrokeColor . "',
            barreChordStrokeWidth: " . $this->barreChordStrokeWidth . ",
            color: '" . $this->color . "',
            emptyStringIndicatorSize: " . $this->emptyStringIndicatorSize . ",
            fixedDiagramPosition: " . $this->fixedDiagramPosition . ",
            fontFamily: '" . $this->fontFamily . "',
            fretColor: '" . $this->fretColor . "',
            fretLabelColor: '" . $this->fretLabelColor . "',
            fretLabelPosition: '" . $this->fretLabelPosition . "',
            fretLabelFontSize: " . $this->fretLabelFontSize . ",
            frets: " . $this->frets . ",
            fretSize: " . $this->fretSize . ",
            nutColor: '" . $this->nutColor . "',
            nutSize: " . $this->nutSize . ",
            nutStrokeColor: '" . $this->nutStrokeColor . "',
            nutStrokeWidth: " . $this->nutStrokeWidth . ",
            nutTextColor: '" . $this->nutTextColor . "',
            nutTextSize: " . $this->nutTextSize . ",
            sidePadding: " . $this->sidePadding . ",
            stringColor: '" . $this->stringColor . "',
            strings: " . $this->strings . ",
            strokeWidth: " . $this->strokeWidth . ",
            style: '" . $this->style . "',
            titleBottomMargin: " . $this->titleBottomMargin . ",
            titleColor: '" . $this->titleColor . "',
            titleFontSize: " . $this->titleFontSize . ",
            topFretWidth: " . $this->topFretWidth . ",
            tuning: " . htmlspecialchars_decode($this->tuning, ENT_QUOTES) . ",
            tuningsColor: '" . $this->tuningsColor . "',
            tuningsFontSize: " . $this->tuningsFontSize . ",
         })";
        return $output;
    }

    //--------------------------------------------------------------------------

    /**
     * Create SVGuitar chord div and script.
     *
     * @param boolean $floatleft Switch to float left (default: false)
     * @return string  HTML SVGuitar chord div and script.
     * @since  2.1.0
     */
    public function createSvgChord($floatleft = false)
    {
        $id = $this->random_string(true);

        if ($floatleft) $float = 'float:left;';
        else $float = '';

        /**
         * Build output
         */
        $output = "\n\n
        <!-- ChordPress Chord -->
        <div id=\"" . $id . "\" class=\"cpress-chord\" style=\"width:" . $this->canvasWidth . "px;" . $float . "\"></div>
        <script>\n
            async function drawChord" . $id . "() {
                var chart = new svguitar.SVGuitarChord('#" . $id . "')
                " . $this->buildChordParmeters() . "
                " . $this->buildConfigureParmeters() . "
                .draw();
            };
            drawChord" . $id . "();
        </script>\n\n";
        return $output;
    }

    //--------------------------------------------------------------------------

    /**
     * Create SVGuitar chord Javascript function.
     *
     * @param string $id Unique ID
     * @return string  SVGuitar Javascript function
     * @since  2.1.0
     */
    public function createSvgChordFunction($id)
    {
        $output = "\n\n
        function drawChord" . $id . "() {
            var chart = new svguitar.SVGuitarChord('#" . $id . "')
            " . $this->buildChordParmeters() . "
            " . $this->buildConfigureParmeters() . "
            .draw();
        };
        \n\n";
        return $output;
    }

    //--------------------------------------------------------------------------

    /**
     * Get private property.
     *
     * @return    misc
     * @since     3.0.0
     */
    public function getProperty($property)
    {
        return $this->{$property};
    }

    //--------------------------------------------------------------------------

    /**
     * Set private property.
     *
     * @param string $property Property name
     * @param misc $value Value to set the property to
     * @since     2.1.0
     */
    public function setProperty($property, $value)
    {
        $this->{$property} = $value;
    }

    // ---------------------------------------------------------------------------

    /**
     * Dump and Die.
     *
     * @param array|string $a Array to print out pretty
     * @param boolean $die - Wether to die after dump or not. Default: true.
     * @return   string
     * @since    2.0.0
     */
    public function dnd($a, $die = true)
    {
        $dump = highlight_string("<?php\n\$data =\n" . var_export($a, true) . ";\n?>");
        if ($die) die($dump);
    }

    //--------------------------------------------------------------------------

    /**
     * Generate random string.
     *
     * @param boolean $alphaonly - Whether to only use alpha charaters
     * @param integer $length - Length of random string to generate
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

    //--------------------------------------------------------------------------

    /**
     * Replace brackets.
     * Replaces round brackets with square brackets.
     *
     * @param string $input String with round bracktes
     * @return string - String with square brackets
     */
    public function replace_brackets($input)
    {
        $output = str_replace('(', '[', $input);
        $output = str_replace(')', ']', $output);
        return $output;
    }

    //--------------------------------------------------------------------------

    /**
     * Set Barre.
     * This function converts a simplified barre input:
     * '6,1,1'
     * and converts it into an SVGuitar chord javascript tuning parameter:
     * {fromString:6,toString:1,fret:1}
     *
     * @param string   Simple tuning string
     * @since     3.0.0
     */
    public function setBarres($simpleBarre)
    {
        if (!strlen($simpleBarre)) {
            $this->setProperty('barres', "");
            return;
        }
        $barre_array = explode(",", $simpleBarre);
        $barres = "{fromString:" . $barre_array[0] . ",toString:" . $barre_array[1] . ",fret:" . $barre_array[2] . "}";
        $this->setProperty('barres', $barres);
    }

    //--------------------------------------------------------------------------

    /**
     * Set Tuning.
     * This function converts a simplified tuning input:
     * 'E,A,D,G,B,E'
     * and convert it into anSVGuitar chord javascript tuning parameter:
     * ['E','A','D','G','B','E']
     *
     * @param string   Simple tuning string
     * @since     3.0.0
     */
    public function setTuning($simpleTuning)
    {
        $tuning_array = explode(",", $simpleTuning);
        $tuning = "[";
        foreach ($tuning_array as $note) {
            $tuning .= "'" . $note . "',";
        }
        $tuning = rtrim($tuning, ",");
        $tuning .= "]";
        $this->setProperty('tuning', $tuning);
    }
}
