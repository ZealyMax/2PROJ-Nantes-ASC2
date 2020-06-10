/* Lorsque l'utilisateur clique sur le bouton,
bascule entre le masquage et l'affichage du contenu du menu déroulant */
function dropMenuUser() {
    document.getElementById("droppedMenu").classList.toggle("show");
}

function dropMenuForm(idSurvey) {
    var dropdown = "droppedMenuForm" + idSurvey;
    document.getElementById(dropdown).classList.toggle("show");
}

function shareForm() {
    document.getElementById("divContentToPopup").classList.toggle("show");
}

function closeShareForm() {
    alert("test");
    var dropdowns = document.getElementsByClassName("divContentToPopup");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
        }
    }
}

// Ferme le menu déroulant si l'utilisateur clique en dehors de celui-ci
window.onclick = function (event) {
    if (!event.target.matches('.dropButton')) {
        var dropdowns = document.getElementsByClassName("dropdown-Content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }

    if (!event.target.matches('.more')) {
        var dropdowns = document.getElementsByClassName("dropdownFormContent");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }

    if (event.target.matches('.btn-cancel')) {
        closeShareForm();
    }
    console.log(event.target);
}