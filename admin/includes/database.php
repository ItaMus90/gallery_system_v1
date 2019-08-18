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


        protected function confirm_query($result){

            if (!$result){

                //Maybe return false
                die("Query Failed");

            }

        }


        public function get_connection() {

            //Need to ensure the connection is not null

            return $this->connection;

        }


        public function query($sql){

            $result = mysqli_query($this->connection, $sql);

            return $result;

        }

        public function escape_string($str){

           $escaped_str =  mysqli_real_escape_string($this->connection, $str);

           return $escaped_str;

        }


    }



    $db = new Database();



