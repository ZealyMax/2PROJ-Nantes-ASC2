function copyToClipboard(idSurvey) {
    /* Get the text field */
    var idSurvey = document.getElementById("myInput");

    /* Select the text field */
    idSurvey.select();
    idSurvey.setSelectionRange(0, 99999); /*For mobile devices*/

    /* Copy the text inside the text field */
    document.execCommand("copy");

    /* Alert the copied text */
    alert("Copied the text: " + copyText.value);
}

/*A MODIFIER !! copié-collé de https://www.w3schools.com/howto/howto_js_copy_clipboard.asp*/

