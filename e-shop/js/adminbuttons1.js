/**
 * Created by Dimitris on 23/3/2016.
 */







$(document).ready(function(){
    $("#manprod").click(function(){
        $("#manageUserTable").hide();
        $("#addusebtn").hide();
        $("#adduseform").hide();
        $("#manageProductTable").show();
        $("#addprodbtn").show();
        $(".cleardiv").hide();
        $("#addprodform").hide();
        $("#upimgbtn").hide();
        $("#upimgform").hide();
        $("#editproductform").hide();
        $("#manageViewsReportsTable").hide();
        $("#manageFeatured").hide();
        $("#manageRatings").hide();
    });




    $("#manuse").click(function(){
        $("#manageProductTable").hide();
        $("#addprodbtn").hide();
        $("#adduseform").hide();
        $("#manageUserTable").show();
        $("#addusebtn").show();
        $(".cleardiv").hide();
        $("#addprodform").hide();
        $("#upimgbtn").hide();
        $("#upimgform").hide();
        $("#editproductform").hide();
        $("#manageViewsReportsTable").hide();
        $("#manageFeatured").hide();
        $("#manageRatings").hide();
    });
    $("#manrep").click(function(){
        $("#manageProductTable").hide();
        $("#addprodbtn").hide();
        $("#adduseform").hide();
        $("#manageUserTable").hide();
        $("#addusebtn").hide();
        $(".cleardiv").hide();
        $("#addprodform").hide();
        $("#upimgbtn").hide();
        $("#upimgform").hide();
        $("#editproductform").hide();
        $("#manageViewsReportsTable").show();
        $("#manageFeatured").hide();
        $("#manageRatings").hide();
    });
    $("#manrat").click(function(){
        $("#manageProductTable").hide();
        $("#addprodbtn").hide();
        $("#adduseform").hide();
        $("#manageUserTable").hide();
        $("#addusebtn").hide();
        $(".cleardiv").hide();
        $("#addprodform").hide();
        $("#upimgbtn").hide();
        $("#upimgform").hide();
        $("#editproductform").hide();
        $("#manageViewsReportsTable").hide();
        $("#manageFeatured").hide();
        $("#manageRatings").show();
    });
    $("#manfeat").click(function(){
        $("#manageProductTable").hide();
        $("#addprodbtn").hide();
        $("#adduseform").hide();
        $("#manageUserTable").hide();
        $("#addusebtn").hide();
        $(".cleardiv").hide();
        $("#addprodform").hide();
        $("#upimgbtn").hide();
        $("#upimgform").hide();
        $("#editproductform").hide();
        $("#manageViewsReportsTable").hide();
        $("#manageRatings").hide();
        $("#manageFeatured").show();
    });

            $('input[type="file"]').change(function (e) {

                var fileName = e.target.files[0].name;

                $("#filename").val(fileName);
            });


    $("#addprodbtn").click(function(){
        $("#manageProductTable").hide();
        $("#addprodform").show();
        $("#upimgbtn").show();
        $("#upimgform").hide();

    });
    $("#upimgbtn").click(function(){
        $("#upimgform").show();
        $("#addprodform").hide();
    });


    $("#addusebtn").click(function(){
        $("#manageUserTable").hide();
        $("#adduseform").show();

    });
    $("#manprof").click(function(){
        $("#manhistoryarea").hide();
        $("#manprofarea").show();

    });
    $("#manhistory").click(function(){
        $("#manhistoryarea").show();
        $("#manprofarea").hide();

    });
    $('#list').click(function(event){event.preventDefault();$('#categories-list .item').addClass('list-group-item');});
    $('#grid').click(function(event){event.preventDefault();$('#categories-list .item').removeClass('list-group-item');$('#categories-list .item').addClass('grid-group-item');});

});


