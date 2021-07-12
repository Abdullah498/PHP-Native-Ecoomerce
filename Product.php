<?php 
    spl_autoload_register(function ($class){
        include $class . '.php';
    });
    class Product extends Database implements Operations{
        private $id;
        private $name;
        private $photo;
        private $price;
        private $code;
        private $brandId;
        private $subcatId;
        public $supplierId;


        public function getId()
        {
            return $this->id;
        } 
        public function getName()
        {
            return $this->name;
        } 
        
        public function getPrice()
        {
            return $this->price;
        } 
        public function getBrandId()
        {
            return $this->brandId;
        }

        public function getSubcatId(){
            return $this->subcatId;
        }
        public function getSupplierId(){
            return $this->supplierId;
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
        public function setPhoto($photo){
            $this->photo = $photo;
        }
        public function setPrice($price){
            $this->price = $price;
        }
        public function setCode($code)
        {
            $this->code = $code;
        }
        public function setSupplierId($supplierId){
            $this->supplierId = $supplierId;
        }
        public function setBrandId($brandId)
        {
            $this->brandId = $brandId;
        }
        public function setSubcatId($subcatId){
            $this->subcatId = $subcatId;
        }


        public function insertData(){
            
        }
        public function deleteData(){

        }
        public function updateData(){

        }
        public function selectData(){
            $query = "SELECT `products`.* FROM `products`";
            return $this->runDQL($query);
        }
        public function selectProductsBySubcatId()
        {
            $query = "SELECT `products`.* FROM `products` WHERE `products`.`subcat_id`='$this->subcatId'";
            return $this->runDQL($query);
        }
        public function getProductById()
        {
            $query = "SELECT `products_reviews`.* FROM `products_reviews` WHERE `products_reviews`.`id`='$this->id'";
            return $this->runDQL($query);
        }
        public function getReviewsByProductId(){
            $query = "SELECT `ratings`.* FROM `ratings` WHERE `ratings`.`product_id`='$this->id'";
            return $this->runDQL($query);
        }
        public function incrementViews(){
            $query = "UPDATE `products` SET `products`.`views` = (`products`.`views`+1) 
            WHERE `products`.`id`='$this->id'";
            return $this->runDML($query);
        }
        public function getNewestProducts(){
            $query = "SELECT `products`.* FROM `products` ORDER BY `products`.`created_at` DESC LIMIT 4";
            return $this->runDQL($query);
        }
        public function getMostRatedProducts(){
            $query = "SELECT `most_rated`.* FROM `most_rated` Limit 4";
            return $this->runDQL($query);
        }
        public function getMostOrderedProducts(){
            $query = "SELECT `most_ordered`.* FROM `most_ordered` LIMIT 4";
            return $this->runDQL($query);
            /*
                SELECT
                `products`.*,
                COUNT(`products_orders`.`product_id`) AS 'orders_count'
            FROM `products_orders`
            RIGHT JOIN `products`
            ON `products_orders`.`product_id` = `products`.`id`
            GROUP BY `products`.`id`
            ORDER BY orders_count DESC , `products`.`views` DESC 
            */
        }

        public function getMostViewedProducts(){
            $query = "SELECT `products`.* FROM `products` ORDER BY `products`.`views` DESC LIMIT 4";
            return $this->runDQL($query);
        }
    }
?>