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



}