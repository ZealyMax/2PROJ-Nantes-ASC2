var i = 0;


$(".btn-add").on('click', function () {
    var string = "\
    <div class=question-div draggable='true'>     \
        <input class=question-title name = question[] placeholder =\"Question\"> \
        <select class=select-choice name=selectType[]> \
            <option value=\"short\">Réponse courte</option>\
            <option value=\"long\">Paragraphe</option>\
            <option value=\"multiple\">Choix multiple</option>\
            <option value=\"checkbox\">Case à cocher</option>\
            <option value=\"list\">Liste déroulante</option>\
            <option value=\"linear-scale\">Echelle linéaire</option>\
            <option value=\"grid-multiple\">Grille à choix multiple</option>\
            <option value=\"grid-checkbox\">Grille de case à cocher</option>\
            <option value=\"date\">Date</option>\
            <option value=\"hour\">Heure</option>\
        </select>\
        <div class=question-content>\
            <input class=short-answer name=\"short\" placeholder=\"Réponse courte\" READONLY>    \
        </div>  <hr class=requiered-bar><div class=requiered-field><p>Obligatoire</p><input class=check-requiered name=mustDo[] type=checkbox value= " + i + "> <div class=vertical-bar>&nbsp;</div><div>&nbsp;</div><button class='rm-div rm-division'>X</button></div></div> \
        <input type=hidden name=sub_questions[] value='new question'>\
    </div>";

    $(".form").append(string);
    i += 1;
});


$(".btn-del").on('click', function () {
    /*RemoveSurvey(this.id);*/
    alert("A formulaire has been executed");
    window.location.href = "../Pages/home.php";
});


$(document).on('click', '.add-choice', function () {
    var string = "\
    <div>\
        <div class=multiple-choice><input name=sub_questions[] type=hidden value='radio'>\
        <input class=check-button type=radio disabled><input class=check-name name=sub_questions[] placeholder=Option><div><button class='rm-div rm-option'>X</button></div></div>\
    </div><button class=add-choice>Ajouter</button>";
    $(this).parent().append(string);
    $(this).remove();
});

$(document).on('click', '.add-check', function () {
    var string = "\
    <div>\
        <div class=multiple-choice><input name=sub_questions[] type=hidden value='checkbox'>\
        <input class=check-button type=checkbox disabled><input class=check-name name=sub_questions[] placeholder=Option><div><button class='rm-div rm-option'>X</button></div></div>\
    </div><button class=add-check>Ajouter</button>";
    $(this).parent().append(string);
    $(this).remove();
});

$(document).on('click', '.add-list', function () {
    var string = "\
    <div>\
        <div class=multiple-choice><input name=sub_questions[] type=hidden value='list'>\
        <input class='check-namelist margin-list' name=sub_questions[] placeholder=Option><div><button class='rm-div rm-option'>X</button></div></div>\
    </div><button class=add-list>Ajouter</button>";
    $(this).parent().append(string);
    $(this).remove();
});

$(document).on('click', '.add-line', function () {
    var string = "\
    <div>\
        <div class=multiple-choice><input name=sub_questions[] type=hidden value='line'>\
        <input class='check-namelist margin-list' name=sub_questions[] placeholder=Ligne><div><button class='rm-div rm-option'>X</button></div></div>\
    </div><button class=add-line>Ajouter</button>";
    $(this).parent().append(string);
    $(this).remove();
});

$(document).on('click', '.add-column-multiple', function () {
    var string = "\
    <div>\
        <div class=multiple-choice><input name=sub_questions[] type=hidden value='column-multiple'>\
        <input  class=check-button type=radio disabled><input class=check-name name=sub_questions[] placeholder=Colonne><div><button class='rm-div rm-option'>X</button></div></div>\
    </div><button class=add-column-multiple>Ajouter</button>";
    $(this).parent().append(string);
    $(this).remove();
});

$(document).on('click', '.add-column-checkbox', function () {
    var string = "\
    <div>\
        <div class=multiple-choice><input name=sub_questions[] type=hidden value='column-checkbox'>\
        <input  class=check-button type=checkbox disabled><input class=check-name name=sub_questions[] placeholder=Colonne><div><button class='rm-div rm-option'>X</button></div></div>\
    </div><button class=add-column-checkbox>Ajouter</button>";
    $(this).parent().append(string);
    $(this).remove();
});

$(document).on('click', '.rm-div', function () {
    $(this).parent().parent().remove();
});

$(document).on('change', '.select-choice', function () {
    if ($(this).children('option:selected').val() == "short") {
        $(this).parent(".question-div").children(".question-content").html("<input class=short-answer placeholder='Réponse courte' READONLY>");
    };
    if ($(this).children('option:selected').val() == "long") {
        $(this).parent(".question-div").children(".question-content").html("<textarea class=long-answer placeholder='Réponse longue' READONLY></textarea>");
    };
    if ($(this).children('option:selected').val() == "multiple") {
        $(this).parent(".question-div").children(".question-content").html("<input name=sub_questions[] type=hidden value='radio'>\
                                                                            <input class=check-button type=radio disabled><input class=check-name name=sub_questions[] placeholder=Option><br><button class=add-choice>Ajouter</button>");
    };
    if ($(this).children('option:selected').val() == "checkbox") {
        $(this).parent(".question-div").children(".question-content").html("<input name=sub_questions[] type=hidden value='checkbox'>\
                                                                            <input class=check-button type=checkbox disabled><input class=check-name name=sub_questions[] placeholder=Option><br><button class=add-check>Ajouter</button>");
    };
    if ($(this).children('option:selected').val() == "list") {
        $(this).parent(".question-div").children(".question-content").html("<input name=sub_questions[] type=hidden value='list'>\
                                                                            <input class='check-namelist margin-list' name=sub_questions[] placeholder=Option><br><button class=add-list>Ajouter</button>");
    };
    if ($(this).children('option:selected').val() == "linear-scale") {
        $(this).parent(".question-div").children(".question-content").html("<input name=sub_questions[] type=hidden value='min-scale'>\
                                                                            <input class=check-line name=sub_questions[] placeholder=Bas>\
                                                                            <select class=select-linear name=sub_questions[] class='min-scale select-linear'>\
                                                                                <option>0</option>\
                                                                                <option>1</option>\
                                                                            </select>\
                                                                            <input type=hidden name=sub_questions[] value=max-scale>\
                                                                            <input class=check-line name=sub_questions[] placeholder=Haut>\
                                                                            <select class=select-linear name=sub_questions[] class='max-scale select-linear'>\
                                                                                <option>2</option>\
                                                                                <option>3</option>\
                                                                                <option>4</option>\
                                                                                <option>5</option>\
                                                                                <option>6</option>\
                                                                                <option>7</option>\
                                                                                <option>8</option>\
                                                                                <option>9</option>\
                                                                                <option>10</option>\
                                                                            </select>");
    };
    if ($(this).children('option:selected').val() == "grid-multiple") {
        $(this).parent(".question-div").children(".question-content").html("<div class=line>\
                                                                                <input name=sub_questions[]  type=hidden value='line'>\
                                                                                <input class='check-namelist margin-list' name=sub_questions[] placeholder=Ligne><button class=add-line>Ajouter</button>\
                                                                            </div>\
                                                                            <div class=column>\
                                                                                <input name=sub_questions[] type=hidden value='column-multiple'>\
                                                                                <input class=check-button type=radio disabled><input class=check-name name=sub_questions[] placeholder=Colonne><button class=add-column-multiple>Ajouter</button>\
                                                                            </div>");
    };
    if ($(this).children('option:selected').val() == "grid-checkbox") {
        $(this).parent(".question-div").children(".question-content").html("<div class=line>\
                                                                                <input name=sub_questions[]  type=hidden value='line'>\
                                                                                <input class='check-namelist margin-list' name=sub_questions[] placeholder=Ligne><button class=add-line>Ajouter</button>\
                                                                            </div>\
                                                                            <div class=column>\
                                                                                <input name=sub_questions[] type=hidden value='column-checkbox'>\
                                                                                <input class=check-button type=checkbox disabled><input class=check-name name=sub_questions[] placeholder=Colonne><button class=add-column-checkbox>Ajouter</button>\
                                                                            </div>");
    };
    if ($(this).children('option:selected').val() == "date") {
        $(this).parent(".question-div").children(".question-content").html("<input class=short-answer placeholder=Date READONLY>");
    };
    if ($(this).children('option:selected').val() == "hour") {
        $(this).parent(".question-div").children(".question-content").html("<input class=short-answer placeholder=Heure READONLY>");
    };
});



