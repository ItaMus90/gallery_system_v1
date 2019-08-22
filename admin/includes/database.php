<?php

    require_once "config.php";

    class Database{

        protected $connection = null;


        function __construct(){

            $this->open_db_connection();

        }


        protected function open_db_connection() {

            //$this->connection = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_SCHEMA);

            $this->connection = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_SCHEMA);

            if ($this->connection->connect_errno){

                die("Error sql: " . $this->connection->connect_error);

            }

        }


        protected function confirm_query($result){

            if (!$result){

                die("Query Failed: " . $this->connection->error);

            }

        }


        public function get_connection() {

            //Need to ensure the connection is not null

            return $this->connection;

        }


        public function query($sql){

            $result = $this->connection->query($sql);

            $this->confirm_query($result);

            return $result;

        }

        public function escape_string($str){

           $escaped_str =  $this->connection->real_escape_string($str);

           return $escaped_str;

        }

        public function last_inserted_id(){

            return mysqli_insert_id($this->connection);

        }


    }



    $db = new Database();



