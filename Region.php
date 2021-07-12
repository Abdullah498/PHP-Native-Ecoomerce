<?php 
    spl_autoload_register(function ($class){
        include $class . '.php';
    });
    class Region extends Database implements Operations{
        private $id;
        private $name;
        private $latitude;
        private $longitude;
        private $cityId;

        public function getName()
        {
            return $this->name;
        } 
        public function getId()
        {
            return $this->id;
        }
        public function getLat()
        {
            return $this->latitude;
        } 
        public function getLong()
        {
            return $this->longitude;
        }
        public function getCityId()
        {
            return $this->cityId;
        }
        
        
        public function setId($id){
            $this->id = $id;
        }
        public function setName($name)
        {
            $this->name = $name;
        }
        public function setLat($latitude)
        {
            $this->latitude = $latitude;
        }
        public function setLong($longitude)
        {
            $this->longitude = $longitude;
        }
        public function setCityId($cityId)
        {
            $this->cityId = $cityId;
        }
        
        
        public function insertData(){
   
        }
        public function deleteData(){

        }
        public function updateData(){

        }
        public function selectData(){

        }


        public function selectRegionsByCityId(){
            $query = "SELECT `regions`.* FROM `regions` WHERE `regions`.`city_id`='$this->cityId'";
            return $this->runDQL($query);
        }
        
        
    }
?>