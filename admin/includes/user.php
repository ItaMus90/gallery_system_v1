<?php


    class User extends DB_object {

        protected static $db_table = "users";
        protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');
        public $id = null;
        public $username = null;
        public $password = null;
        public $first_name = null;
        public $last_name = null;


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