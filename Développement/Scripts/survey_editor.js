var i = 0;


$(".btn-add").on('click', function () {
    var string = "<div class=question-div>  <br>  <br>   <input name=question[] placeholder=\"Question\"> <select name=selectType[] class=selector>  <option value=\"short\">Réponse courte</option><option value=\"long\">Paragraphe</option><option value=\"multiple\">Choix multiple</option><option value=\"checkbox\">Case à cocher</option><option value=\"list\">Liste déroulante</option><option value=\"linear-scale\">Echelle linéaire</option><option value=\"grid-multiple\">Grille à choix multiple</option><option value=\"grid-checkbox\">Grille de case à cocher</option><option value=\"date\">Date</option><option value=\"hour\">Heure</option></select><button class=rm-div>X</button><br><div class=question-content><input name=\"short\" placeholder=\"Réponse courte\" READONLY>  <input type=hidden name=sub_questions[] value='new question'>  </div>  <input name=mustDo[] type=checkbox value= " + i + ">  <input placeholder=Obligatoire READONLY></div>";

    $(".form").append(string);
    $(".form").append("<input type=hidden name=sub_questions[] value='new question'>");
    i += 1;

});


$(document).on('click', '.add-choice', function () {
    var string = "<div><input name=sub_questions[] type=hidden value='radio'><input type=radio><input name=sub_questions[] placeholder=Option><button class=rm-div>X</button></div><button class=add-choice>Ajouter</button>";
    $(this).parent().append(string);
    $(this).remove();
});

$(document).on('click', '.add-check', function () {
    var string = "<div><input name=sub_questions[] type=hidden value='checkbox'><input type=checkbox><input name=sub_questions[] placeholder=Option><button class=rm-div>X</button></div><button class=add-check>Ajouter</button>";
    $(this).parent().append(string);
    $(this).remove();
});

$(document).on('click', '.add-list', function () {
    var string = "<div><input name=sub_questions[] type=hidden value='list'><input name=sub_questions[] placeholder=Option><button class=rm-div>X</button></div><button class=add-list>Ajouter</button>";
    $(this).parent().append(string);
    $(this).remove();
});

$(document).on('click', '.add-line', function () {
    var string = "<div><input name=sub_questions[] type=hidden value='line'><input name=sub_questions[] placeholder=Ligne><button class=rm-div>X</button></div><button class=add-line>Ajouter</button>";
    $(this).parent().append(string);
    $(this).remove();
});

$(document).on('click', '.add-column-multiple', function () {
    var string = "<div><input name=sub_questions[] type=hidden value='column-multiple'><input type=radio><input name=sub_questions[] placeholder=Colonne><button class=rm-div>X</button></div><button class=add-column-multiple>Ajouter</button>";
    $(this).parent().append(string);
    $(this).remove();
});

$(document).on('click', '.add-column-checkbox', function () {
    var string = "<div><input name=sub_questions[] type=hidden value='column-checkbox'><input type=checkbox><input name=sub_questions[] placeholder=Colonne><button class=rm-div>X</button></div><button class=add-column-checkbox>Ajouter</button>";
    $(this).parent().append(string);
    $(this).remove();
});

$(document).on('click', '.rm-div', function () {
    $(this).parent().remove();
});

$(document).on('change', 'select', function () {
    if ($(this).children('option:selected').val() == "short") {

        $(this).parent(".question-div").children(".question-content").html("<div><input placeholder='Réponse courte' READONLY></div>");
    }
    if ($(this).children('option:selected').val() == "long") {
        $(this).parent(".question-div").children(".question-content").html("<textarea placeholder='Réponse longue' READONLY></textarea>");

    }
    if ($(this).children('option:selected').val() == "multiple") {
        $(this).parent(".question-div").children(".question-content").html("<input name=sub_questions[] type=hidden value='radio'><input type=radio><input name=sub_questions[] placeholder=Option><br><button class=add-choice>Ajouter</button></div>");
    }
    if ($(this).children('option:selected').val() == "checkbox") {
        $(this).parent(".question-div").children(".question-content").html("<input name=sub_questions[] type=hidden value='checkbox'><input type=checkbox><input name=sub_questions[] placeholder=Option><br><button class=add-check>Ajouter</button></div>");
    }
    if ($(this).children('option:selected').val() == "list") {
        $(this).parent(".question-div").children(".question-content").html("<input name=sub_questions[] type=hidden value='list'><input name=sub_questions[] placeholder=Option><br><button class=add-list>Ajouter</button></div>");
    }
    if ($(this).children('option:selected').val() == "linear-scale") {
        $(this).parent(".question-div").children(".question-content").html("<input name=sub_questions[] type=hidden value='min-scale'><select name=sub_questions[] class=min-scale><option>0</option><option>1</option></select><input type=hidden name=sub_questions[] value=max-scale><select name=sub_questions[] class=max-scale><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option></select></div>");
    }
    if ($(this).children('option:selected').val() == "grid-multiple") {
        $(this).parent(".question-div").children(".question-content").html("<div class=line><input name=sub_questions[]  type=hidden value='line'><input name=sub_questions[] placeholder=Ligne><button class=add-line>Ajouter</button></div></div><div class=column><input name=sub_questions[] type=hidden value='column-multiple'><input type=radio><input name=sub_questions[] placeholder=Colonne><button class=add-column-multiple>Ajouter</button></div>");
    }
    if ($(this).children('option:selected').val() == "grid-checkbox") {
        $(this).parent(".question-div").children(".question-content").html("<div class=line><input name=sub_questions[]  type=hidden value='line'><input name=sub_questions[] placeholder=Ligne><button class=add-line>Ajouter</button></div></div><div class=column><input name=sub_questions[] type=hidden value='column-checkbox'><input type=checkbox><input name=sub_questions[] placeholder=Colonne><button class=add-column-checkbox>Ajouter</button></div>");
    }
    if ($(this).children('option:selected').val() == "date") {
        $(this).parent(".question-div").children(".question-content").html("<input placeholder=Date READONLY>");
    }
    if ($(this).children('option:selected').val() == "hour") {
        $(this).parent(".question-div").children(".question-content").html("<input placeholder=Heure READONLY>");
    }
});