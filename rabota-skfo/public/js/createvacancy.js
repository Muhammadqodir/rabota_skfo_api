/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/createvacancy.js ***!
  \***************************************/
validateForm = function validateForm() {
  var position = $('#position').val();

  if (position == '') {
    return {
      'failed': true,
      'msg': 'Укажите Наименование вакансии'
    };
  }

  var alt_contact = contactData.getAltContacts();
  var duties = $('#duties').val();

  if (duties == '') {
    return {
      'failed': true,
      'msg': 'Укажите Обязанности'
    };
  }

  var conditions = $('#conditions').val();

  if (conditions == '') {
    return {
      'failed': true,
      'msg': 'Укажите Условия работы'
    };
  }

  var salary_from = parseInt($('#salaryFrom').val().replace(' ', ''));
  var salary_to = parseInt($('#salaryTo').val().replace(' ', ''));

  if (isNaN(salary_to)) {
    salary_to = 0;
  }

  var salary_by_agreement = document.querySelector("#salary_by_agreement").checked;

  if (!salary_by_agreement) {
    if (salary_from == 0 && isNaN(salary_from)) {
      return {
        'failed': true,
        'msg': 'Укажите зарплату'
      };
    }
  } else {
    salary_from = -1;
    salary_to = -1;
  }

  var experience = $('#experience option:selected').val();
  var education = $('#education option:selected').val();
  var sex = $('#sex option:selected').val();
  var tech_knowledges = $('#tech_knowledges option:selected').val();
  var driver_license = driverLicense.getData();
  var bonuses = skillsView.getData();
  var additional_info = $("#additional_info").val();
  var additional_requirements = $("#additional_requirements").val();
  
	var is_for_dp = document.querySelector("#is_for_dp").checked
	var social_package = $("#social_package").val();
  return {
    'failed': false,
    'data': {
      'vacancy_id': vacancy_id,
      'position': position,
      'alt_contact': JSON.stringify(alt_contact),
      'duties': duties,
      'conditions': conditions,
      'salary_by_agreement': salary_by_agreement,
      'salary_from': salary_from,
      'salary_to': salary_to,
      'experience': experience,
      'education': education,
      'sex': sex,
      'tech_knowledges': tech_knowledges,
      'bonuses': JSON.stringify(bonuses),
      'driver_license': JSON.stringify(driver_license),
	    'is_for_dp': is_for_dp,
	    'social_package': social_package,
      '_token': csrf_token,
      'additional_info': additional_info,
      'additional_requirements': additional_requirements
    }
  };
};

submitVacancy = function submitVacancy() {
  var validationResult = validateForm();

  if (validationResult['failed']) {
    showAlert(validationResult['msg']);
    return;
  }

  var request = $.ajax({
    url: submitUrl,
    method: "POST",
    data: validationResult['data'],
    dataType: "json"
  });
  request.done(function (msg) {
    console.log(msg);
    window.location.href = vacancies_route;
  });
  request.fail(function (jqXHR, textStatus) {
    console.log(textStatus);
  });
};
/******/ })()
;
