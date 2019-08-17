<?php

    define("DB_HOST","localhost");
    define("DB_USERNAME", "root");
    define("DB_PASSWORD", "");
    define("DB_SCHEMA", "gallery_system");


    $connection = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_SCHEMA);

    if($connection){
        print_r($connection);

    }else{

        echo "ERROR";
    }