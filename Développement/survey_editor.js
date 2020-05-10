$(".btn-add").on('click', function(){
  $('.question-div:first').css("display","unset").clone().appendTo($('.form'));
  $('.question-div:first').css("display","none")
});


$(document).on('click', '.add-choice',function(){
    var string = "<div><input type=radio><input name=multiple[] placeholder=Option><button class=rm-div>X</button></div><button class=add-choice>Ajouter</button>";
  $(this).parent().append(string);
  $(this).remove();
} );

$(document).on('click', '.add-check',function(){
    var string = "<div><input type=checkbox><input name=checkbox[] placeholder=Option><button class=rm-div>X</button></div><button class=add-check>Ajouter</button>";
  $(this).parent().append(string);
  $(this).remove();
} );

$(document).on('click', '.add-list', function () {
    var string = "<div><input name=list[] placeholder=Option><button class=rm-div>X</button></div><button class=add-list>Ajouter</button>";
    $(this).parent().append(string);
    $(this).remove();
});

$(document).on('click', '.add-line', function () {
    var string = "<div><input placeholder=Ligne><button class=rm-div>X</button></div><button class=add-line-multiple>Ajouter</button>";
    $(this).parent().append(string);
    $(this).remove();
});

$(document).on('click', '.add-column-multiple', function () {
    var string = "<div><input type=radio><input placeholder=Colonne><button class=rm-div>X</button></div><button class=add-column-multiple>Ajouter</button>";
    $(this).parent().append(string);
    $(this).remove();
});

$(document).on('click', '.add-column-checkbox', function () {
    var string = "<div><input type=checkbox><input placeholder=Colonne><button class=rm-div>X</button></div><button class=add-column-multiple>Ajouter</button>";
    $(this).parent().append(string);
    $(this).remove();
});

$(document).on('click', '.rm-div', function () {
    $(this).parent().remove();
});

$(document).on('change', 'select', function () {
    if ($(this).children('option:selected').val() == "short") {
        $(this).parent(".question-div").children(".question-content").html("<div name=short-div ><input name=short[] placeholder='Réponse courte' READONLY></div>");
    }
    if ($(this).children('option:selected').val() == "long") {
        $(this).parent(".question-div").children(".question-content").html("<textarea name=long[] placeholder='Réponse longue' READONLY></textarea>");
    }
    if ($(this).children('option:selected').val() == "multiple") {
        $(this).parent(".question-div").children(".question-content").html("<input type=radio><input name=multiple[] placeholder=Option><br><button class=add-choice>Ajouter</button></div>");
    }
    if ($(this).children('option:selected').val() == "checkbox") {
        $(this).parent(".question-div").children(".question-content").html("<input name=checkbox[] type=checkbox><input placeholder=Option><br><button class=add-check>Ajouter</button></div>");
    }
    if ($(this).children('option:selected').val() == "list") {
        $(this).parent(".question-div").children(".question-content").html("<input name=list[] placeholder=Option><br><button class=add-list>Ajouter</button></div>");
    }
    if ($(this).children('option:selected').val() == "linear-scale") {
        $(this).parent(".question-div").children(".question-content").html("<select name=linear-scale[] class=min-scale><option>0</option><option>1</option></select><select class=max-scale><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option></select></div>");
    }
    if ($(this).children('option:selected').val() == "grid-multiple") {
        $(this).parent(".question-div").children(".question-content").html("<div class=line><input placeholder=Ligne><button class=add-line>Ajouter</button></div><div class=column><input type=radio><input placeholder=Colonne><button class=add-column-multiple>Ajouter</button></div>");
    }
    if ($(this).children('option:selected').val() == "grid-checkbox") {
        $(this).parent(".question-div").children(".question-content").html("<div class=line><input placeholder=Ligne><button class=add-line>Ajouter</button></div><div class=column><input type=checkbox><input placeholder=Colonne><button class=add-column-checkbox>Ajouter</button></div>");
    }
    if ($(this).children('option:selected').val() == "date") {
        $(this).parent(".question-div").children(".question-content").html("<input name=date[] placeholder=Date READONLY>");
    }
    if ($(this).children('option:selected').val() == "hour") {
        $(this).parent(".question-div") .children(".question-content").html("<input name=hour[] placeholder=Heure READONLY>");
    }
});