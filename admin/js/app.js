$(document).ready(function(){

    //User
    var user_href = null;
    var user_href_splitted = null;
    var user_id = null;

    //Photo
    var photo_src = null;
    var photo_src_splitted = null;
    var photo_id = null;

    $(".modal_thumbnails").click(function(){

        $("#set_user_image").prop('disabled', false);


        user_href = $("#user_id").prop("href");

        user_href_splitted = user_href.split("=");

        user_id = user_href_splitted[user_href_splitted.length - 1];

        photo_src = $(this).prop("src");

        photo_src_splitted = photo_src.split("/");

        photo_id = photo_src_splitted[photo_src_splitted.length - 1];

        console.log(photo_id);


    });




    tinymce.init({selector:'textarea'});

});


