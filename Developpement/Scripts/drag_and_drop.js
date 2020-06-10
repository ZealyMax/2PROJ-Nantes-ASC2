var dragSrcEl = null;
var home_page = false;
var poubelle = document.getElementById("poubelle") ;
var partage = document.getElementById("partage") ;
if (poubelle != null) {
    var home_page = true;
}


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

/*
function shareForm() {
    document.getElementById("myForm").style.display = "flex";
}

function closeShareForm() {
    document.getElementById("myForm").style.display = "none";
}*/


function handleDrop(e) {
    // this/e.target is current target element.

    if (e.stopPropagation) {
        e.stopPropagation(); // Stops some browsers from redirecting.
    };
    


    if(home_page == true && this.outerHTML ==poubelle.outerHTML){
        RemoveSurvey(dragSrcEl.id);
        //alert(dragSrcEl.id);
        // Supprimer la ligne grace a l'id
	}
    
    /*else if(this.outerHTML == partage.outerHTML){
        alert("Partage le formulaire");
        var string = "<div class='share-popup' id=myForm'>\
            <form action = '/action_page.php' class='share-container' >\
                <h1>Partager</h1>\
                <!--TODO: TROUVER LE LIEN DE PARTAGE-- >\
                     <input type='text' value='http://93.26.58.131/Final_Project/Developpement/Pages/survey_shared.php?survey=" + dragSrcEl.id +  " name='lien' disabled>\
                        <div id='divContentToPopup'>\
                            <div class='a2a_kit a2a_kit_size_32 a2a_default_style'>\
                                <a class='a2a_button_email'></a>\
                                <a class='a2a_button_facebook'></a>\
                                <a class='a2a_button_twitter'></a>\
                            </div>\
                        </div>\
                        <button type='button' class='btn cancel' onclick='closeShareForm()'>Close</button>";
        $("#partage").append(string);
        
        //alert(dragSrcEl.outerHTML);
        //alert(dragSrcEl.id);
        // Recupere le lien de partage du formulaire grace l'id
	}*/

    // Don't do anything if dropping the same column we're dragging.
    else if (dragSrcEl != this) {

        // Set the source column's HTML to the HTML of the column we dropped on.
        //dragSrcEl.innerHTML = this.innerHTML;
        //addDnDHandlers(this);
        //this.outerHTML = e.dataTransfer.getData('text/html');
        
        this.parentNode.removeChild(dragSrcEl);
        var dropHTML = e.dataTransfer.getData('text/html');
        this.insertAdjacentHTML('beforebegin',dropHTML);

        var dropElem = this.previousSibling;




        //alert("Modifier la place des formulaires");
        //alert(dragSrcEl.id);
        //alert(this.id);
        // Modifier l'ordre grace aux IDs des deux formulaires'

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


function RemoveSurvey(id_surveys){
        $.ajax({
            type: 'POST',
            url: '../Scripts/remove_survey.php',
            data:{action: id_surveys},
            success:function(data) {
                document.getElementById(id_surveys).remove();
            }
        })
    }



function addDnDHandlers(elem) {
  elem.addEventListener('dragstart', handleDragStart, false);
  elem.addEventListener('dragenter', handleDragEnter, false)
  elem.addEventListener('dragover', handleDragOver, false);
  elem.addEventListener('dragleave', handleDragLeave, false);
  elem.addEventListener('drop', handleDrop, false);
  elem.addEventListener('dragend', handleDragEnd, false);

};



var cols = document.querySelectorAll('[draggable]');
[].forEach.call(cols, addDnDHandlers);

if (home_page == true) {
    addDnDHandlers(poubelle);
    //addDnDHandlers(partage);
}
