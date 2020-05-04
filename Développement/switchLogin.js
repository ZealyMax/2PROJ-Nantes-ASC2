$("#signIn").on('click', function () {
    console.log("test sign in");
    string = "<div id=\"Content\"><form action = \"create_account.php\" method = \"post\" ><div class=\"Credentials\"><input class=\"inputFields\" name=\"login\" type=\"text\" placeholder=\"Username\"><input class=\"inputFields\" name=\"mail\" type=\"text\" placeholder=\"Email\"><input class=\"inputFields\" name=\"password\" type=\"password\" placeholder=\"Password\"><input class=\"inputFields\" name=\"confirmPassword\" type=\"password\" placeholder=\"Confirm password\"></div><div class=\"Other\"><input class=\"btn\" name=\"submit\" type=\"submit\" value=\"CREATE ACCOUNT\"><div class=\"links\"><a id=\"connect\" >&larr; Back to login</a></div></div></form></div>";
    $("#Content").remove();
    $(".bg-login").append(string);
});


$("#connect").on('click', function () {
    console.log("test back to login");
    string = "<div id=\"Content\">< form action = \"connect.php\" method = \"post\" ><div class=\"Credentials\"><input class=\"inputFields login\" name=\"login\" type=\"text\" placeholder=\"Username or email\"><input class=\"inputFields password\" name=\"password\" type=\"password\" placeholder=\"Password\"></div><div class=\"Other\"><label class=\"container\">Remember me<input type=\"checkbox\"><span class=\"checkmark\"></span></label><input class=\"btn\" name=\"submit\" type=\"submit\" value=\"LOGIN\"><div class=\"links\"><a id=\"signIn\">Sign up</a><a id=\"fPassword\">Forgot your password ?</a></div></div ></form ></div > ";
    $("#Content").remove();
    $(".bg-login").append(string);
});