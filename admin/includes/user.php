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

            $result = (new self)->query($sql);

            return !empty($result) ? array_shift($result) : false;

        }





        public function save(){

            return isset($this->id) ? $this->update() : $this->create();

        }

        public function create() {

            global $db;

            $properties = $this->clean_properties();

            /*
            $username = $db->escape_string($this->username);
            $password = $db->escape_string($this->password);
            $first_name = $db->escape_string($this->first_name);
            $last_name = $db->escape_string($this->last_name);
            */

            //$sql = "INSERT INTO " .self::$db_table. " (username, password, first_name, last_name)";
            //$sql .= " values('".$username."', '".$password."', '".$first_name."', '".$last_name."')";

            $sql = "INSERT INTO " .self::$db_table. " (". implode(',', array_keys($properties)) .")";
            $sql .= " values('".  implode("','", array_values($properties))  ."')";


            if ($db->query($sql)){

                $this->id = $db->last_inserted_id();

                return true;

            }else {

                return false;

            }

        }

        public function update() {

            global $db;

            $properties = $this->clean_properties();
            $properties_pairs = array();

            $id = $db->escape_string($this->id);

            foreach ($properties as $key => $value){

                $properties_pairs[] = $key . "=". "'". $value . "'";

            }


            /*
            $username = $db->escape_string($this->username);
            $password = $db->escape_string($this->password);
            $first_name = $db->escape_string($this->first_name);
            $last_name = $db->escape_string($this->last_name);
            $id = $db->escape_string($this->id);
            */

            /*
            $sql = "UPDATE ".self::$db_table." SET";
            $sql .= " username='".$username."',";
            $sql .= " password='".$password."',";
            $sql .= " first_name='".$first_name."',";
            $sql .= " last_name='".$last_name."'";
            $sql .= " WHERE id='".$id."'";
            */

            $sql = "UPDATE ".self::$db_table." SET ";
            $sql .= implode(", ", $properties_pairs);
            $sql .= " WHERE id='" .$id ."'";

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

        protected function has_the_key($key){

            $arr_prop = get_object_vars($this);

            if (!key($arr_prop))
                return false;

            return array_key_exists($key, $arr_prop);

        }



        protected function get_properties(){

            //return get_object_vars($this);

            $properties = array();

            foreach (self::$db_table_fields as $db_field){

                if (property_exists($this,$db_field)){

                    $properties[$db_field] = $this->$db_field;

                }

            }

            return $properties;

        }

        protected function clean_properties(){

            global $db;

            $clean_properties = array();

            foreach ($this->get_properties() as $key => $value){

                $clean_properties[$key] = $db->escape_string($value);
            }

            return $clean_properties;

        }

    }