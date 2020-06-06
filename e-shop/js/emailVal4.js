/**
 * Created by Dimitris on 16/11/2017.
 */

$(document).ready(function() {
    var myfname = 0;
    var mylname = 0;
    var myuname = 0;
    var myemail = 0;
    function validateEmail(sEmail) {
        var reEmail = /^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/;

        if (!sEmail.match(reEmail)) {

            return false;
        }

        return true;

    }

    function validatefname(fname) {
        var refname = /^[A-Za-z]+$/;

        if (!fname.match(refname)) {


            return false;
        }

        return true;

    }

    function validatelname(lname) {
        var relname = /^[A-Za-z]+$/;

        if (!lname.match(relname)) {


            return false;
        }

        return true;

    }

    function validateuname(uname) {
        var reuname = /^[a-zA-Z0-9_]*$/;

        if (!uname.match(reuname)) {


            return false;
        }

        return true;

    }

    $("#firstnameprof").on("change", function () {
        if (validatefname($("#firstnameprof").val()) == true) {
            myfname = 1;
            $("#correctfname").show();
            $("#wrongfname").hide();
        } else {
            myfname = 2;
            $("#correctfname").hide();
            $("#wrongfname").show();
        }
        if($("#firstnameprof").val() == userfirstprof){
            myfname = 0;
            $("#correctfname").hide();
            $("#wrongfname").hide();
        }
    });
    $("#lastnameprof").on("change", function () {
        if (validatelname($("#lastnameprof").val()) == true) {
            mylname = 1;
            $("#correctlname").show();
            $("#wronglname").hide();
        } else {
            mylname = 2;
            $("#correctlname").hide();
            $("#wronglname").show();
        }if($("#lastnameprof").val() == userlastprof){
            mylname = 0;

            $("#correctlname").hide();
            $("#wronglname").hide();
        }
    });
    $("#usernameprof").on("change", function () {
        if(this.value !== usernameprof) {
            alert("This works correctly");

            if (validateuname(this.value) === true) {

                $("#correctuname").show();
                $("#wronguname").hide();
                $.post("validateUsername.php",
                    {
                        username: this.value
                    },
                    function (data, status) {
                        if (data == "0") {
                            myuname = 1;
                            $("#unameexists").hide();

                        } else {
                            myuname = 2;
                            $("#unameexists").show();

                        }
                    });
            } else {

                $("#correctuname").hide();
                $("#wronguname").show();
            }}else{myuname = 0;$("#unameexists").hide();$("#correctuname").hide();$("#wronguname").hide();}

    });
    $("#emailprof").on("change", function () {
        if(this.value.toString !== useremail){
            alert("THIS: " + this.value + " VARIABLE: " + $.trim(useremail));
        }
        if(this.value !== useremail) {
            //alert("This works correctly");

            if (validateEmail(this.value) === true) {
                $("#correct").show();
                $("#wrong").hide();
                $.post("validateEmail.php",
                    {
                        email: this.value
                    },
                    function (data, status) {
                        if (data == "0") {
                            myemail = 1;
                            $("#emailexists").hide();

                        } else {
                            myemail = 2;
                            $("#emailexists").show();

                        }
                    });
            } else {

                $("#correct").hide();
                $("#wrong").show();
            }}else{myemail = 0;$("#emailexists").hide();
            $("#correct").hide();
            $("#wrong").hide();
            alert("wtf");}

    });

    $( "#editprofile" ).submit(function( event ) {


        if(myfname === 0 && mylname === 0 && myuname === 0 && myemail === 0) {
            event.preventDefault();
            alert("No changes were made");
        }
        else if(myfname === 2 || mylname === 2 || myuname === 2 || myemail === 2) {

            event.preventDefault();
            alert("Check your data");
        }
    });
});

