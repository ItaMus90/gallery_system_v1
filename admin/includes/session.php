<?php



    class Session{

        protected $signed_in = false;
        public $usre_id = null;

        public function __construct(){

            session_start();

        }

        private function check_the_login(){

            if (isset($_SESSION["user_id"])){

                $this->usre_id = $_SESSION["user_id"];
                $this->signed_in = true;

            }else{

                unset($this->usre_id);
                $this->signed_in = false;

            }

        }

    }


    $session = new Session();