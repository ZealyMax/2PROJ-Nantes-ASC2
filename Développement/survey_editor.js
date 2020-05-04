$(".btn-add").on('click', function(){
  $('.question:first').css("display","unset").clone().appendTo($('.form'));
  $('.question:first').css("display","none")
});


$("body").on('click', '.add-choice',function(){
  var string = "<div><input type=radio><input placeholder=Option><button class=rm-div>X</button></div><button class=add-choice>Ajouter</button>"
  $(this).parent().append(string);
  $(this).remove();
} );

$("body").on('click', '.add-check',function(){
  var string = "<div><input type=checkbox><input placeholder=Option><button class=rm-div>X</button></div><button class=add-check>Ajouter</button>"
  $(this).parent().append(string);
  $(this).remove();
} );

$("body").on('click', '.add-list', function () {
    var string = "<div><input placeholder=Option><button class=rm-div>X</button></div><button class=add-list>Ajouter</button>"
    $(this).parent().append(string);
    $(this).remove();
});

$("body").on('click', '.add-line', function () {
    var string = "<div><input placeholder=Ligne><button class=rm-div>X</button></div><button class=add-line>Ajouter</button>"
    $(this).parent().append(string);
    $(this).remove();
});

$("body").on('click', '.add-column', function () {
    var string = "<div><input placeholder=Colonne><button class=rm-div>X</button></div><button class=add-column>Ajouter</button>"
    $(this).parent().append(string);
    $(this).remove();
});

$("body").on('click','.rm-div', function(){
  $(this).parent().remove();
})

$("body").on('click', 'option', function(){
  if($(this).val() == "short"){
    $(this).parent().parent(".question").children(".question-content").html("<input placeholder=Réponse courte>");
  }
  if($(this).val() == "long"){
    $(this).parent().parent(".question").children(".question-content").html("<textarea placeholder=Réponse longue></textarea>");
  }
  if($(this).val() == "multiple"){
    $(this).parent().parent(".question").children(".question-content").html("<input type=radio><input placeholder=Option><br><button class=add-choice>Ajouter</button></div>");
  }
  if($(this).val() == "checkbox"){
    $(this).parent().parent(".question").children(".question-content").html("<input type=checkbox><input placeholder=Option><br><button class=add-check>Ajouter</button></div>");
  }
  if($(this).val() == "list"){
    $(this).parent().parent(".question").children(".question-content").html("<input placeholder=Option><br><button class=add-list>Ajouter</button></div>");
    }
    if ($(this).val() == "linear-scale") {
        $(this).parent().parent(".question").children(".question-content").html("<select class=min-scale><option>0</option><option>1</option></select><select class=max-scale><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option></select></div>");
    }
    if ($(this).val() == "grid-multiple") {
        $(this).parent().parent(".question").children(".question-content").html("<div class=column><input placeholder=Ligne><button class=add-line>Ajouter</button></div><div class=line><input placeholder=Colonne><button class=add-column>Ajouter</button></div>");
    }

})
