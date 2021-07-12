<?php 
    spl_autoload_register(function ($class){
        include $class . '.php';
    });
    class Address extends Database implements Operations{
        private $id;
        private $street;
        private $building;
        private $floor;
        private $flat;
        private $regionId;
        private $userId;
        private $detail;


        
        public function getId()
        {
            return $this->id;
        }
        public function getStreet()
        {
            return $this->street;
        } 
        public function getBuilding()
        {
            return $this->building;
        } 
        public function getFloor()
        {
            return $this->floor;
        }
        public function getFlat()
        {
            return $this->flat;
        }
        public function getDetail()
        {
            return $this->detail;
        }
        public function getUserId()
        {
            return $this->userId;
        }
        public function getRegionId()
        {
            return $this->regionId;
        }
        
        
        public function setId($id){
            $this->id = $id;
        }
        public function setStreet($street)
        {
            $this->street = $street;
        }
        public function setBuilding($building)
        {
            $this->building = $building;
        }
        public function setFloor($floor)
        {
            $this->floor = $floor;
        }
        public function setFlat($flat)
        {
            $this->flat = $flat;
        }
        public function setDetail($detail)
        {
            $this->detail = $detail;
        }
        public function setUserId($userId)
        {
            $this->userId = $userId;
        }
        public function setRegionId($regionId)
        {
            $this->regionId = $regionId;
        }
        
        
        public function insertData(){
            $query = "INSERT INTO `addresss` 
            (`addresss`.`street`,`addresss`.`building`,`addresss`.`floor`,`addresss`.`flat`,`addresss`.`detail`,`addresss`.`user_id`,`addresss`.`region_id`) 
            VALUES('$this->street','$this->building','$this->floor','$this->flat','$this->detail','$this->userId','$this->regionId')";
            
            $this->runDML($query);
        }
        public function deleteData(){

        }
        public function updateData(){

        }
        public function selectData(){

        }
        
        public function getAddressesByUserId()
        {
            $query = "SELECT `addresss`.* FROM `addresss` WHERE `addresss`.`user_id`='$this->userId'";
            
            return $this->runDQL($query);
        }
        public function editAddress()
        {
            $query = "UPDATE `addresss` 
            SET `addresss`.`street`='$this->street',`addresss`.`building`='$this->building',
            `addresss`.`floor`='$this->floor',`addresss`.`flat`='$this->flat',
            `addresss`.`region_id`='$this->regionId',`addresss`.`detail`='$this->detail'
            WHERE `addresss`.`id`='$this->id'";
            
            return $this->runDML($query);
        }
        public function deleteAddress(){
            $query = "DELETE FROM `addresss` WHERE `addresss`.`id`='$this->id'";
            return $this->runDML($query);
        }
        
    }
?>