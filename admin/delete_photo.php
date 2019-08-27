<?php include("includes/init.php"); ?>

<?php if (!$session->is_signed_in()){redirect("login.php");} ?>

<?php

    if (empty($_GET["id"]) || !isset($_GET["id"])){

        redirect("photos.php");

    }


    $photo = Photo::get_by_id($_GET["id"]);


    if (key($photo)){

        $photo->delete_photo();
        redirect("photos.php");

    }else{

        redirect("photos.php");

    }

?>