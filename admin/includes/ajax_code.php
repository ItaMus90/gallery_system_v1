<?php


require_once "init.php";

if (isset($_POST["photo_name"]) && isset($_POST["user_id"])){

    $user_id = $_POST["user_id"];
    $user_image = $_POST["photo_name"];

    $user = new User();

    $user->update_user_image($user_id, $user_image);

}