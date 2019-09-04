<?php include("includes/init.php"); ?>

<?php if (!$session->is_signed_in()){redirect("login.php");} ?>

<?php

    if (empty($_GET["id"]) || !isset($_GET["id"])){

        redirect("users.php");

    }


    $user = User::get_by_id($_GET["id"]);


    if (key($user)){

        $user->delete();
        redirect("users.php");
        $session->message("User " . $user->username ." has been delete");

    }else{

        redirect("users.php");

    }

?>