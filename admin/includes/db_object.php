<?php



class DB_object {

    //static properties
    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');

    //static methods
    protected static function query($sql){

        global $db;
        $result = $db->query($sql);
        $arr_obj = array();

        while ($row = mysqli_fetch_array($result)){

            $arr_obj[] = static::instantanion($row);

        }

        return $arr_obj;

    }

    public static function instantanion($class_ob){

        $calling_class = get_called_class();

        $obj = new $calling_class;

//            $obj->id = $user["id"];
//            $obj->username = $user["username"];
//            $obj->password = $user["password"];
//            $obj->first_name = $user["first_name"];
//            $obj->last_name = $user["last_name"];


        foreach ($class_ob as $key => $value){

            if ($obj->has_the_key($key)){

                $obj->$key = $value;

            }

        }

        return $obj;

    }

    public static function get_all(){

        $sql = "SELECT * FROM ".static::$db_table;
        $result = static::query($sql);

        return $result;

    }

    public static function get_by_id($id){

        $sql = "SELECT * FROM ". static::$db_table ." WHERE id='". $id ."'LIMIT 1";

        $result = static::query($sql);

        return !empty($result) ? array_shift($result) : false;

    }

    //regular methods
    protected function clean_properties(){

        global $db;

        $clean_properties = array();

        foreach ($this->get_properties() as $key => $value){

            $clean_properties[$key] = $db->escape_string($value);
        }

        return $clean_properties;

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

        foreach (static::$db_table_fields as $db_field){

            if (property_exists($this,$db_field)){

                $properties[$db_field] = $this->$db_field;

            }

        }

        return $properties;

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

        //$sql = "INSERT INTO " .static::$db_table. " (username, password, first_name, last_name)";
        //$sql .= " values('".$username."', '".$password."', '".$first_name."', '".$last_name."')";

        $sql = "INSERT INTO " .static::$db_table. " (". implode(',', array_keys($properties)) .")";
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
        $sql = "UPDATE ".static::$db_table." SET";
        $sql .= " username='".$username."',";
        $sql .= " password='".$password."',";
        $sql .= " first_name='".$first_name."',";
        $sql .= " last_name='".$last_name."'";
        $sql .= " WHERE id='".$id."'";
        */

        $sql = "UPDATE ".static::$db_table." SET ";
        $sql .= implode(", ", $properties_pairs);
        $sql .= " WHERE id='" .$id ."'";

        $db->query($sql);

        return (mysqli_affected_rows($db->get_connection()) === 1) ? true : false;


    }

    public function delete() {

        global $db;

        $id = $db->escape_string($this->id);

        $sql = "DELETE FROM ".static::$db_table;
        $sql .= " WHERE id='".$id."' LIMIT 1";

        $db->query($sql);

        return (mysqli_affected_rows($db->get_connection()) === 1) ? true : false;

    }


}