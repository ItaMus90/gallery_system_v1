<?php


    class User extends DB_object {

        //static properties
        protected static $db_table = "users";
        protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');

        //regular properties
        public $id = null;
        public $username = null;
        public $password = null;
        public $first_name = null;
        public $last_name = null;

        //static methods
        public static function verify_user($username, $password){

            global $db;

            $username = $db->escape_string($username);
            $password = $db->escape_string($password);

            $sql = "SELECT * FROM ". self::$db_table ." WHERE";
            $sql .= " username='" .$username. "' AND password='" .$password. "' LIMIT 1";

            $result = self::query($sql);

            return !empty($result) ? array_shift($result) : false;

        }












    }