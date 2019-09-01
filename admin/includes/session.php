<?php



    class Session{

        protected $signed_in = false;
        protected $msg = "";
        public $user_id = null;
        public $visitors_length = null;


        public function __construct(){

            session_start();
            $this->visitor_count();
            $this->check_the_login();
            $this->check_message();

        }

        public function message($msg = ""){

            if (!empty($msg)){

                $_SESSION["message"] = $msg;

            }else {

                return $this->msg;

            }

        }

        public function is_signed_in(){

            return $this->signed_in;

        }

        public function login($user){

            if ($user){

                $this->user_id = $_SESSION["user_id"] = $user->id;
                $this->signed_in = true;


            }

        }

        public function logout(){

            unset($_SESSION["user_id"]);
            unset($this->user_id);
            $this->signed_in = false;
        }


        private function visitor_count() {

            if (isset($_SESSION["visitors_length"])){

                return $this->visitors_length =  $_SESSION["visitors_length"]++;

            }else {

                $_SESSION["visitors_length"] = 1;

            }

        }

        private function check_the_login(){

            if (isset($_SESSION["user_id"])){

                $this->user_id = $_SESSION["user_id"];
                $this->signed_in = true;

            }else{

                unset($this->user_id);
                $this->signed_in = false;

            }

        }


        private function check_message(){

            if (isset($_SESSION["message"])){

                $this->msg = $_SESSION["message"];
                unset($_SESSION["message"]);

            }else{

                $this->msg = "";

            }

        }

    }


    $session = new Session();