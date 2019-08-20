<?php require_once "init.php"; ?>

<?php

    if ($session->is_signed_in()){

        redirect("index.php");

    }


    if (isset($_POST["submit"])){

        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);

        //function check if user exist

        $user = null;

        if ($user){

            $session->login($user);
            redirect("index.php");

        }else{

            $msg = "Your password or username are incorrect";

        }

    }else{

        $username = null;
        $password = null;

    }