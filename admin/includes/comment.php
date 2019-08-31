<?php


class Comment extends DB_object{


    //static properties
    protected static $db_table = "comments";
    protected static $db_table_fields = array('photo_id', 'author', 'body', 'date');

    //regular properties
    public $id = null;
    public $photo_id= null;
    public $author = null;
    public $body = null;
    public $date = null;


    //static methods
    public static function create_comment($photo_id = null, $author = "John", $body = ""){

        if ($photo_id !== null || !empty($photo_id)){

            $comment = new Comment();

            $comment->photo_id = (int)$photo_id;
            $comment->author = $author;
            $comment->body = $body;
            $comment->date = self::get_current_datetime();

            return $comment;

        }

        return false;

    }


    public static function find_comments($photo_id = null){

        if ($photo_id !== null || !empty($photo_id)){

            global $db;

            $sql = "SELECT * FROM " . self::$db_table;
            $sql .= " WHERE photo_id=" . $db->escape_string($photo_id);
            $sql .= " ORDER BY date DESC";

            return self::query($sql);

        }

        return false;

    }

}