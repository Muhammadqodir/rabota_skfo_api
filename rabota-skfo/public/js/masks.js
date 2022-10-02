/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/masks.js ***!
  \*******************************/
dateInputMask = function dateInputMask(elm) {
  elm.addEventListener('keypress', function (e) {
    if (e.keyCode < 47 || e.keyCode > 57) {
      e.preventDefault();
    }

    var len = elm.value.length; // If we're at a particular place, let the user type the slash
    // i.e., 12/12/1212

    if (len !== 1 || len !== 3) {
      if (e.keyCode == 47) {
        e.preventDefault();
      }
    } // If they don't add the slash, do it for them...


    if (len === 2) {
      elm.value += '.';
    } // If they don't add the slash, do it for them...


    if (len === 5) {
      elm.value += '.';
    }
  });
};

phoneInputMask = function phoneInputMask(elm) {
  elm.addEventListener('keypress', function (e) {
    if (e.keyCode < 47 || e.keyCode > 57) {
      e.preventDefault();
    }

    if (!elm.value.includes("+")) {
      elm.value = "+" + elm.value;
    }
  });
};

function onlyDigits(evt) {
  var theEvent = evt || window.event; // Handle paste

  if (theEvent.type === 'paste') {
    key = event.clipboardData.getData('text/plain');
  } else {
    // Handle key press
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
  }

  var regex = /[0-9]|\./;

  if (!regex.test(key)) {
    theEvent.returnValue = false;
    if (theEvent.preventDefault) theEvent.preventDefault();
  }
}

currencyInputMask = function currencyInputMask(el, evt) {
  el.value = el.value.replace(/[^\d]/, '');
  el.value = el.value.replace(/ /g, "").replace(/\B(?=(\d{3})+(?!\d))/g, " ");
};
/******/ })()
;