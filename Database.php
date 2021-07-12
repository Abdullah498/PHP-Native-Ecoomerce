<?php
    class Database{
        private $hostName = "localhost";
        private $username = "root";
        private $pass = "";
        private $databaseName = "ntiecommerce";
        private $mysqli;

        public function __construct(){

            $this->mysqli = new mysqli($this->hostName , $this->username , $this->pass , $this->databaseName);
            if($this->mysqli -> connect_errno){
                echo "Failed to connect to MySQL: " . $this->mysqli->connect_error;
            }else{
                //echo 'database successfully connected';
            }
        }
        
        public function runDML($query){ //for update,delete and insert operations
            $result = $this->mysqli->query($query);
            if($result === TRUE)
                return TRUE;
            else
                FALSE;
        }
        public function runDQL($query){ //for selectes queries
            $result = $this->mysqli->query($query);
            if($result->num_rows > 0)
                return $result;
            else
                return [];
        }
    }

?>