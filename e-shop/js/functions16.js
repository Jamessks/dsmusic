/**
 * Created by Dimitris on 19/10/2017.
 */

function productAdded(){
    //alert("Product added!")

}

var a;var c;var b;var p;
var divClone;var divCloneEdit;var divCloneDelete;var divCloneButtons;
var temp;var t;var time;
$(document).ready(function(){



    $("#mybutton").click(function(){
        //alert(userid + " " + productid);

        $.post("addtoCart.php",
            {myuserid : userid,
                myprodid : productid
            },

            function(data, status){
                alert("Cart updated.");
            });});

    $("#service-three").on("click","#submit",(function(){
        $.post("addReview.php",
        {myuserid2 : userid,

            myprodid2 : productid,
            myreview2 : $('#comment').val(),
            myusername2 : username
        },
            function(data, status) {
                alert("Review added.");
                $('#service-three').load("updatedreviewstable.php");


                });
    }));
    $("#service-three").on("click",".helloreview1", (function(){
        a = $(this).attr('value');
        $.post("removeReview.php",
            {myprodid2 : productid,
             reviewid : a
            },
            function(data,status){
                if(data == "Error"){
                    alert("There was an error! Refresh page and try again.")
                }else {
                    alert("Review deleted.");
                    $('#service-three').load("updatedreviewstable.php")
                }
            });
    }));
    $("#service-three").on("click",".helloreview2",function(){
        x = $(this).attr('value');
        divClone = $('.box[data-myid = "' + x + '"]').clone();
        divCloneEdit = $('.helloreview2[value="' + x + '"]').clone();
        divCloneDelete = $('.helloreview1[value="' + x + '"]').clone();
        divCloneButtons= $('.myreviewbuttons[data-myid ="' + x + '"]').clone();

        y = $('.hellopar[value="' + x + '"]').text(); //USE THIS FOR PARAGRAPH TEXT

        var accept=$('<button id="acceptbutton" class="helloreviewaccept" value='+ x +'>Accept</button>');
        var cancel=$('<button id="cancelbutton" class="helloreviewcancel" value='+ x +'>Cancel</button>');
        var buttondiv=$('<div id="hellobuttons" class="neweditbuttons" data-myid="' + x + '" ></div>');
        var textarea=$('<textarea id="myedittextarea" data-myid="' + x + '" class="helloreviewtext" >' + y + '</textarea>');

        $('.myreviewbuttons[data-myid ="'+ x +'"]').replaceWith(buttondiv);
        $('.helloreview2[value="' + x + '"]').replaceWith(accept); //CHANGE TEXT OF BUTTON TO ACCEPT
        $('.helloreview1[value="' + x + '"]').replaceWith(cancel); //CHANGE TEXT OF BUTTON TO CANCEL
        $('.box[data-myid = "' + x + '"]').replaceWith(textarea);

        $(cancel).prependTo(buttondiv);
        $(accept).prependTo(buttondiv);


        //$('.helloreview2').attr('disabled', true);
        //$('.helloreview1').attr('disabled', true);
        $('.helloreview1').hide();
        $('.helloreview2').hide();
        //alert("Y = " + y + " X = " + x);
    });
    $("#service-three").on("click",".helloreviewaccept",function(){
      c = $(this).attr('value');

        //alert("ID IS: " + c + "TEXT IS: " + $('#myedittextarea').val());
        $.post("editReview.php",
            {
                myprodid2 : productid,
                reviewid : c,
                review : $('#myedittextarea').val()
            },
            function(data,status){
                if(data == "Error"){
                    alert("There was an error! Refresh page and try again.")
                }else {
                    alert("Review edited");
                    $('#service-three').load("updatedreviewstable.php")
                }
            });

    });
    $("#service-three").on("click",".helloreviewcancel",function(){

        x = $(this).attr('value');

        $('.helloreviewaccept[value="' + x + '"]').replaceWith(divCloneEdit);
        $('.helloreviewcancel[value="' + x + '"]').replaceWith(divCloneDelete);
        $('.neweditbuttons[data-myid="' + x + '"]').replaceWith(divCloneButtons);
        $('.helloreviewtext[data-myid="' + x + '"]').replaceWith(divClone);

        //$('.helloreview2').attr('disabled', false);
        //$('.helloreview1').attr('disabled', false);
        $('.helloreview1').show();
        $('.helloreview2').show();
        //alert(x);
    });
    $("#selectionid").on("change",function(){
        if(this.value == "Select"){
            $("#myheading").text("Select an item.");
        }else {
            $.post("AVGrating.php",
                {
                    productid : this.value
                },
                function(data,status){
                    if(data == 0){
                        $("#myheading").text("Item has not yet been rated.");
                    }else{
                        $("#myheading").text(data + "/5");
                    }
            });
        }
    });
    $("#selectionpaymentid").on("change",function(){
        if(this.value !="Select") {
            alert("You have chosen: "+ this.value +" --Payment methods are under development. Press Checkout to resume the buying process.")
        }
    });
    $(".selectionfeaturedclass").on("change",function() {
        if(this.value !="SelectFeatured"){
            t = $(this).attr("value");

            $.post("UpdateFeatured.php",
                {
                    productselectedid : this.value,
                    rowidtoupdate : t
                },
                function(data,status){
                    //alert("STATUS IS: " + status +" AND DATA IS: " + data);
                    $.getScript("js/functions16.js");
                    $("#manageFeatured").replaceWith(data);
                    alert("Product Swapped");

                });
        }

    });

        $(".DELUSERCLASS").click(function(e){
            myuname = $(this).attr("data-username");
            if(!confirm('Are you sure you want to delete user with Username:"' + myuname +'" ? ')){
                e.preventDefault();
                return false;
            }
            return true;
        });
    $(".DELPRODUCTCLASS").click(function(e){
        myproductname = $(this).attr("data-product");
        if(!confirm('Are you sure you want to delete product with Title:"' + myproductname +'" ? ')){
            e.preventDefault();
            return false;
        }
        return true;
    });




});


