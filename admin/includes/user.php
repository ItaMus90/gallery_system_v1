<?php


    class User {

        protected static $db_table = "users";
        public $id = null;
        public $username = null;
        public $password = null;
        public $first_name = null;
        public $last_name = null;


        public static function instantanion($user){

            $obj = new self;

//            $obj->id = $user["id"];
//            $obj->username = $user["username"];
//            $obj->password = $user["password"];
//            $obj->first_name = $user["first_name"];
//            $obj->last_name = $user["last_name"];


            foreach ($user as $key => $value){

                if ($obj->has_the_key($key)){

                    $obj->$key = $value;

                }

            }

            return $obj;

        }

        public static function verify_user($username, $password){

            global $db;

            $username = $db->escape_string($username);
            $password = $db->escape_string($password);

            $sql = "SELECT * FROM ". self::$db_table ." WHERE";
            $sql .= " username='" .$username. "' AND password='" .$password. "' LIMIT 1";

            $result = (new self)->query($sql);

            return !empty($result) ? array_shift($result) : false;

        }

        public static function get_user_by_id($id){

            $sql = "SELECT * FROM users WHERE id='". $id ."'LIMIT 1";

            $result = (new self)->query($sql);

            return !empty($result) ? array_shift($result) : false;

        }

        public function save(){

            return isset($this->id) ? $this->update() : $this->create();

        }

        public function create() {

            global $db;

            $username = $db->escape_string($this->username);
            $password = $db->escape_string($this->password);
            $first_name = $db->escape_string($this->first_name);
            $last_name = $db->escape_string($this->last_name);

            $sql = "INSERT INTO " .self::$db_table. " (username, password, first_name, last_name)";
            $sql .= " values('".$username."', '".$password."', '".$first_name."', '".$last_name."')";

            if ($db->query($sql)){

                $this->id = $db->last_inserted_id();

                return true;

            }else {

                return false;

            }

        }

        public function update() {

            global $db;

            $username = $db->escape_string($this->username);
            $password = $db->escape_string($this->password);
            $first_name = $db->escape_string($this->first_name);
            $last_name = $db->escape_string($this->last_name);
            $id = $db->escape_string($this->id);

            $sql = "UPDATE ".self::$db_table." SET";
            $sql .= " username='".$username."',";
            $sql .= " password='".$password."',";
            $sql .= " first_name='".$first_name."',";
            $sql .= " last_name='".$last_name."'";
            $sql .= " WHERE id='".$id."'";

            $db->query($sql);

            return (mysqli_affected_rows($db->get_connection()) === 1) ? true : false;


        }

        public function delete() {

            global $db;

            $id = $db->escape_string($this->id);

            $sql = "DELETE FROM ".self::$db_table;
            $sql .= " WHERE id='".$id."' LIMIT 1";

            $db->query($sql);

            return (mysqli_affected_rows($db->get_connection()) === 1) ? true : false;

        }

        public function get_users(){

            $sql = "SELECT * FROM ".self::$db_table;
            $result = $this->query($sql);

            return $result;

        }

        protected function has_the_key($key){

            $arr_prop = get_object_vars($this);

            if (!key($arr_prop))
                return false;

            return array_key_exists($key, $arr_prop);

        }

        protected function query($sql){

            global $db;
            $result = $db->query($sql);
            $arr_obj = array();

            while ($row = mysqli_fetch_array($result)){

                $arr_obj[] = self::instantanion($row);

            }

            return $arr_obj;

        }

    }