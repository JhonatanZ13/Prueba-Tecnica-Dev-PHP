<?php

    class Connection 
    {
        private $server;
        private $user;
        private $pass;
        private $database;
        private $link;

        function __construct(){
            $this->setConnect();
            $this->connect();
        }
        private function setConnect(){
            include_once 'conf.php';
            $this->server=$server;
            $this->user=$user;
            $this->pass=$pass;
            $this->database=$database;
        }
        private function connect(){
            $this->link=mysqli_connect($this->server,$this->user,$this->pass,$this->database);
        }

        public function getConnect(){
            return $this->link;
        }
        
        public function close(){
            mysqli_close($this->link);
        }
    }
    

?>