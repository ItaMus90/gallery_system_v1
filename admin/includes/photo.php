<?php



class Photo extends DB_object{


    //static properties
    protected static $db_table = "photos";
    protected static $db_table_fields = array('title', 'description', 'filename', 'type' , 'size');

    //regular properties
    public $id = null;
    public $title = null;
    public $description = null;
    public $filename = null;
    public $type = null;
    public $size = null;
    public $tmp_path = null;
    public $upload_dir = "images";
    public $errors_arr = array();
    public $upload_errors_arr = array(

        UPLOAD_ERR_OK         => "There is no error.",
        UPLOAD_ERR_INI_SIZE   => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
        UPLOAD_ERR_FORM_SIZE  => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML file",
        UPLOAD_ERR_PARTIAL    => "The uploaded file was only partially uploaded.",
        UPLOAD_ERR_NO_FILE    => "No file was uploaded.",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
        UPLOAD_ERR_EXTENSION  => "A PHP extension stopped the file upload."

    );


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