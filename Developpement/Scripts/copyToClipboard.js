function copyToClipboard() {
    /* Récupère le contenu de l'input */
    var idSurvey = document.getElementById("linkToCopy");

    /* On met le focus sur l'input et on sélectionne le contenu */
    idSurvey.select();

    /* On copie le texte */
    document.execCommand("copy");

}

