function copyToClipboard() {
    /* Récupère le contenu de l'input */
    var idSurvey = document.getElementById("linkToCopy");

    /* On met le focus sur l'input et on sélectionne le contenu */
    idSurvey.select();

    /* On copie le texte */
    document.execCommand("copy");

    /* Alert the copied text */
    alert("Copied the text: " + copyText.value);
}

/*A MODIFIER !! copié-collé de https://www.w3schools.com/howto/howto_js_copy_clipboard.asp*/

