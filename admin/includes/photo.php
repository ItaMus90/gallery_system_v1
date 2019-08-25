<?php



class Photo extends DB_object{


    //static properties
    protected static $db_table = "photos";
    protected static $db_table_fields = array('id', 'title', 'description', 'filename', 'type' , 'size');

    //regular properties
    public $id = null;
    public $title = null;
    public $description = null;
    public $filename = null;
    public $type = null;
    public $sze = null;

}