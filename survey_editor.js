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

$("body").on('click', '.add-list',function(){
  var string = "<div><input placeholder=Option><button class=rm-div>X</button></div><button class=add-list>Ajouter</button>"
  $(this).parent().append(string);
  $(this).remove();
} );

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
})
