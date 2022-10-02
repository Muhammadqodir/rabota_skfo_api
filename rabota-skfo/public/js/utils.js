/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/utils.js ***!
  \*******************************/
resizeIframe = function resizeIframe(obj) {
  obj.style.height = obj.contentWindow.document.body.scrollHeight + 20 + 'px';
};

test = function test(argument) {
  alert(argument);
};

fillTab = function fillTab(html) {
  $("#tab_content").html(html);
};

addTabContent = function addTabContent(html) {
  $("#tab_content").html($("#tab_content").html() + html);
};

clearTabContent = function clearTabContent() {
  $("#tab_content").html("");
};

switchTab = function switchTab(tab_id) {
  tabs = ["tab_1", "tab_2"];

  for (var i = 0; i < tabs.length; i++) {
    tab = tabs[i];

    if (tab == tab_id) {
      $("#" + tab).attr('class', 'tab_selector_active');
    } else {
      $("#" + tab).attr('class', 'tab_selector');
    }
  }

  switch (tab_id) {
    case "tab_1":
      $("#new_vacancies").css("display", "block");
      $("#new_cvs").css("display", "none");
      break;

    case "tab_2":
      $("#new_vacancies").css("display", "none");
      $("#new_cvs").css("display", "block");
      break;
  }
};

sideNav = function sideNav() {
  $(document).ready(function () {
    $('a[href*=\\#]').bind('click', function (e) {
      var target = $(this).attr("href"); // Set the target as variable

      $([document.documentElement, document.body]).animate({
        scrollTop: $(target).offset().top - 80
      });
      return false;
    });
  });
  $(window).scroll(function () {
    var scrollDistance = $(window).scrollTop(); // Assign active class to nav links while scolling

    $('.page-section').each(function (i) {
      if ($(this).position().top <= scrollDistance) {
        $('.navigation__link').removeClass('active');
        $('.navigation__link').eq(i).addClass('active');
      }
    });
  }).scroll();
};
/******/ })()
;