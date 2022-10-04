ContactData = class ContactData {
    constructor(rootView, data) {
        this.rootView = rootView;
        data.forEach(element => {
            this.addAltContactRow(element);
        })
    }

    getRootView() {
        return $("#" + this.rootView);
    }

    altContactData = [];

    addAltContactRow = function(data = { 'key': 'Почта', 'value': '' }) {
        var no = this.altContactData.length;
        var htmlData = '<div class="row" id="' + this.rootView + 'Item' + no + '">' +
            '<div class="col-5"><div class="formControl" style="margin-top: 10px;">' +
            '<select onchange="contactData.saveAltContactRow(' + no + ')" id="altC_key' + no + '">' +
            '<option ' + (data['key'] == 'Почта' ? "selected" : '') + '>Почта</option><option ' + (data['key'] == 'Facebook' ? "selected" : '') + '>Facebook</option><option ' + (data['key'] == 'Instagram' ? "selected" : '') + '>Instagram</option><option ' + (data['key'] == 'IMO' ? "selected" : '') + '>IMO</option><option ' + (data['key'] == 'LinkedIn' ? "selected" : '') + '>Linkedin</option><option ' + (data['key'] == 'Telegram' ? "selected" : '') + '>Telegram</option><option ' + (data['key'] == 'Twitter' ? "selected" : '') + '>Twitter</option><option ' + (data['key'] == 'Viber' ? "selected" : '') + '>Viber</option><option ' + (data['key'] == 'VK' ? "selected" : '') + '>VK</option><option ' + (data['key'] == 'WhatsApp' ? "selected" : '') + '>WhatsApp</option></select></div></div><div class="col-6" style="padding-left: 0px; padding-right: 0px;"><div class="formControl" id="" style="margin-top: 10px;">' +
            '<input value="' + data['value'] + '" onchange="contactData.saveAltContactRow(' + no + ')" id="altC_val' + no + '"></div></div><div class="col-1">' +
            '<h5 class="backButton" onclick="contactData.removeAltContactsRow(' + no + ')">' +
            '<i class="fas fa-trash-alt" ></i></h5></div></div>';

        this.altContactData.push(data);
        this.getRootView().append(htmlData);
    }

    getAltContacts = function() {
        var returnData = [];
        for (var i = 0; i < this.altContactData.length; i++) {
            if (this.altContactData[i]["value"] != "empty" && this.altContactData[i]["value"] != "") {
                returnData.push(this.altContactData[i]);
            }
        }
        return returnData;
    }

    removeAltContactsRow = function(id) {
        $('#' + this.rootView + 'Item' + id).remove();
        this.altContactData[id]["value"] = "empty";
    }

    saveAltContactRow = function(id) {
        var key = $("#altC_key" + id + " option:selected").text();
        // console.log(key);
        var val = $("#altC_val" + id).val();
        // console.log(val);
        var newContact = { "key": key, "value": val };
        this.altContactData[id] = newContact;
    }
}

SkillsView = class SkillsView {
    skillsList = [];
    constructor(rootView, input, button, data) {
        this.rootView = rootView;
        this.input = $("#" + input);
        this.button = $("#" + button);
        const addButton = $("#" + button);
        this.input.keyup(function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                addButton.click();
            } else {
                // console.log(event.keyCode);
            }
        });
        this.button.on('click', function(e) {
            skillsView.addSkill();
        });
        data.forEach(element => {
            this.addSkill1(element);
        });
    }

    removeSkill = function(id) {
        $("#skill" + id).remove();
        this.skillsList[id] = '';
    }

    getRootView() {
        return $("#" + this.rootView);
    }

    addSkill = function() {
        var skill = this.input.val();
        if (skill != "") {
            var no = this.skillsList.length;
            this.input.val("");
            $("#" + this.rootView).append('<span class="skill" id="skill' + no + '"> <i class="far fa-check-circle"></i> ' + skill + ' <i class="fas fa-times" onclick="skillsView.removeSkill(' + no + ')" style="color: #FF5F5F; cursor: pointer;"></i> </span>');
            this.skillsList.push(skill);
        }
    }

    addSkill1 = function(skill) {
        if (skill != "") {
            var no = this.skillsList.length;
            this.input.val("");
            $("#" + this.rootView).append('<span class="skill" id="skill' + no + '"> <i class="far fa-check-circle"></i> ' + skill + ' <i class="fas fa-times" onclick="skillsView.removeSkill(' + no + ')" style="color: #FF5F5F; cursor: pointer;"></i> </span>');
            this.skillsList.push(skill);
        }
    }

    getData = function() {
        var returnData = [];
        for (var i = 0; i < this.skillsList.length; i++) {
            if (this.skillsList[i] != "") {
                returnData.push(this.skillsList[i]);
            }
        }
        return returnData;
    }
}

LangsView = class LangsView {
    constructor(rootView, addButton, data) {
        this.rootView = rootView;
        this.addButton = $('#' + addButton);
        this.addButton.on('click', function(e) {
            langsView.addAltLangRow();
        });
        isFirst = true;
        data.forEach(element => {
            if (isFirst) {
                $("#langName0").val(element['key']);
                $("#langLevel0").val();
                this.langList.push({ "key": element['key'], "value": element['value'] });
                isFirst = false;
            } else {
                this.addAltLangRow(element);
            }
        })
    }

    getRootView() {
        return $('#' + this.rootView);
    }

    langList = [];
    addAltLangRow = function(data = { "key": "", "value": 0 }) {
        var no = this.langList.length;
        var htmlData = '<div class="row" id="langItem' + no + '" style="margin-top: 8px;"><div class="col-5"><div class="formControl" style="margin-top: 5px;"><input value="' + data['key'] + '" onchange="langsView.setLangName(' + no + ')" id="langName' + no + '" placeholder=""></div></div><div class="col-6" style="padding-left: 0px;"><div class="formControl" style="margin-top: 5px;"><select onchange="langsView.setLangLevel(' + no + ')" id="langLevel' + no + '"><option value="0" ' + (data['value'] == '0' ? 'selected' : '') + '>Начальный</option><option value="1" ' + (data['value'] == '1' ? 'selected' : '') + '>Средний</option><option value="2" ' + (data['value'] == '2' ? 'selected' : '') + '>Хороший</option><option value="3" ' + (data['value'] == '3' ? 'selected' : '') + '>Свободное владение</option></select></div></div><div class="col-1" style="padding-left: 0px;"><h5 style="margin-top: 12px; text-align: right;" onclick="langsView.removelangRow(' + no + ')"><i class="fas fa-trash-alt" aria-hidden="true"></i></h5></div></div>';
        this.langList.push(data);
        this.getRootView().append(htmlData);
    }

    setLangLevel = function(id) {
        var level = $("#langLevel" + id).val();
        this.langList[id]["value"] = level;
    }

    setLangName = function(id) {
        var level = $("#langName" + id).val();
        this.langList[id]["key"] = level;
    }

    removelangRow = function(id) {
        $("#langItem" + id).remove();
        this.langList[id]['value'] = 'empty';
    }

    getLangs = function() {
        var returnData = [];
        for (var i = 0; i < this.langList.length; i++) {
            if (this.langList[i]["key"] != "empty" && this.langList[i]["key"] != "") {
                returnData.push(this.langList[i]);
            }
        }
        return returnData;
    }
}

EducationView = class EducationView {
    educationData = [];

    constructor(rootView, data) {
        this.rootView = rootView;
        data.forEach(element => {
            this.addEduRow(element);
        });
    }

    addEduRow = function(data = {
        "eduType": "",
        "eduName": "",
        "eduFaculty": "",
        "eduSpeciality": "",
        "eduStart": "",
        "eduEnd": "",
        "checkEduNowDays": false
    }) {
        var id = this.educationData.length;
        var htmlData = '<div id="eduItem' + id + '" class="card" style="padding: 15px; margin-top: 12px;"><div class="row"><div class="col-md-12 col-lg-6"><div class="formControl" style="margin-top: 5px;"><label for="eduType' + id + '">Форма обучения <span class="necessarly">*</span></label><select onchange="eduView.saveEduRow(' + id + ')" id="eduType' + id + '"><option ' + (data["eduType"] == 'Очная' ? "selected" : "") + '>Очная</option><option ' + (data["eduType"] == 'Очно-заочное (вечерняя)' ? "selected" : "") + '>Очно-заочное (вечерняя)</option><option ' + (data["eduType"] == 'Заочная' ? "selected" : "") + '>Заочная</option><option ' + (data["eduType"] == 'Дистанционная' ? "selected" : "") + '>Дистанционная</option></select></div></div><div class="col-md-12 col-lg-6"><div class="formControl" style="margin-top: 5px;"><label for="eduName' + id + '">Учебное заведение <span class="necessarly">*</span></label><input value="' + data["eduName"] + '" onchange="eduView.saveEduRow(' + id + ')" id="eduName' + id + '" placeholder=""></div></div><div class="col-md-12 col-lg-6"><div class="formControl"><label for="eduFaculty' + id + '">Факультет</label><input value="' + data["eduFaculty"] + '" onchange="eduView.saveEduRow(' + id + ')" id="eduFaculty' + id + '" placeholder=""></div></div><div class="col-md-12 col-lg-6"><div class="formControl"><label for="eduSpeciality' + id + '">Специальность</label><input  value="' + data["eduSpeciality"] + '"onchange="eduView.saveEduRow(' + id + ')" id="eduSpeciality' + id + '" placeholder=""></div></div><div class="col-md-12 col-lg-6"><div class="formControl"><label for="eduStart' + id + '">Начало обучения <span class="necessarly">*</span></label><input value="' + data["eduStart"] + '" onchange="eduView.saveEduRow(' + id + ')" class=".date_mask" id="eduStart' + id + '" maxlength="10" placeholder="дд.мм.гггг"></div></div><div class="col-md-12 col-lg-6"><div class="formControl"><label for="eduEnd' + id + '">Окончание обучения <span class="necessarly">*</span></label><input value="' + data["eduEnd"] + '" onchange="eduView.saveEduRow(' + id + ')" class=".date_mask" id="eduEnd' + id + '" maxlength="10" placeholder="дд.мм.гггг"></div><div style="margin-top: 20px;" class="custom-control formControl custom-checkbox mr-sm-2"><input ' + (data['checkEduNowDays'] == "true" ? "checked" : "") + ' type="checkbox" class="custom-control-input" onclick="eduView.saveEduRow(' + id + ')" id="checkEduNowDays' + id + '"><label class="custom-control-label" for="checkEduNowDays' + id + '">Учусь в данный момент</label></div></div></div><h5 class="backButton" style="padding: 0px;" onclick="eduView.removeEduRow(' + id + ')"><i class="fas fa-trash-alt" aria-hidden="true"></i> Удалить</h5></div>';
        this.educationData.push(data);
        this.getRootView().append(htmlData);
        dateInputMask(document.querySelector('#eduEnd' + id + ''));
        dateInputMask(document.querySelector('#eduStart' + id + ''));
    }

    getRootView() {
        return $('#' + this.rootView);
    }

    getData = function() {
        var returnData = [];
        for (var i = 0; i < this.educationData.length; i++) {
            if (this.validateData(this.educationData[i])) {
                returnData.push(this.educationData[i]);
            } else {
                showAlert("Заполните все поля!")
            }
        }
        return returnData;
    }

    removeEduRow = function(id) {
        $('#eduItem' + id).remove();
        this.educationData[id]["value"] = "empty";
    }

    saveEduRow = function(id) {
        var eduType = $('#eduType' + id + ' option:selected').text();
        var eduName = $('#eduName' + id).val();
        var eduFaculty = $('#eduFaculty' + id).val();
        var eduSpeciality = $('#eduSpeciality' + id).val();
        var eduStart = $('#eduStart' + id).val();
        var eduEnd = $('#eduEnd' + id).val();
        var checkEduNowDays = document.querySelector("#checkEduNowDays" + id).checked;

        var newEdu = {
            "eduType": eduType,
            "eduName": eduName,
            "eduFaculty": eduFaculty,
            "eduSpeciality": eduSpeciality,
            "eduStart": eduStart,
            "eduEnd": eduEnd,
            "checkEduNowDays": checkEduNowDays + ""
        };
        this.educationData[id] = newEdu;
    }

    validateData = function(data) {
        if (data['eduName'] != "") {
            return true;
        } else {
            return false;
        }
    }
}

ExpView = class ExpView {

    expData = []

    constructor(rootView, data) {
        this.rootView = rootView;
        data.forEach(element => {
            this.addExpRow(element);
        })
    }

    getRootView = function() {
        return $('#' + this.rootView);
    }

    addExpRow = function(data = {
        "expCompanyname": "",
        "expSphere": "",
        "expPosition": "",
        "expCountry": "",
        "expStart": "",
        "expEnd": "",
        "expDuties": "",
        "checkExpNowDays": false
    }) {
        var id = this.expData.length;
        var htmlData = '<div class="card" id="expItem' + id + '" style="padding: 15px; margin-top: 12px;"><div class="row"><div class="col-md-12 col-lg-6"><div class="formControl" style="margin-top: 5px;"><label for="expCompanyName' + id + '">Компания <span class="necessarly">*</span></label><input value="' + data["expCompanyName"] + '" onchange="expView.saveRow(' + id + ')" id="expCompanyName' + id + '" placeholder=""></div></div><div class="col-md-12 col-lg-6"><div class="formControl" style="margin-top: 5px;"><label for="expSphere' + id + '">Сфера <span class="necessarly">*</span></label><input value="' + data["expSphere"] + '" onchange="expView.saveRow(' + id + ')" id="expSphere' + id + '" placeholder=""></div></div><div class="col-md-12 col-lg-6"><div class="formControl"><label for="expPosition' + id + '">Должность <span class="necessarly">*</span></label><input value="' + data["expPosition"] + '" id="expPosition' + id + '" onchange="expView.saveRow(' + id + ')" placeholder=""></div></div><div class="col-md-12 col-lg-6"><div class="formControl"><label for="expCountry' + id + '">Страна, город <span class="necessarly">*</span></label><input value="' + data["expCountry"] + '" onchange="expView.saveRow(' + id + ')" id="expCountry' + id + '" placeholder=""></div></div><div class="col-md-12 col-lg-6"><div class="formControl"><label for="expStart' + id + '">Начало работы <span class="necessarly">*</span></label><input value="' + data["expStart"] + '" onchange="expView.saveRow(' + id + ')" class=".date_mask" id="expStart' + id + '" maxlength="10" placeholder="дд.мм.гггг"></div></div><div class="col-md-12 col-lg-6"><div class="formControl"><label for="expEnd' + id + '">Окончание работы <span class="necessarly">*</span></label><input value="' + data['expEnd'] + '" onchange="expView.saveRow(' + id + ')" class=".date_mask" id="expEnd' + id + '" maxlength="10" placeholder="дд.мм.гггг"></div><div style="margin-top: 20px;" class="custom-control formControl custom-checkbox mr-sm-2"><input ' + (data['checkExpNowDays'] == "true" ? 'checked' : '') + ' type="checkbox" class="custom-control-input" onchange="expView.saveRow(' + id + ')" id="checkExpNowDays' + id + '"><label class="custom-control-label" for="checkExpNowDays' + id + '">Работаю в данный момент</label></div></div><div class="col-12"><div class="formControl" style="max-width: 10000px;"><label for="expDuties' + id + '">Обязанности <span class="necessarly">*</span></label></label><textarea onchange="expView.saveRow(' + id + ')" id="expDuties' + id + '">' + data['expDuties'] + '</textarea></div></div></div><h5 class="backButton" style="padding: 0px; margin-top: 12px;" onclick="expView.removeRow(' + id + ')"><i class="fas fa-trash-alt" aria-hidden="true"></i> Удалить</h5></div>';
        this.expData.push(data);
        this.getRootView().append(htmlData);
        dateInputMask(document.querySelector('#expEnd' + id + ''));
        dateInputMask(document.querySelector('#expStart' + id + ''));
    }

    saveRow = function(id) {
        var expCompanyName = $('#expCompanyName' + id).val();
        var expSphere = $('#expSphere' + id).val();
        var expPosition = $('#expPosition' + id).val();
        var expCountry = $('#expCountry' + id).val();
        var expStart = $('#expStart' + id).val();
        var expEnd = $('#expEnd' + id).val();
        var expDuties = $('#expDuties' + id).val();
        var checkExpNowDays = document.querySelector("#checkExpNowDays" + id).checked;

        var newEdu = {
            "expCompanyName": expCompanyName,
            "expSphere": expSphere,
            "expPosition": expPosition,
            "expCountry": expCountry,
            "expStart": expStart,
            "expEnd": expEnd,
            "expDuties": expDuties,
            "checkExpNowDays": checkExpNowDays + ""
        };
        this.expData[id] = newEdu;
    }

    removeRow = function(id) {
        $('#expItem' + id).remove();
        this.expData[id]["expCompanyName"] = "";
    }

    getData = function() {
        var returnData = [];
        for (var i = 0; i < this.expData.length; i++) {
            if (this.validateData(this.expData[i])) {
                // console.log(this.expData[i]["value"] != "");
                // console.log(this.expData[i]["value"]);
                returnData.push(this.expData[i]);
            } else {
                // alert('Fill all fields')
            }
        }
        return returnData;
    }

    validateData = function(data) {
        if (data['expCompanyName'] != "") {
            return true;
        } else {
            return false;
        }
    }

}

AchievementsView = class AchievementsView {
    constructor(rootView, data) {
        this.rootView = rootView;
        data.forEach(element => {
            this.addRow(element);
        });
    }

    getRootView = function() {
        return $('#' + this.rootView);
    }

    achievementsData = [];

    addRow = function(data = {
        "achievementCountry": "",
        "achievementYear": "",
        "achievementAbout": ""
    }) {
        id = this.achievementsData.length;
        htmlData = '<div class="card" id="achievementItem' + id + '" style="padding: 15px; margin-top: 12px;"><div class="row"><div class="col-6"><div class="formControl" style="margin-top: 5px;"><label for="achievementCountry' + id + '">Страна <span class="">*</span></label><input value="' + data['achievementCountry'] + '" id="achievementCountry' + id + '" onchange="achievementView.saveData(' + id + ')" placeholder=""></div></div><div class="col-6"><div class="formControl" style="margin-top: 5px;"><label for="achievementYear' + id + '">Год <span class="necessarly">*</span></label><input value="' + data['achievementYear'] + '" id="achievementYear' + id + '" onchange="achievementView.saveData(' + id + ')" placeholder=""></div></div><div class="col-12"><div class="formControl" style="max-width: 10000px;"><label for="achievementAbout' + id + '">О мероприятии</label></label><textarea id="achievementAbout' + id + '" onchange="achievementView.saveData(' + id + ')">' + data['achievementAbout'] + '</textarea></div></div></div><h5 class="backButton" style="padding: 0px; margin-top: 12px;" onclick="achievementView.removeRow(' + id + ')"><i class="fas fa-trash-alt" aria-hidden="true"></i> Удалить</h5></div>';
        this.achievementsData.push(data);
        this.getRootView().append(htmlData);
    }

    saveData = function(id) {
        var achievementCountry = $('#achievementCountry' + id).val();
        var achievementYear = $('#achievementYear' + id).val();
        var achievementAbout = $('#achievementAbout' + id).val();

        var newRow = {
            'achievementCountry': achievementCountry,
            'achievementYear': achievementYear,
            'achievementAbout': achievementAbout
        }

        this.achievementsData[id] = newRow;
    }

    removeRow = function(id) {
        $('#achievementItem' + id).remove();
        this.achievementsData[id]["achievementCountry"] = "";
    }

    getData = function() {
        var returnData = [];
        for (var i = 0; i < this.achievementsData.length; i++) {
            if (this.validateData(i)) {
                returnData.push(this.achievementsData[i]);
            } else {
                // alert('Fill all fields')
            }
        }
        return returnData;
    }
    validateData = function(id) {
        if (this.achievementsData[id]['achievementCountry'] != '' && this.achievementsData[id]['achievementYear'] != '' && this.achievementsData[id]['achievementAbout'] != '') {
            $('.achievementItemError' + id).remove();
            return true;
        } else {
            $('#achievementItem' + id).append('<span class="alert alert-danger achievementItemError' + id + '">error</span>')
            return false;
        }
    }
}

DriverLicense = class DriverLicense {
    data = {
        'A': false,
        'B': false,
        'C': false,
        'D': false,
        'E': false
    }
    constructor(rootView, data) {
        console.log(data);
        this.rootView = rootView;
        for (const [key, value] of Object.entries(data)) {
            $('#driverLit' + key).prop("checked", value);
        }
        if (data.length != 0) {
            this.data = data;
        }
    }

    setData(key, value) {
        this.data[key] = value;
    }

    getData() {
        return this.data;
    }
}

Quize = class Quize {
    constructor(data) {
        this.data = data;
    }
}
