/**
 * Public Javascript
 *
 * @link       https://www.lewe.com
 * @since      1.0.0
 *
 * @package    ChordPress
 * @subpackage ChordPress/public/js
 */

/**
 * Hides an HTML parent element via CSS.
 *
 * This function hides the parent element of the given one by setting its
 * display style property to 'none'.
 *
 * @since       1.0.0
 *
 * @param object    $el   HTML object.
 */
function dismissParent(el) {

  el.parentNode.style.display = 'none';

};

/**
 * Transposes chords up
 *
 * This function hides all chord divs, then shows those for the given transpose
 * value.
 *
 * @since 1.3.0
 */
function transposeChords(cpressId, formControlId, direction) {

  let transposeElementId = "selTranspose-" + cpressId;
  if (formControlId) {
    transposeElementId = formControlId + cpressId;
  }
  // console.log(">>> " + transposeElementId);

  /**
   * Get value from transpose form element
   */
  var x = document.getElementById(transposeElementId).value;
  if (direction) {
    if (direction === 'up') {
      if (x < 11) {
        x++;
      } else {
        x = 0;
      }
    } else if (direction === 'down') {
      if (x > 0) {
        x--;
      } else {
        x = 0;
      }
    } else if (direction === 'reset') {
      x = 0;
    }
  }

  /**
   * Hide all hidable chords
   */
  var divsToHide = document.getElementsByClassName("chord-hidable-" + cpressId);
  for (var i = 0; i < divsToHide.length; i++) {
    divsToHide[i].style.display = "none";
  }

  /**
   * Now show those for the selected transpose value
   */
  var divsToShow = document.getElementsByClassName("key-" + cpressId + '-' + x);
  for (var i = 0; i < divsToShow.length; i++) {
    divsToShow[i].style.display = "";
  }

  /**
   * Change value and text of the transpose button
   */
  if (formControlId === 'btnTranspose-') {
    var btn = document.getElementById(transposeElementId);
    btn.value = x;
    btn.innerText = x;
  }
}

/**
 * Change Font Size.
 *
 * Increases/decreases the font size of an element. Usage:
 * - changeFontSize('myElement', 2);
 * - changeFontSize('myElement', -2);
 *
 * @since 5.6.0
 */
function changeFontSize(elementId, amount){
  const element = document.getElementById(elementId);
  const sizeButton = document.getElementById('btnFontSize-' + elementId);
  let currentFontSize = parseFloat(element.style.fontSize);
  if (isNaN(currentFontSize)) {
    currentFontSize = 100; // Default font size
  }
  if (amount === 0) {
    element.style.fontSize = '100%';
    sizeButton.innerText = '100%';
    return;
  }
  const newFontSize = currentFontSize + amount;
  if (newFontSize >= 0) {
    element.style.fontSize = newFontSize + '%';
    sizeButton.innerText = newFontSize + '%';
  }
}

/**
 * Modal Dialog
 *
 * This code block handles the guitar chord modal dialogs
 *
 * @since       1.4.0
 */
// var cpress_modal = document.querySelector(".cpress-modal");
// var cpress_trigger = document.querySelector(".cpress-trigger");
// var cpress_closeButton = document.querySelector(".cpress-close-button");
// function cpressToggleModal() {
//    cpress_modal.classList.toggle("cpress-show-modal");
// }
// function cpressWindowOnClick(event) {
//    if (event.target === cpress_modal) { cpressToggleModal(); }
// }
// cpress_trigger.addEventListener("click", cpressToggleModal);
// cpress_closeButton.addEventListener("click", cpressToggleModal);
// window.addEventListener("click", cpressWindowOnClick);
