/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/js/dynamicforms.js ***!
  \**************************************/
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

ContactData = /*#__PURE__*/function () {
  function ContactData(rootView, _data) {
    var _this = this;

    _classCallCheck(this, ContactData);

    _defineProperty(this, "altContactData", []);

    _defineProperty(this, "addAltContactRow", function () {
      var data = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {
        'key': 'Почта',
        'value': ''
      };
      var no = this.altContactData.length;
      var htmlData = '<div class="row" id="' + this.rootView + 'Item' + no + '">' + '<div class="col-5"><div class="formControl" style="margin-top: 10px;">' + '<select onchange="contactData.saveAltContactRow(' + no + ')" id="altC_key' + no + '">' + '<option ' + (data['key'] == 'Почта' ? "selected" : '') + '>Почта</option><option ' + (data['key'] == 'Facebook' ? "selected" : '') + '>Facebook</option><option ' + (data['key'] == 'Instagram' ? "selected" : '') + '>Instagram</option><option ' + (data['key'] == 'IMO' ? "selected" : '') + '>IMO</option><option ' + (data['key'] == 'LinkedIn' ? "selected" : '') + '>Linkedin</option><option ' + (data['key'] == 'Telegram' ? "selected" : '') + '>Telegram</option><option ' + (data['key'] == 'Twitter' ? "selected" : '') + '>Twitter</option><option ' + (data['key'] == 'Viber' ? "selected" : '') + '>Viber</option><option ' + (data['key'] == 'VK' ? "selected" : '') + '>VK</option><option ' + (data['key'] == 'WhatsApp' ? "selected" : '') + '>WhatsApp</option></select></div></div><div class="col-6" style="padding-left: 0px; padding-right: 0px;"><div class="formControl" id="" style="margin-top: 10px;">' + '<input value="' + data['value'] + '" onchange="contactData.saveAltContactRow(' + no + ')" id="altC_val' + no + '"></div></div><div class="col-1">' + '<h5 class="backButton" onclick="contactData.removeAltContactsRow(' + no + ')">' + '<i class="fas fa-trash-alt" ></i></h5></div></div>';
      this.altContactData.push(data);
      this.getRootView().append(htmlData);
    });

    _defineProperty(this, "getAltContacts", function () {
      var returnData = [];

      for (var i = 0; i < this.altContactData.length; i++) {
        if (this.altContactData[i]["value"] != "empty" && this.altContactData[i]["value"] != "") {
          returnData.push(this.altContactData[i]);
        }
      }

      return returnData;
    });

    _defineProperty(this, "removeAltContactsRow", function (id) {
      $('#' + this.rootView + 'Item' + id).remove();
      this.altContactData[id]["value"] = "empty";
    });

    _defineProperty(this, "saveAltContactRow", function (id) {
      var key = $("#altC_key" + id + " option:selected").text(); // console.log(key);

      var val = $("#altC_val" + id).val(); // console.log(val);

      var newContact = {
        "key": key,
        "value": val
      };
      this.altContactData[id] = newContact;
    });

    this.rootView = rootView;

    _data.forEach(function (element) {
      _this.addAltContactRow(element);
    });
  }

  _createClass(ContactData, [{
    key: "getRootView",
    value: function getRootView() {
      return $("#" + this.rootView);
    }
  }]);

  return ContactData;
}();

SkillsView = /*#__PURE__*/function () {
  function SkillsView(rootView, input, button, data) {
    var _this2 = this;

    _classCallCheck(this, SkillsView);

    _defineProperty(this, "skillsList", []);

    _defineProperty(this, "removeSkill", function (id) {
      $("#skill" + id).remove();
      this.skillsList[id] = '';
    });

    _defineProperty(this, "addSkill", function () {
      var skill = this.input.val();

      if (skill != "") {
        var no = this.skillsList.length;
        this.input.val("");
        $("#" + this.rootView).append('<span class="skill" id="skill' + no + '"> <i class="far fa-check-circle"></i> ' + skill + ' <i class="fas fa-times" onclick="skillsView.removeSkill(' + no + ')" style="color: #FF5F5F; cursor: pointer;"></i> </span>');
        this.skillsList.push(skill);
      }
    });

    _defineProperty(this, "addSkill1", function (skill) {
      if (skill != "") {
        var no = this.skillsList.length;
        this.input.val("");
        $("#" + this.rootView).append('<span class="skill" id="skill' + no + '"> <i class="far fa-check-circle"></i> ' + skill + ' <i class="fas fa-times" onclick="skillsView.removeSkill(' + no + ')" style="color: #FF5F5F; cursor: pointer;"></i> </span>');
        this.skillsList.push(skill);
      }
    });

    _defineProperty(this, "getData", function () {
      var returnData = [];

      for (var i = 0; i < this.skillsList.length; i++) {
        if (this.skillsList[i] != "") {
          returnData.push(this.skillsList[i]);
        }
      }

      return returnData;
    });

    this.rootView = rootView;
    this.input = $("#" + input);
    this.button = $("#" + button);
    var addButton = $("#" + button);
    this.input.keyup(function (event) {
      if (event.keyCode === 13) {
        event.preventDefault();
        addButton.click();
      } else {// console.log(event.keyCode);
      }
    });
    this.button.on('click', function (e) {
      skillsView.addSkill();
    });
    data.forEach(function (element) {
      _this2.addSkill1(element);
    });
  }

  _createClass(SkillsView, [{
    key: "getRootView",
    value: function getRootView() {
      return $("#" + this.rootView);
    }
  }]);

  return SkillsView;
}();

LangsView = /*#__PURE__*/function () {
  function LangsView(rootView, addButton, _data2) {
    var _this3 = this;

    _classCallCheck(this, LangsView);

    _defineProperty(this, "langList", []);

    _defineProperty(this, "addAltLangRow", function () {
      var data = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {
        "key": "",
        "value": 0
      };
      var no = this.langList.length;
      var htmlData = '<div class="row" id="langItem' + no + '" style="margin-top: 8px;"><div class="col-5"><div class="formControl" style="margin-top: 5px;"><input value="' + data['key'] + '" onchange="langsView.setLangName(' + no + ')" id="langName' + no + '" placeholder=""></div></div><div class="col-6" style="padding-left: 0px;"><div class="formControl" style="margin-top: 5px;"><select onchange="langsView.setLangLevel(' + no + ')" id="langLevel' + no + '"><option value="0" ' + (data['value'] == '0' ? 'selected' : '') + '>Начальный</option><option value="1" ' + (data['value'] == '1' ? 'selected' : '') + '>Средний</option><option value="2" ' + (data['value'] == '2' ? 'selected' : '') + '>Хороший</option><option value="3" ' + (data['value'] == '3' ? 'selected' : '') + '>Свободное владение</option></select></div></div><div class="col-1" style="padding-left: 0px;"><h5 style="margin-top: 12px; text-align: right;" onclick="langsView.removelangRow(' + no + ')"><i class="fas fa-trash-alt" aria-hidden="true"></i></h5></div></div>';
      this.langList.push(data);
      this.getRootView().append(htmlData);
    });

    _defineProperty(this, "setLangLevel", function (id) {
      var level = $("#langLevel" + id).val();
      this.langList[id]["value"] = level;
    });

    _defineProperty(this, "setLangName", function (id) {
      var level = $("#langName" + id).val();
      this.langList[id]["key"] = level;
    });

    _defineProperty(this, "removelangRow", function (id) {
      $("#langItem" + id).remove();
      this.langList[id]['value'] = 'empty';
    });

    _defineProperty(this, "getLangs", function () {
      var returnData = [];

      for (var i = 0; i < this.langList.length; i++) {
        if (this.langList[i]["key"] != "empty" && this.langList[i]["key"] != "") {
          returnData.push(this.langList[i]);
        }
      }

      return returnData;
    });

    this.rootView = rootView;
    this.addButton = $('#' + addButton);
    this.addButton.on('click', function (e) {
      langsView.addAltLangRow();
    });
    isFirst = true;

    _data2.forEach(function (element) {
      if (isFirst) {
        $("#langName0").val(element['key']);
        $("#langLevel0").val();

        _this3.langList.push({
          "key": element['key'],
          "value": element['value']
        });

        isFirst = false;
      } else {
        _this3.addAltLangRow(element);
      }
    });
  }

  _createClass(LangsView, [{
    key: "getRootView",
    value: function getRootView() {
      return $('#' + this.rootView);
    }
  }]);

  return LangsView;
}();

EducationView = /*#__PURE__*/function () {
  function EducationView(rootView, _data3) {
    var _this4 = this;

    _classCallCheck(this, EducationView);

    _defineProperty(this, "educationData", []);

    _defineProperty(this, "addEduRow", function () {
      var data = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {
        "eduType": "",
        "eduName": "",
        "eduFaculty": "",
        "eduSpeciality": "",
        "eduStart": "",
        "eduEnd": "",
	      "practice": "",
        "checkEduNowDays": false
      };
      var id = this.educationData.length;
      var htmlData = '<div id="eduItem' + id + '" class="card" style="padding: 15px; margin-top: 12px;"><div class="row"><div class="col-md-12 col-lg-6"><div class="formControl" style="margin-top: 5px;"><label for="eduType' + id + '">Форма обучения <span class="necessarly">*</span></label><select onchange="eduView.saveEduRow(' + id + ')" id="eduType' + id + '"><option ' + (data["eduType"] == 'Очная' ? "selected" : "") + '>Очная</option><option ' + (data["eduType"] == 'Очно-заочное (вечерняя)' ? "selected" : "") + '>Очно-заочное (вечерняя)</option><option ' + (data["eduType"] == 'Заочная' ? "selected" : "") + '>Заочная</option><option ' + (data["eduType"] == 'Дистанционная' ? "selected" : "") + '>Дистанционная</option></select></div></div><div class="col-md-12 col-lg-6"><div class="formControl" style="margin-top: 5px;"><label for="eduName' + id + '">Учебное заведение <span class="necessarly">*</span></label><input value="' + data["eduName"] + '" onchange="eduView.saveEduRow(' + id + ')" id="eduName' + id + '" placeholder=""></div></div><div class="col-md-12 col-lg-6"><div class="formControl"><label for="eduFaculty' + id + '">Факультет</label><input value="' + data["eduFaculty"] + '" onchange="eduView.saveEduRow(' + id + ')" id="eduFaculty' + id + '" placeholder=""></div></div><div class="col-md-12 col-lg-6"><div class="formControl"><label for="eduSpeciality' + id + '">Специальность</label><input  value="' + data["eduSpeciality"] + '"onchange="eduView.saveEduRow(' + id + ')" id="eduSpeciality' + id + '" placeholder=""></div></div><div class="col-md-12 col-lg-6"><div class="formControl"><label for="eduStart' + id + '">Начало обучения <span class="necessarly">*</span></label><input value="' + data["eduStart"] + '" onchange="eduView.saveEduRow(' + id + ')" class=".date_mask" id="eduStart' + id + '" maxlength="10" placeholder="дд.мм.гггг"></div></div><div class="col-md-12 col-lg-6"><div class="formControl"><label for="eduEnd' + id + '">Окончание обучения <span class="necessarly">*</span></label><input value="' + data["eduEnd"] + '" onchange="eduView.saveEduRow(' + id + ')" class=".date_mask" id="eduEnd' + id + '" maxlength="10" placeholder="дд.мм.гггг"></div> <div style="margin-top: 20px;" class="custom-control formControl custom-checkbox mr-sm-2"><input ' + (data['checkEduNowDays'] == "true" ? "checked" : "") + ' type="checkbox" class="custom-control-input" onclick="eduView.saveEduRow(' + id + ')" id="checkEduNowDays' + id + '"><label class="custom-control-label" for="checkEduNowDays' + id + '">Учусь в данный момент</label></div></div> <div class="col-md-12">  <div class="formControl" style="margin-bottom: 24px;"> <label for="eduPractice' + id + '"> Производственная практика при прохождении обучения </label> <input value="'+data["eduPractice"]+'" onchange="eduView.saveEduRow('+id+')" id="eduPractice'+id+'"></div>  </div>  </div><h5 class="backButton" style="padding: 0px;" onclick="eduView.removeEduRow(' + id + ')"><i class="fas fa-trash-alt" aria-hidden="true"></i> Удалить</h5></div>';
      this.educationData.push(data);
      this.getRootView().append(htmlData);
      dateInputMask(document.querySelector('#eduEnd' + id + ''));
      dateInputMask(document.querySelector('#eduStart' + id + ''));
    });

    _defineProperty(this, "getData", function () {
      var returnData = [];

      for (var i = 0; i < this.educationData.length; i++) {
        if (this.validateData(this.educationData[i])) {
          returnData.push(this.educationData[i]);
        } else {
          showAlert("Заполните все поля!");
        }
      }

      return returnData;
    });

    _defineProperty(this, "removeEduRow", function (id) {
      $('#eduItem' + id).remove();
      this.educationData[id]["value"] = "empty";
    });

    _defineProperty(this, "saveEduRow", function (id) {
      var eduType = $('#eduType' + id + ' option:selected').text();
      var eduName = $('#eduName' + id).val();
      var eduFaculty = $('#eduFaculty' + id).val();
      var eduSpeciality = $('#eduSpeciality' + id).val();
      var eduStart = $('#eduStart' + id).val();
      var eduEnd = $('#eduEnd' + id).val();
	    var eduPractice = $("#eduPractice"+id).val();
      var checkEduNowDays = document.querySelector("#checkEduNowDays" + id).checked;
      var newEdu = {
        "eduType": eduType,
        "eduName": eduName,
        "eduFaculty": eduFaculty,
        "eduSpeciality": eduSpeciality,
        "eduStart": eduStart,
        "eduEnd": eduEnd,
	      "eduPractice": eduPractice,
        "checkEduNowDays": checkEduNowDays + ""
      };
      this.educationData[id] = newEdu;
    });

    _defineProperty(this, "validateData", function (data) {
      if (data['eduName'] != "") {
        return true;
      } else {
        return false;
      }
    });

    this.rootView = rootView;

    _data3.forEach(function (element) {
      _this4.addEduRow(element);
    });
  }

  _createClass(EducationView, [{
    key: "getRootView",
    value: function getRootView() {
      return $('#' + this.rootView);
    }
  }]);

  return EducationView;
}();

ExpView = /*#__PURE__*/_createClass(function ExpView(rootView, _data4) {
  var _this5 = this;

  _classCallCheck(this, ExpView);

  _defineProperty(this, "expData", []);

  _defineProperty(this, "getRootView", function () {
    return $('#' + this.rootView);
  });

  _defineProperty(this, "addExpRow", function () {
    var data = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {
      "expCompanyname": "",
      "expSphere": "",
      "expPosition": "",
      "expCountry": "",
      "expStart": "",
      "expEnd": "",
      "expDuties": "",
      "checkExpNowDays": false
    };
    var id = this.expData.length;
    var htmlData = '<div class="card" id="expItem' + id + '" style="padding: 15px; margin-top: 12px;"><div class="row"><div class="col-md-12 col-lg-6"><div class="formControl" style="margin-top: 5px;"><label for="expCompanyName' + id + '">Компания <span class="necessarly">*</span></label><input value="' + data["expCompanyName"] + '" onchange="expView.saveRow(' + id + ')" id="expCompanyName' + id + '" placeholder=""></div></div><div class="col-md-12 col-lg-6"><div class="formControl" style="margin-top: 5px;"><label for="expSphere' + id + '">Сфера <span class="necessarly">*</span></label><input value="' + data["expSphere"] + '" onchange="expView.saveRow(' + id + ')" id="expSphere' + id + '" placeholder=""></div></div><div class="col-md-12 col-lg-6"><div class="formControl"><label for="expPosition' + id + '">Должность <span class="necessarly">*</span></label><input value="' + data["expPosition"] + '" id="expPosition' + id + '" onchange="expView.saveRow(' + id + ')" placeholder=""></div></div><div class="col-md-12 col-lg-6"><div class="formControl"><label for="expCountry' + id + '">Страна, город <span class="necessarly">*</span></label><input value="' + data["expCountry"] + '" onchange="expView.saveRow(' + id + ')" id="expCountry' + id + '" placeholder=""></div></div><div class="col-md-12 col-lg-6"><div class="formControl"><label for="expStart' + id + '">Начало работы <span class="necessarly">*</span></label><input value="' + data["expStart"] + '" onchange="expView.saveRow(' + id + ')" class=".date_mask" id="expStart' + id + '" maxlength="10" placeholder="дд.мм.гггг"></div></div><div class="col-md-12 col-lg-6"><div class="formControl"><label for="expEnd' + id + '">Окончание работы <span class="necessarly">*</span></label><input value="' + data['expEnd'] + '" onchange="expView.saveRow(' + id + ')" class=".date_mask" id="expEnd' + id + '" maxlength="10" placeholder="дд.мм.гггг"></div><div style="margin-top: 20px;" class="custom-control formControl custom-checkbox mr-sm-2"><input ' + (data['checkExpNowDays'] == "true" ? 'checked' : '') + ' type="checkbox" class="custom-control-input" onchange="expView.saveRow(' + id + ')" id="checkExpNowDays' + id + '"><label class="custom-control-label" for="checkExpNowDays' + id + '">Работаю в данный момент</label></div></div><div class="col-12"><div class="formControl" style="max-width: 10000px;"><label for="expDuties' + id + '">Обязанности <span class="necessarly">*</span></label></label><textarea onchange="expView.saveRow(' + id + ')" id="expDuties' + id + '">' + data['expDuties'] + '</textarea></div></div></div><h5 class="backButton" style="padding: 0px; margin-top: 12px;" onclick="expView.removeRow(' + id + ')"><i class="fas fa-trash-alt" aria-hidden="true"></i> Удалить</h5></div>';
    this.expData.push(data);
    this.getRootView().append(htmlData);
    dateInputMask(document.querySelector('#expEnd' + id + ''));
    dateInputMask(document.querySelector('#expStart' + id + ''));
  });

  _defineProperty(this, "saveRow", function (id) {
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
  });

  _defineProperty(this, "removeRow", function (id) {
    $('#expItem' + id).remove();
    this.expData[id]["expCompanyName"] = "";
  });

  _defineProperty(this, "getData", function () {
    var returnData = [];

    for (var i = 0; i < this.expData.length; i++) {
      if (this.validateData(this.expData[i])) {
        // console.log(this.expData[i]["value"] != "");
        // console.log(this.expData[i]["value"]);
        returnData.push(this.expData[i]);
      } else {// alert('Fill all fields')
      }
    }

    return returnData;
  });

  _defineProperty(this, "validateData", function (data) {
    if (data['expCompanyName'] != "") {
      return true;
    } else {
      return false;
    }
  });

  this.rootView = rootView;

  _data4.forEach(function (element) {
    _this5.addExpRow(element);
  });
});
AchievementsView = /*#__PURE__*/_createClass(function AchievementsView(rootView, _data5) {
  var _this6 = this;

  _classCallCheck(this, AchievementsView);

  _defineProperty(this, "getRootView", function () {
    return $('#' + this.rootView);
  });

  _defineProperty(this, "achievementsData", []);

  _defineProperty(this, "addRow", function () {
    var data = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {
      "achievementCountry": "",
      "achievementYear": "",
      "achievementAbout": ""
    };
    id = this.achievementsData.length;
    htmlData = '<div class="card" id="achievementItem' + id + '" style="padding: 15px; margin-top: 12px;"><div class="row"><div class="col-6"><div class="formControl" style="margin-top: 5px;"><label for="achievementCountry' + id + '">Страна <span class="">*</span></label><input value="' + data['achievementCountry'] + '" id="achievementCountry' + id + '" onchange="achievementView.saveData(' + id + ')" placeholder=""></div></div><div class="col-6"><div class="formControl" style="margin-top: 5px;"><label for="achievementYear' + id + '">Год <span class="necessarly">*</span></label><input value="' + data['achievementYear'] + '" id="achievementYear' + id + '" onchange="achievementView.saveData(' + id + ')" placeholder=""></div></div><div class="col-12"><div class="formControl" style="max-width: 10000px;"><label for="achievementAbout' + id + '">О мероприятии</label></label><textarea id="achievementAbout' + id + '" onchange="achievementView.saveData(' + id + ')">' + data['achievementAbout'] + '</textarea></div></div></div><h5 class="backButton" style="padding: 0px; margin-top: 12px;" onclick="achievementView.removeRow(' + id + ')"><i class="fas fa-trash-alt" aria-hidden="true"></i> Удалить</h5></div>';
    this.achievementsData.push(data);
    this.getRootView().append(htmlData);
  });

  _defineProperty(this, "saveData", function (id) {
    var achievementCountry = $('#achievementCountry' + id).val();
    var achievementYear = $('#achievementYear' + id).val();
    var achievementAbout = $('#achievementAbout' + id).val();
    var newRow = {
      'achievementCountry': achievementCountry,
      'achievementYear': achievementYear,
      'achievementAbout': achievementAbout
    };
    this.achievementsData[id] = newRow;
  });

  _defineProperty(this, "removeRow", function (id) {
    $('#achievementItem' + id).remove();
    this.achievementsData[id]["achievementCountry"] = "";
  });

  _defineProperty(this, "getData", function () {
    var returnData = [];

    for (var i = 0; i < this.achievementsData.length; i++) {
      if (this.validateData(i)) {
        returnData.push(this.achievementsData[i]);
      } else {// alert('Fill all fields')
      }
    }

    return returnData;
  });

  _defineProperty(this, "validateData", function (id) {
    if (this.achievementsData[id]['achievementCountry'] != '' && this.achievementsData[id]['achievementYear'] != '' && this.achievementsData[id]['achievementAbout'] != '') {
      $('.achievementItemError' + id).remove();
      return true;
    } else {
      $('#achievementItem' + id).append('<span class="alert alert-danger achievementItemError' + id + '">error</span>');
      return false;
    }
  });

  this.rootView = rootView;

  _data5.forEach(function (element) {
    _this6.addRow(element);
  });
});

DriverLicense = /*#__PURE__*/function () {
  function DriverLicense(rootView, data) {
    _classCallCheck(this, DriverLicense);

    _defineProperty(this, "data", {
      'A': false,
      'B': false,
      'C': false,
      'D': false,
      'E': false
    });

    console.log(data);
    this.rootView = rootView;

    for (var _i = 0, _Object$entries = Object.entries(data); _i < _Object$entries.length; _i++) {
      var _Object$entries$_i = _slicedToArray(_Object$entries[_i], 2),
          key = _Object$entries$_i[0],
          value = _Object$entries$_i[1];

      $('#driverLit' + key).prop("checked", value);
    }

    if (data.length != 0) {
      this.data = data;
    }
  }

  _createClass(DriverLicense, [{
    key: "setData",
    value: function setData(key, value) {
      this.data[key] = value;
    }
  }, {
    key: "getData",
    value: function getData() {
      return this.data;
    }
  }]);

  return DriverLicense;
}();

Quize = /*#__PURE__*/_createClass(function Quize(data) {
  _classCallCheck(this, Quize);

  this.data = data;
});
/******/ })()
;
