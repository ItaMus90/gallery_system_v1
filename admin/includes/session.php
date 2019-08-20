<?php



    class Session{

        protected $signed_in;
        public $usre_id;

        public function __construct(){

            session_start();

        }

    }


    $session = new Session();