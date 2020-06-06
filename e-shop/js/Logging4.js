/**
 * Created by Dimitris on 3/12/2017.
 */
var d = 0;var dfirst = new Date().toISOString().slice(0, 19).replace('T', ' ');var sessionID; counter = 0; var id = $('#uid').val();
$(document).ready(function() {

    //Only do this for registered user
    if (id > 0) {
        setInterval(function () {
            test();
        }, 10000);
        function test() {

                //alert('d is set! ' + d);
                $.post("LastUserActivity.php",
                    {
                        lastactivity: d
                    },
                    function (data, status) {
                        if(data == "Locked"){
                            location.href = 'logout.php';
                        }
                    });
                counter++;

            if(counter == 30){
                //alert("logged out for inactivity!");
                location.href = 'logout.php';
            }
        }

        //Log user activity on new page visit
        $.post("LastUserActivity.php",
            {
                lastactivity: dfirst
            },
            function (data, status) {
                //alert("On load was sent: "+status +" "+dfirst);
            });
        // On Page load
        $(document).onload = resetTimer;
        // On DOM Events
        document.onmousemove = resetTimer;
        document.onkeypress = resetTimer;

        function logout() {
            //alert("You are now logged out.");
            location.href = 'logout.php';
        }
        //format the date
        function resetTimer() {
            d = new Date().toISOString().slice(0, 19).replace('T', ' ');
            counter = 0;
        //reset the timer
            clearTimeout(time);
            time = setTimeout(logout, 300000);
            // 1000 milisec = 1 sec
        }
    }

});
