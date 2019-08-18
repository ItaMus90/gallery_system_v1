<?php


    class User {


        public function get_users(){

            global $db;

            $sql = "SELECT * FROM users";

            $result = $db->query($sql);

            return $result;

        }

    }