window.onscroll = function() {
    $(".paralax").css("opacity", window.scrollY / 1000)
};

var universities = {
    'sk': [
        'uploads/universities/ncfu.png',
        'uploads/universities/agrar.jpeg',
        'uploads/universities/pgu.png',
        'uploads/universities/kgti.png'
    ],
    'dagestan': [
        'uploads/universities/narxoz.png',
        'uploads/universities/dgau.png',
        'uploads/universities/dgu.png',
        'uploads/universities/dgtu.png'
    ],
    'kchr': [
        'uploads/universities/skga.png',
        'uploads/universities/kchgu.png'
    ],
    'chechnya': [
        'uploads/universities/chgpu.png',
        'uploads/universities/ggnt.png',
        'uploads/universities/chgu.png'
    ],
    'ingushetiya': [
        'uploads/universities/igu.png'
    ],
    'rso': [
        'uploads/universities/sogu.png'
    ],
    'kbr': [
        'uploads/universities/kbgau.png',
	'uploads/universities/kbgu.png',
        'uploads/universities/skgii.png'
    ],
};

showInfo = function(region, cv_count, r_count, parent_class) {
    $("#title").html(region)
    $("#cv_count").html(cv_count)
    $("#r_count").html(r_count)
    var univer_list = "";

    universities[parent_class].forEach((element) => {
        univer_list += '<img src="' + element + '" class="univer_item" style="height: 50px; width: 50px;"></img>';
    });
    $('#universities_list').html(univer_list);

    console.log(parent_class);

    var e = window.event;
    clearTimeout(displayTimer);
    $("#stat_info").css("display", "block")
    $("#stat_info").css("opacity", "1")
    $("#" + parent_class).css("opacity", ".5")
    $("#" + parent_class).css("transition", ".5s")

    // $("#stat_info").css("top", (e.clientY + 15) + "px")
    // $("#stat_info").css("left", (e.clientX + 15) + "px")
}
var displayTimer;
hideInfo = function(parent_class) {
    $("#" + parent_class).css("opacity", "1")
    $("#" + parent_class).css("transition", ".5s")
    $("#stat_info").css("opacity", "0")
    displayTimer = setTimeout(function() {
        $("#stat_info").css("display", "none")
    }, 500)
}
getVacancies = function() {
    clearTabContent();
    addTabContent("<div class=\"row\" style=\"margin-top: 18px;\"> 		<div class=\"col-12\"> 			<div class=\"card\"> 				<div class=\"card-body\"> 					<div class=\"row\"> 						<div class=\"col-2\"> 							<img src=\"https://image.winudf.com/v2/image1/Y29tLm15dW5pdGVsLmFjdGl2aXRpZXNfaWNvbl8xNTUyNDA3OTA3XzA2OQ/icon.png?w=&fakeurl=1\" class=\"item_image round_rect\"> 						</div> 						<div class=\"col-10\"> 							<div class=\"item_title\">Электромонтер по ремонту и обслуживанию электрооборудования</div> 							<div class=\"item_date\">21 окт. 2020</div> 							<div class=\"item_description\">- Ведение нескольких участков бухгалтерского учета. <br>- Анализ. <br>- Работа с первичной документацией.</div> 							<div class=\"row bottom_data\"> 								<div class=\"col-4\"> 									<i class=\"far fa-building\"></i> СКФУ 								</div> 								<div class=\"col-4\"> 									<i class=\"fas fa-map-marker\"></i> Ставрополь 								</div> 								<div class=\"col-4\"> 									<i class=\"fas fa-money-bill-wave\"></i> 15 000 ₽ - 25 000₽ 								</div> 							</div> 						</div> 					</div> 			  	</div> 			</div> 		</div> 	</div>")
    addTabContent("<div class=\"row\" style=\"margin-top: 18px;\"> 		<div class=\"col-12\"> 			<div class=\"card\"> 				<div class=\"card-body\"> 					<div class=\"row\"> 						<div class=\"col-2\"> 							<img src=\"https://image.winudf.com/v2/image1/Y29tLm15dW5pdGVsLmFjdGl2aXRpZXNfaWNvbl8xNTUyNDA3OTA3XzA2OQ/icon.png?w=&fakeurl=1\" class=\"item_image round_rect\"> 						</div> 						<div class=\"col-10\"> 							<div class=\"item_title\">Электромонтер по ремонту и обслуживанию электрооборудования</div> 							<div class=\"item_date\">21 окт. 2020</div> 							<div class=\"item_description\">- Ведение нескольких участков бухгалтерского учета. <br>- Анализ. <br>- Работа с первичной документацией.</div> 							<div class=\"row bottom_data\"> 								<div class=\"col-4\"> 									<i class=\"far fa-building\"></i> СКФУ 								</div> 								<div class=\"col-4\"> 									<i class=\"fas fa-map-marker\"></i> Ставрополь 								</div> 								<div class=\"col-4\"> 									<i class=\"fas fa-money-bill-wave\"></i> 15 000 ₽ - 25 000₽ 								</div> 							</div> 						</div> 					</div> 			  	</div> 			</div> 		</div> 	</div>")
    addTabContent("<div class=\"row\" style=\"margin-top: 18px;\"> 		<div class=\"col-12\"> 			<div class=\"card\"> 				<div class=\"card-body\"> 					<div class=\"row\"> 						<div class=\"col-2\"> 							<img src=\"https://image.winudf.com/v2/image1/Y29tLm15dW5pdGVsLmFjdGl2aXRpZXNfaWNvbl8xNTUyNDA3OTA3XzA2OQ/icon.png?w=&fakeurl=1\" class=\"item_image round_rect\"> 						</div> 						<div class=\"col-10\"> 							<div class=\"item_title\">Электромонтер по ремонту и обслуживанию электрооборудования</div> 							<div class=\"item_date\">21 окт. 2020</div> 							<div class=\"item_description\">- Ведение нескольких участков бухгалтерского учета. <br>- Анализ. <br>- Работа с первичной документацией.</div> 							<div class=\"row bottom_data\"> 								<div class=\"col-4\"> 									<i class=\"far fa-building\"></i> СКФУ 								</div> 								<div class=\"col-4\"> 									<i class=\"fas fa-map-marker\"></i> Ставрополь 								</div> 								<div class=\"col-4\"> 									<i class=\"fas fa-money-bill-wave\"></i> 15 000 ₽ - 25 000₽ 								</div> 							</div> 						</div> 					</div> 			  	</div> 			</div> 		</div> 	</div>")
}

document.addEventListener('scroll', function(e) {
    yPos = -(window.scrollY / 2);
    $(".paralaxParent").css("top", yPos + "px")
});
getCVs = function() {
    clearTabContent();
    addTabContent(" 	<div class=\"row\" style=\"margin-top: 18px;\"> 		<div class=\"col-lg-6\" style=\"margin-top: 18px;\"> 			<div class=\"card pointer_cursor\"> 				<div class=\"card-body\"> 					<div class=\"row\"> 						<div class=\"col-4\"> 							<img src=\"https://www.eaclinic.co.uk/wp-content/uploads/2019/01/woman-face-eyes-1000x1000.jpg\" class=\"item_image circle\"> 						</div> 						<div class=\"col-8\"> 							<div class=\"item_title\">HR менеджер</div> 							<div class=\"item_date\">25 лет</div> 							<div class=\"item_description\"> 								- Опыт работы: 6 лет<br> 								- Город: Ставрополь<br> 								- Курс: 4 курс(выпускник)<br> 								- Направление подготовки: Информационные мимтемы и технологии<br> 							</div> 						</div> 					</div> 			  	</div> 			</div> 		</div> 		<div class=\"col-lg-6\" style=\"margin-top: 18px;\"> 			<div class=\"card pointer_cursor\"> 				<div class=\"card-body\"> 					<div class=\"row\"> 						<div class=\"col-4\"> 							<img src=\"https://www.eaclinic.co.uk/wp-content/uploads/2019/01/woman-face-eyes-1000x1000.jpg\" class=\"item_image circle\"> 						</div> 						<div class=\"col-8\"> 							<div class=\"item_title\">HR менеджер</div> 							<div class=\"item_date\">25 лет</div> 							<div class=\"item_description\"> 								- Опыт работы: 6 лет<br> 								- Город: Ставрополь<br> 								- Курс: 4 курс(выпускник)<br> 								- Направление подготовки: Информационные мимтемы и технологии<br> 							</div> 						</div> 					</div> 			  	</div> 			</div> 		</div> 	</div>");
    addTabContent(" 	<div class=\"row\" style=\"margin-top: 18px;\"> 		<div class=\"col-lg-6\" style=\"margin-top: 18px;\"> 			<div class=\"card pointer_cursor\"> 				<div class=\"card-body\"> 					<div class=\"row\"> 						<div class=\"col-4\"> 							<img src=\"https://www.eaclinic.co.uk/wp-content/uploads/2019/01/woman-face-eyes-1000x1000.jpg\" class=\"item_image circle\"> 						</div> 						<div class=\"col-8\"> 							<div class=\"item_title\">HR менеджер</div> 							<div class=\"item_date\">25 лет</div> 							<div class=\"item_description\"> 								- Опыт работы: 6 лет<br> 								- Город: Ставрополь<br> 								- Курс: 4 курс(выпускник)<br> 								- Направление подготовки: Информационные мимтемы и технологии<br> 							</div> 						</div> 					</div> 			  	</div> 			</div> 		</div> 		<div class=\"col-lg-6\" style=\"margin-top: 18px;\"> 			<div class=\"card pointer_cursor\"> 				<div class=\"card-body\"> 					<div class=\"row\"> 						<div class=\"col-4\"> 							<img src=\"https://www.eaclinic.co.uk/wp-content/uploads/2019/01/woman-face-eyes-1000x1000.jpg\" class=\"item_image circle\"> 						</div> 						<div class=\"col-8\"> 							<div class=\"item_title\">HR менеджер</div> 							<div class=\"item_date\">25 лет</div> 							<div class=\"item_description\"> 								- Опыт работы: 6 лет<br> 								- Город: Ставрополь<br> 								- Курс: 4 курс(выпускник)<br> 								- Направление подготовки: Информационные мимтемы и технологии<br> 							</div> 						</div> 					</div> 			  	</div> 			</div> 		</div> 	</div>");
}

// switchTab("tab_1");

function dateInputMask(elm) {
    elm.addEventListener('keypress', function(e) {
        if (e.keyCode < 47 || e.keyCode > 57) {
            e.preventDefault();
        }

        var len = elm.value.length;

        // If we're at a particular place, let the user type the slash
        // i.e., 12/12/1212
        if (len !== 1 || len !== 3) {
            if (e.keyCode == 47) {
                e.preventDefault();
            }
        }

        // If they don't add the slash, do it for them...
        if (len === 2) {
            elm.value += '.';
        }

        // If they don't add the slash, do it for them...
        if (len === 5) {
            elm.value += '.';
        }
    });
};

function phoneInputMask(elm) {
    elm.addEventListener('keypress', function(e) {
        if (e.keyCode < 47 || e.keyCode > 57) {
            e.preventDefault();
        }
        if (!elm.value.includes("+")) {
            elm.value = "+" + elm.value;
        }
    });
};
