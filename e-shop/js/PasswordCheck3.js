/**
 * Created by Dimitris on 5/11/2017.
 */
function scorePassword(pass) {
    var score = 0;
    if (!pass)
        return score;

    // award every unique letter until 5 repetitions
    var letters = new Object();
    for (var i=0; i<pass.length; i++) {
        letters[pass[i]] = (letters[pass[i]] || 0) + 1;
        score += 5.0 / letters[pass[i]];
    }

    // bonus points for mixing it up
    var variations = {
        digits: /\d/.test(pass),
        lower: /[a-z]/.test(pass),
        upper: /[A-Z]/.test(pass),
        nonWords: /\W/.test(pass)
    },

    variationCount = 0;
    for (var check in variations) {
        variationCount += (variations[check] == true) ? 1 : 0;
    }
    score += (variationCount - 1) * 10;

    return parseInt(score);
}

function checkPassStrength(pass) {
    var score = scorePassword(pass);
    if (score > 80)
        return "strong";
    if (score > 60)
        return "good";
    if (score >= 30)
        return "weak";
    if (score > 0 && score <= 29)
        return "very weak";
    if (score == 0)
        return "no password";
    return "";
}

$(document).ready(function() {
    $("#password").on("keypress keyup keydown", function() {
        var pass = $(this).val();
        $("#pass_strength").text(checkPassStrength(pass));

        if(checkPassStrength(pass) == "very weak"){
            $("#pass_strength").css("color", "mediumseagreen");
            //$('#create-account').attr('disabled', true);
        }else if(checkPassStrength(pass) == "weak"){
            $("#pass_strength").css("color", "green");
            //$('#create-account').attr('disabled', true);
        }else if(checkPassStrength(pass) == "good"){
            $("#pass_strength").css("color", "orange");
            //$('#create-account').attr('disabled', false);
        }else if(checkPassStrength(pass) == "strong"){
            $("#pass_strength").css("color", "red");
            $('#create-account').attr('disabled', false);
        }else{
            $("#pass_strength").css("color", "black");
            //$('#create-account').attr('disabled', true);
        }
    });
});
