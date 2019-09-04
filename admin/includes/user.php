<?php


    class User extends DB_object {

        //Static properties
        protected static $db_table = "users";
        protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image');

        //Regular properties
        public $id = null;
        public $username = null;
        public $password = null;
        public $first_name = null;
        public $last_name = null;
        public $user_image = null;
        public $upload_dir = "images";
        public $image_placeholder = "https://via.placeholder.com/400&text=image";
        public $tmp_path = null;



        //Static methods
        public static function verify_user($username, $password){

            global $db;

            $username = $db->escape_string($username);
            $password = $db->escape_string($password);

            $sql = "SELECT * FROM ". self::$db_table ." WHERE";
            $sql .= " username='" .$username. "' AND password='" .$password. "' LIMIT 1";

            $result = self::query($sql);

            return !empty($result) ? array_shift($result) : false;

        }


        //Regular methods
        //This is passing $_FILE['uploaded_file'] as an argument
        public function set_file($file){

            if (empty($file) || !$file || !is_array($file)){

                $this->errors_arr[] = "There was no file uploaded here";

                return false;

            }

            if ($file["error"] !== 0){

                $this->errors_arr[] = $this->upload_errors_arr[$file["error"]];

                return false;

            }

            $this->user_image = basename($file["name"]);
            $this->type     = $file["type"];
            $this->tmp_path = $file["tmp_name"];
            $this->size     = $file["size"];

        }

        public function save_user_and_image(){

            if ($this->id){

                $this->update();

            } else{

                if (!empty($this->errors_arr)){

                    return false;

                }


                if (!isset($this->user_image) || !isset($this->tmp_path)){


                    return false;

                }

                $target_path = SITE_ROOT . DS . "admin" . DS . $this->upload_dir;
                $target_path .= DS . $this->user_image;


                if (move_uploaded_file($this->tmp_path, $target_path)){


                    if ($this->create()){

                        unset($this->tmp_path);

                        return true;

                    }

                }else {

                    $this->errors_arr[] = "The file directory probably does not have permission";

                    return false;

                }


                return false;

            }



        }

        public function get_image_path(){

            $img_path = "";

            if (empty($this->user_image) || !isset($this->user_image)) {

                $img_path = $this->image_placeholder;

            } else {

                $img_path = $this->upload_dir . DS . $this->user_image;

            }

            return $img_path;

        }

        public function update_user_image($user_id = null, $user_image = null){

            if ($user_id === null || $user_image === null){

                return false;

            }

            $this->user_image = $user_image;
            $this->id = $user_id;

            $this->save();


        }






    }