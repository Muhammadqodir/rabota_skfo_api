/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/profile.js ***!
  \*********************************/
fillUniversities = function fillUniversities() {
  var id = $('#region').val();
  var request = $.ajax({
    url: requestUrl,
    method: "GET",
    data: {
      'id': id
    },
    dataType: "json"
  });
  request.done(function (univers) {
    var univerSelect = $('#univer');
	  univerSelect.html("");
    univers[0].forEach(function (element) {
      if (element['id'] == selUniverId) {
        univerSelect.append('<option selected value="' + element['id'] + '">' + element['fullName'] + '</option>');
      } else {
        univerSelect.append('<option value="' + element['id'] + '">' + element['fullName'] + '</option>');
      }
    }); // $("#log").html(msg);
  });
  request.fail(function (jqXHR, textStatus) {
    console.log(textStatus);
  });
};
/******/ })()
;
