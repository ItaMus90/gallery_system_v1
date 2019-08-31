<?php include("includes/init.php"); ?>

<?php if (!$session->is_signed_in()){redirect("login.php");} ?>

<?php

if (empty($_GET["id"]) || !isset($_GET["id"])){

    redirect("comments.php");

}


$comment = Comment::get_by_id($_GET["id"]);


if (key($comment)){

    $comment->delete();
    redirect("comments.php");

}else{

    redirect("comments.php");

}

?>