<?php



class Photo extends DB_object{


    //static properties
    protected static $db_table = "photos";
    protected static $db_table_fields = array('title', 'description', 'filename', 'type' , 'size', 'caption', 'alternate_text');

    //regular properties
    public $id = null;
    public $title = null;
    public $description = null;
    public $filename = null;
    public $type = null;
    public $size = null;
    public $caption = null;
    public $alternate_text = null;
    public $tmp_path = null;
    public $upload_dir = "images";

    //Static methods
    public static function display_sidebar_data($photo_id = null){

        if ($photo_id === null)
            return false;

        $photo = Photo::get_by_id($photo_id);

        if (!key($photo))
            return false;


        $output  = "<a class='thumbnail' href=''><img width='100' src='".$photo->get_images_path()."' alt=''></a>";
        $output .= "<p>".$photo->filename."</p>";
        $output .= "<p>".$photo->type."</p>";
        $output .= "<p>".$photo->size."</p>";


        echo $output;

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

        $this->filename = basename($file["name"]);
        $this->type     = $file["type"];
        $this->tmp_path = $file["tmp_name"];
        $this->size     = $file["size"];

    }

    public function get_images_path() {

        return $this->upload_dir . DS . $this->filename;

    }

    public function save(){

        if ($this->id){

            $this->update();

        } else{

            if (!empty($this->errors_arr)){

                return false;

            }

            if (!isset($this->filename) || !isset($this->tmp_path)){

                $this->errors_arr[] = "The file was not available";

                return false;

            }

            $target_path = SITE_ROOT . DS . "admin" . DS . $this->upload_dir;
            $target_path .= DS . $this->filename;


            if (file_exists($target_path)){

                $this->errors_arr[] = "The File " . $this->filename . " already exists";

                return false;

            }

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

    public function delete_photo(){

        if ($this->delete()){

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->get_images_path();

            return unlink($target_path) ? true : false;

        }else {

            return  false;

        }

    }


}