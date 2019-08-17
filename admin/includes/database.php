<?php

    require_once "config.php";

    class Database{

        protected $connection = null;


        function __construct(){

            $this->open_db_connection();

        }


        protected function open_db_connection() {

            $this->connection = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_SCHEMA);

            if (mysqli_connect_errno()){

                die("Error sql: " . mysqli_error());

            }
        }


        public function get_connection() {

            //Need to ensure the connection is not null

            return $this->connection;

        }

    }



    $db = new Database();



