<?php 
    spl_autoload_register(function ($class){
        include $class . '.php';
    });
    class Subcategory extends Database implements Operations{
        private $id;
        private $name;
        private $photo;
        private $categoryId;
        

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
        public function getCategoryId(){
            return $this->categoryId;
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
        public function setCategoryId($categoryId){
            $this->categoryId = $categoryId;
        }

        public function insertData(){
            
        }
        public function deleteData(){

        }
        public function updateData(){

        }
        public function selectData(){

        }
        public function getSubcatByCatId(){
            $query = "SELECT `subcategorys`.* FROM `subcategorys` WHERE `subcategorys`.`category_id`='$this->categoryId'";
    
            return $this->runDQL($query);
        }
        
    }
?>