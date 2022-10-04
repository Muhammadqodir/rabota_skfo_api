validateForm = function() {
    var user_id = $("#user_id").val();
    var citizenship = $('#citizenship').val();
    if (citizenship == '') {
        return { 'failed': true, 'msg': 'Укажите гражданство' }
    }
    var alt_contact = contactData.getAltContacts();
    var position = $('#position').val();
    var salary = parseInt($('#salary').val().replace(' ', ''));
    var salary_by_agreement = document.querySelector("#salary_by_agreement").checked;

    if (!salary_by_agreement && isNaN(salary)) {
        return { 'failed': true, 'msg': 'Укажите зарплату' }
    }
    var b_trip = document.querySelector("#b_trip").checked;
    var moving = document.querySelector("#moving").checked;
    var employment_type = $('#employment_type option:selected').val();
    var education = eduView.getData();
    if (education.length == 0) {
        return { 'failed': true, 'msg': 'Добавте данные об образовании' }
    }
    var experience = expView.getData();
    var langs = langsView.getLangs();
    var skills = skillsView.getData();
    var driver_license = driverLicense.getData();
    var achievements = achievementView.getData();
    var family_status = $('#family_status option:selected').val();
    var interests = $("#interests").val();
    var additional_info = $("#additional_info").val();

    return {
        'failed': false,
        'data': {
            'user_id': user_id,
            'citizenship': citizenship,
            'alt_contact': JSON.stringify(alt_contact),
            'position': position,
            'salary': salary,
            'salary_by_agreement': salary_by_agreement,
            'b_trip': b_trip,
            'moving': moving,
            'employment_type': employment_type,
            'education': JSON.stringify(education),
            'experience': JSON.stringify(experience),
            'langs': JSON.stringify(langs),
            'skills': JSON.stringify(skills),
            'driver_license': JSON.stringify(driver_license),
            'achievements': JSON.stringify(achievements),
            'interests': interests,
            'family_status': family_status,
            '_token': csrf_token,
            'additional_info': additional_info
        }
    }
}

submitResume = function() {
    var validationResult = validateForm();
    if (validationResult['failed']) {
        showAlert(validationResult['msg']);
        return;
    }
    console.log(validationResult['data']);
    var request = $.ajax({
        url: submitUrl,
        method: "POST",
        data: validationResult['data'],
        dataType: "json"
    });

    request.done(function(msg) {
        console.log(msg);
        showAlert('Готово!')
    });

    request.fail(function(jqXHR, textStatus) {
        console.log(textStatus);
        console.log(jqXHR);
        showDangerAlert('Ошибка!')
    });
}