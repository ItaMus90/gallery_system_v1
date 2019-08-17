<?php

    require_once "config.php";

    class Database{

        protected $connection = null;


        public function open_db_connection() {

            $this->connection = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_SCHEMA);

            if (mysqli_connect_errno()){

                die("Error sql: " . mysqli_error());

            }
        }

    }



    $db = new Database();
    $db->open_db_connection();



