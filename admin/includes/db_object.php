<?php



class DB_object {

    protected static $db_table = "users";

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



}