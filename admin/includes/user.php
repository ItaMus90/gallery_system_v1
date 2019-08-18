<?php


    class User {

        protected $id = null;
        protected $username = null;
        protected $password = null;
        protected $first_name = null;
        protected $last_name = null;

        public static function instantanion($user){

            $obj = new self;

            $obj->id = $user["id"];
            $obj->username = $user["username"];
            $obj->password = $user["password"];
            $obj->first_name = $user["first_name"];
            $obj->last_name = $user["last_name"];

            return $obj;

        }

        protected function query($sql){

            global $db;
            $result = $db->query($sql);

            return $result;

        }


        public function get_users(){

            $sql = "SELECT * FROM users";
            $result = $this->query($sql);

            return $result;

        }

        public function get_user_by_id($id){

            $sql = "SELECT * FROM users WHERE id='". $id ."'LIMIT 1";

            $result = $this->query($sql);

            $user = mysqli_fetch_array($result);

            return $user;

        }


    }