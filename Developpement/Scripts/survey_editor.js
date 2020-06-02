var i = 0;
var dragSrcEl = null;


$(".btn-add").on('click', function () {
    var string = "\
    <div class=question-div draggable='true'>     \
        <input name = question[] placeholder =\"Question\"> \
        <select name=selectType[] class=selector> \
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
        </select><button class=rm-div>X</button>\
        <div class=question-content>\
            <input name=\"short\" placeholder=\"Réponse courte\" READONLY>    \
        </div>  <input name=mustDo[] type=checkbox value= " + i + ">  <input placeholder=Obligatoire READONLY> \
        <input type=hidden name=sub_questions[] value='new question'>\
    </div>";

    $(".form").append(string);
    i += 1;

});


$(document).on('click', '.add-choice', function () {
    var string = "\
    <div>\
        <input name=sub_questions[] type=hidden value='radio'>\
        <input type=radio disabled><input name=sub_questions[] placeholder=Option><button class=rm-div>X</button>\
    </div><button class=add-choice>Ajouter</button>";
    $(this).parent().append(string);
    $(this).remove();
});

$(document).on('click', '.add-check', function () {
    var string = "\
    <div>\
        <input name=sub_questions[] type=hidden value='checkbox'>\
        <input type=checkbox disabled><input name=sub_questions[] placeholder=Option><button class=rm-div>X</button>\
    </div><button class=add-check>Ajouter</button>";
    $(this).parent().append(string);
    $(this).remove();
});

$(document).on('click', '.add-list', function () {
    var string = "\
    <div>\
        <input name=sub_questions[] type=hidden value='list'>\
        <input name=sub_questions[] placeholder=Option><button class=rm-div>X</button>\
    </div><button class=add-list>Ajouter</button>";
    $(this).parent().append(string);
    $(this).remove();
});

$(document).on('click', '.add-line', function () {
    var string = "\
    <div>\
        <input name=sub_questions[] type=hidden value='line'>\
        <input name=sub_questions[] placeholder=Ligne><button class=rm-div>X</button>\
    </div><button class=add-line>Ajouter</button>";
    $(this).parent().append(string);
    $(this).remove();
});

$(document).on('click', '.add-column-multiple', function () {
    var string = "\
    <div>\
        <input name=sub_questions[] type=hidden value='column-multiple'>\
        <input type=radio disabled><input name=sub_questions[] placeholder=Colonne><button class=rm-div>X</button>\
    </div><button class=add-column-multiple>Ajouter</button>";
    $(this).parent().append(string);
    $(this).remove();
});

$(document).on('click', '.add-column-checkbox', function () {
    var string = "\
    <div>\
        <input name=sub_questions[] type=hidden value='column-checkbox'>\
        <input type=checkbox disabled><input name=sub_questions[] placeholder=Colonne><button class=rm-div>X</button>\
    </div><button class=add-column-checkbox>Ajouter</button>";
    $(this).parent().append(string);
    $(this).remove();
});

$(document).on('click', '.rm-div', function () {
    $(this).parent().remove();
});

$(document).on('change', 'select', function () {
    if ($(this).children('option:selected').val() == "short") {
        $(this).parent(".question-div").children(".question-content").html("<input placeholder='Réponse courte' READONLY>");
    };
    if ($(this).children('option:selected').val() == "long") {
        $(this).parent(".question-div").children(".question-content").html("<textarea placeholder='Réponse longue' READONLY></textarea>");
    };
    if ($(this).children('option:selected').val() == "multiple") {
        $(this).parent(".question-div").children(".question-content").html("<input name=sub_questions[] type=hidden value='radio'>\
                                                                            <input type=radio disabled><input name=sub_questions[] placeholder=Option><br><button class=add-choice>Ajouter</button>");
    };
    if ($(this).children('option:selected').val() == "checkbox") {
        $(this).parent(".question-div").children(".question-content").html("<input name=sub_questions[] type=hidden value='checkbox'>\
                                                                            <input type=checkbox disabled><input name=sub_questions[] placeholder=Option><br><button class=add-check>Ajouter</button>");
    };
    if ($(this).children('option:selected').val() == "list") {
        $(this).parent(".question-div").children(".question-content").html("<input name=sub_questions[] type=hidden value='list'>\
                                                                            <input name=sub_questions[] placeholder=Option><br><button class=add-list>Ajouter</button>");
    };
    if ($(this).children('option:selected').val() == "linear-scale") {
        $(this).parent(".question-div").children(".question-content").html("<input name=sub_questions[] type=hidden value='min-scale'>\
                                                                            <select name=sub_questions[] class=min-scale>\
                                                                                <option>0</option>\
                                                                                <option>1</option>\
                                                                            </select>\
                                                                            <input type=hidden name=sub_questions[] value=max-scale>\
                                                                            <select name=sub_questions[] class=max-scale>\
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
                                                                                <input name=sub_questions[] placeholder=Ligne><button class=add-line>Ajouter</button>\
                                                                            </div>\
                                                                            <div class=column>\
                                                                                <input name=sub_questions[] type=hidden value='column-multiple'>\
                                                                                <input type=radio disabled><input name=sub_questions[] placeholder=Colonne><button class=add-column-multiple>Ajouter</button>\
                                                                            </div>");
    };
    if ($(this).children('option:selected').val() == "grid-checkbox") {
        $(this).parent(".question-div").children(".question-content").html("<div class=line>\
                                                                                <input name=sub_questions[]  type=hidden value='line'>\
                                                                                <input name=sub_questions[] placeholder=Ligne><button class=add-line>Ajouter</button>\
                                                                            </div>\
                                                                            <div class=column>\
                                                                                <input name=sub_questions[] type=hidden value='column-checkbox'>\
                                                                                <input type=checkbox disabled><input name=sub_questions[] placeholder=Colonne><button class=add-column-checkbox>Ajouter</button>\
                                                                            </div>");
    };
    if ($(this).children('option:selected').val() == "date") {
        $(this).parent(".question-div").children(".question-content").html("<input placeholder=Date READONLY>");
    };
    if ($(this).children('option:selected').val() == "hour") {
        $(this).parent(".question-div").children(".question-content").html("<input placeholder=Heure READONLY>");
    };
});






function handleDragStart(e) {
  // Target (this) element is the source node.
  dragSrcEl = this;

  e.dataTransfer.effectAllowed = 'move';
  e.dataTransfer.setData('text/html', this.outerHTML);

  this.classList.add('dragElem');
};



function handleDragOver(e) {
  if (e.preventDefault) {
    e.preventDefault(); // Necessary. Allows us to drop.
    };
  this.classList.add('over');

  e.dataTransfer.dropEffect = 'move';  // See the section on the DataTransfer object.

  return false;
};


function handleDragEnter(e) {
  // this / e.target is the current hover target.
};

function handleDragLeave(e) {
  this.classList.remove('over');  // this / e.target is previous target element.
};

function handleDrop(e) {
  // this/e.target is current target element.

  if (e.stopPropagation) {
    e.stopPropagation(); // Stops some browsers from redirecting.
    };

  // Don't do anything if dropping the same column we're dragging.
  if (dragSrcEl != this) {
    // Set the source column's HTML to the HTML of the column we dropped on.
    //alert(this.outerHTML);
    //dragSrcEl.innerHTML = this.innerHTML;
    //this.innerHTML = e.dataTransfer.getData('text/html');
    this.parentNode.removeChild(dragSrcEl);
    var dropHTML = e.dataTransfer.getData('text/html');
    this.insertAdjacentHTML('beforebegin',dropHTML);
    var dropElem = this.previousSibling;
    addDnDHandlers(dropElem);
    
    };
  this.classList.remove('over');
  return false;
};

function handleDragEnd(e) {
  // this/e.target is the source node.
  this.classList.remove('over');

  /*[].forEach.call(cols, function (col) {
    col.classList.remove('over');
  });*/
};

function addDnDHandlers(elem) {
  elem.addEventListener('dragstart', handleDragStart, false);
  elem.addEventListener('dragenter', handleDragEnter, false)
  elem.addEventListener('dragover', handleDragOver, false);
  elem.addEventListener('dragleave', handleDragLeave, false);
  elem.addEventListener('drop', handleDrop, false);
  elem.addEventListener('dragend', handleDragEnd, false);

};



var cols = document.querySelectorAll('.question-div');
[].forEach.call(cols, addDnDHandlers);

