<?php


    class User {

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

            $sql = "SELECT * FROM users WHERE";
            $sql .= "username='" .$username. "' AND password='" .$password. "' LIMIT 1";

            $result = (new self)->query($sql);

            return !empty($result) ? array_shift($result) : false;

        }

        public function get_users(){

            $sql = "SELECT * FROM users";
            $result = $this->query($sql);

            return $result;

        }

        public function get_user_by_id($id){

            $sql = "SELECT * FROM users WHERE id='". $id ."'LIMIT 1";

            $result = $this->query($sql);

            return !empty($result) ? array_shift($result) : false;

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