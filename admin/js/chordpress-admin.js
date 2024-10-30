/**
 * Admin Javascript
 *
 * @link       https://www.lewe.com
 * @since      1.0.0
 *
 * @package    ChordPress
 * @subpackage ChordPress/admin/js
 */

/**
 * Hides an HTML parent element via CSS.
 *
 * This function hides the parent element of the given one by setting its
 * display style property to 'none'.
 *
 * @since      2.0.0
 *
 * @param object    $el    HTML object.
 */
function dismissParent(el) {

   el.parentNode.style.display='none';
   
};
