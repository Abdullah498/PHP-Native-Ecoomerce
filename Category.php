<?php 
    spl_autoload_register(function ($class){
        include $class . '.php';
    });
    class Category extends Database implements Operations{
        private $id;
        private $name;
        private $photo;
        

        public function getName()
        {
            return $this->name;
        }
        public function getId()
        {
            return $this->id;
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
        public function setPhoto($photo){
            $this->photo = $photo;
        }

        public function insertData(){
            
        }
        public function deleteData(){

        }
        public function updateData(){

        }
        public function selectData(){
            $query = "SELECT `categorys`.* FROM `categorys`";
            return $this->runDQL($query);
        }
        
    }
?>