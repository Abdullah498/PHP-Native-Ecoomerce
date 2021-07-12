<?php 
    spl_autoload_register(function ($class){
        include $class . '.php';
    });
    class User extends Database implements Operations{
        private $id;
        private $name;
        private $photo;
        private $phone;
        private $email;
        private $password;
        private $gender;
        private $code;
        public $status;

        public function getName()
        {
            return $this->name;
        } 
        public function getPhone()
        {
            return $this->phone;
        }
        public function getEmail()
        {
            return $this->email;
        } 
        public function getPassword()
        {
            return $this->password;
        } 
        public function getGender()
        {
            return $this->gender;
        }

        public function getStatus(){
            return $this->status;
        }
        public function getCode()
        {
            return $this->code;
        }
        public function getPhoto(){
            return $this->photo;
        }

        public function setId($id){
            $this->id = $id;
        }
        public function setName($name)
        {
            $this->name = $name;
        }
        public function setPhone($phone)
        {
                $this->phone = $phone;
        }
        public function setEmail($email)
        {
                $this->email = $email;
        }
        public function setPassword($password)
        {
                $this->password = sha1($password);
        }
        public function setGender($gender)
        {
                $this->gender = $gender;
        }
       
        public function setCode($code){
            $this->code = $code;
        }

        public function setPhoto($photo){
            $this->photo = $photo;
        }

        public function insertData(){
            
            $query = "INSERT INTO
            `users` (`users`.`name` , `users`.`phone` , `users`.`email` , `users`.`gender` , `users`.`password` , `users`.`code`) 
            VALUES ('$this->name' , '$this->phone' , '$this->email' , '$this->gender' , '$this->password' , '$this->code') ";
            
            return $result = $this->runDML($query);
        }
        public function deleteData(){

        }
        public function updateData(){

        }
        public function selectData(){

        }
        public function setStatus($status){
            $this->status = $status;
        }
        public function checkCode(){
            $query = "SELECT `users`.* FROM `users` WHERE `users`.`email` = '$this->email' AND `users`.`code` = '$this->code'";
            echo $query;
            return $this->runDQL($query);
        }
        

        public function updateStatus(){
            $query = "UPDATE `users` SET `users`.`status` = '$this->status' WHERE `users`.`email`='$this->email'";
            return $this->runDML($query);
        }

        public function login(){
            $query = "SELECT `users`.* FROM `users` WHERE `users`.`email` = '$this->email' AND `users`.`password` = '$this->password'";
            echo $query;
            return $this->runDQL($query);
        }
        public function updateProfile(){
            $query = "UPDATE `users` SET 
            `users`.`name` = '$this->name',
            `users`.`phone` = '$this->phone',
            `users`.`gender` = '$this->gender'";
            if($this->photo){
                $query .= ",`users`.`photo` = '$this->photo'";
            }
            $query .="WHERE `users`.`id` ='$this->id'";
            return $this->runDML($query);
        }
        public function checkPassword(){
            $query = "SELECT `users`.* FROM `users` WHERE `users`.`id` = '$this->id'";
            return $this->runDQL($query);
        }
        public function updatePassword(){
            $query = "UPDATE `users` SET `users`.`password` = '$this->password' WHERE `users`.`id`='$this->id'";
            return $this->runDML($query);
        }
        public function updateEmail(){
            $query = "UPDATE `users` SET `users`.`email` = '$this->email' , `users`.`code` = '$this->code' , `users`.`status` = '$this->status' WHERE `users`.`id`='$this->id'";
            return $this->runDML($query);
        }
        public function checkEmail(){
            $query = "SELECT `users`.* FROM `users` WHERE `users`.`email`='$this->email'";
            return $this->runDQL($query);
        }
        public function updateCode(){
            $query = "UPDATE `users` SET `users`.`code`='$this->code' WHERE `users`.`email`='$this->email'";
            echo $query;
            return $this->runDML($query);
        }
        public function getUserById(){
            $query = "SELECT `users`.* FROM `users` WHERE `users`.`id`='$this->id'";
            return $this->runDQL($query);
        }
    }
?>