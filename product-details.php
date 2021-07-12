<?php include_once 'header.php'; ?>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>SINGLE PRODUCT</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="active">Single Product</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<!-- Product Deatils Area Start -->
<?php
if (isset($_GET['id']) && $_GET['id']) {
    $product = new Product();
    $product->setId($_GET['id']);
    $product->incrementViews();
    $result = $product->getProductById();
    if (!empty($result)) {
        $currentProduct = $result->fetch_object();
    } else {
        header('location: 404.php');
    }
} else {
    header('location: 404.php');
}
?>
<div class="product-details pt-100 pb-95">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="product-details-img">
                    <img class="zoompro" src="assets/img/product/<?php echo $currentProduct->photo ?>" data-zoom-image="assets/img/product-details/product-detalis-bl1.jpg" alt="zoom" />
                    <div id="gallery" class="mt-20 product-dec-slider owl-carousel">
                        <a data-image="assets/img/product/<?php echo $currentProduct->photo ?>" data-zoom-image="assets/img/product/<?php echo $currentProduct->photo ?>">
                            <img src="assets/img/product/<?php echo $currentProduct->photo ?>" alt="">
                        </a>
                    </div>
                    <!-- <span>-29%</span> -->
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="product-details-content">
                    <h4><?php echo $currentProduct->name ?></h4>
                    <div class="rating-review">
                        <div class="pro-dec-rating">
                            <?php
                            for ($i = 0; $i < $currentProduct->avg_rating; $i++) {
                                echo '<i class="ion-android-star-outline theme-star"></i>';
                            }
                            for ($i = 0; $i < (5 - $currentProduct->avg_rating); $i++) {
                                echo '<i class="ion-android-star-outline"></i>';
                            }

                            ?>
                        </div>
                        <div class="pro-dec-review">
                            <ul>
                                <li><?php echo $currentProduct->reviews_count ?> Reviews </li>
                                <!-- <li> Add Your Reviews</li> -->
                            </ul>
                        </div>
                    </div>
                    <span><?php echo $currentProduct->price ?> EGP</span>
                    <div class="in-stock">
                        <p>Available: <span>In stock</span></p>
                    </div>
                    <p>
                        <?php
                        $wordsCount = 25;
                        $detailsArray = str_word_count($currentProduct->detail, 1);
                        array_splice($detailsArray, $wordsCount, count($detailsArray));
                        $detailsString = implode(" ", $detailsArray);
                        echo $detailsString . '...';
                        ?>
                    </p>
                    <div class="pro-dec-feature">
                        <ul>
                            <li><input type="checkbox"> Protection Plan: <span> 2 year $4.99</span></li>
                            <li><input type="checkbox"> Remote Holder: <span> $9.99</span></li>
                            <li><input type="checkbox"> Koral Alexa Voice Remote Case: <span> Red $16.99</span></li>
                            <li><input type="checkbox"> Amazon Basics HD Antenna: <span>25 Mile $14.99</span></li>
                        </ul>
                    </div>
                    <div class="quality-add-to-cart">
                        <div class="quality">
                            <label>Qty:</label>
                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="02">
                        </div>
                        <div class="shop-list-cart-wishlist">
                            <a title="Add To Cart" href="#">
                                <i class="icon-handbag"></i>
                            </a>
                            <a title="Wishlist" href="#">
                                <i class="icon-heart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="pro-dec-categories">
                        <ul>
                            <li class="categories-title">Categories:</li>
                            <li><a href="#">Green,</a></li>
                            <li><a href="#">Herbal, </a></li>
                            <li><a href="#">Loose,</a></li>
                            <li><a href="#">Mate,</a></li>
                            <li><a href="#">Organic </a></li>
                        </ul>
                    </div>
                    <div class="pro-dec-categories">
                        <ul>
                            <li class="categories-title">Tags: </li>
                            <li><a href="#"> Oolong, </a></li>
                            <li><a href="#"> Pu'erh,</a></li>
                            <li><a href="#"> Dark,</a></li>
                            <li><a href="#"> Special </a></li>
                        </ul>
                    </div>
                    <div class="pro-dec-social">
                        <ul>
                            <li><a class="tweet" href="#"><i class="ion-social-twitter"></i> Tweet</a></li>
                            <li><a class="share" href="#"><i class="ion-social-facebook"></i> Share</a></li>
                            <li><a class="google" href="#"><i class="ion-social-googleplus-outline"></i> Google+</a></li>
                            <li><a class="pinterest" href="#"><i class="ion-social-pinterest"></i> Pinterest</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Deatils Area End -->
<div class="description-review-area pb-70">
    <div class="container">
        <div class="description-review-wrapper">
            <div class="description-review-topbar nav text-center">
                <a class="active" data-toggle="tab" href="#des-details1">Description</a>
                <a data-toggle="tab" href="#des-details2">Tags</a>
                <a data-toggle="tab" href="#des-details3">Review</a>
            </div>
            <div class="tab-content description-review-bottom">
                <div id="des-details1" class="tab-pane active">
                    <div class="product-description-wrapper">
                        <p><?php echo $currentProduct->detail ?></p>
                    </div>
                </div>
                <div id="des-details2" class="tab-pane">
                    <div class="product-anotherinfo-wrapper">
                        <ul>
                            <li><span>Tags:</span></li>
                            <li><a href="#"> Green,</a></li>
                            <li><a href="#"> Herbal,</a></li>
                            <li><a href="#"> Loose,</a></li>
                            <li><a href="#"> Mate,</a></li>
                            <li><a href="#"> Organic ,</a></li>
                            <li><a href="#"> special</a></li>
                        </ul>
                    </div>
                </div>
                <div id="des-details3" class="tab-pane">
                    <div class="rattings-wrapper">
                        <?php
                        $result2 = $product->getReviewsByProductId();
                        if (!empty($result2)) {
                            $reviews = $result2->fetch_all(MYSQLI_ASSOC);
                            foreach ($reviews as $value) {
                        ?>
                                <div class="sin-rattings">
                                    <div class="star-author-all">
                                        <div class="ratting-star f-left">
                                            <?php
                                            for ($i = 0; $i < $value['value']; $i++) {
                                                echo '<i class="ion-star theme-color"></i>';
                                            }
                                            for ($i = 0; $i < (5 - $value['value']); $i++) {
                                                echo '<i class="ion-android-star-outline"></i>';
                                            }
                                            ?>

                                            <span>(<?php echo $value['value'] ?>)</span>
                                        </div>

                                        <div class="ratting-author f-right">
                                            <h3><?php
                                                $user = new User();
                                                $user->setId($value['user_id']);
                                                $result3 = $user->getUserById();
                                                if (!empty($result3)) {
                                                    $currentUser = $result3->fetch_object();
                                                    echo $currentUser->name;
                                                } else {
                                                    echo 'User Name';
                                                }
                                                ?></h3>
                                            
                                            <!-- Convert time stamp which returned from database to readable date and time -->
                                            <span>
                                            <?php 
                                                $timestamp = strtotime($value['created_at']);
                                                echo date("g:i a", $timestamp);
                                            ?>
                                            </span>

                                            <span>
                                            <?php 
                                                $timestamp = strtotime($value['created_at']);
                                                echo date("d  M  Y", $timestamp);
                                            ?>
                                            </span>
                                        </div>
                                    </div>
                                    <p><?php echo $value['comment'] ?></p>
                                </div>
                        <?php
                            }
                        } else {
                            echo '<div class="alert alert-warning">No reviews yet for this product!</div>';
                        }
                        ?>

                    </div>
                    <div class="ratting-form-wrapper">
                        <h3>Add your Comments :</h3>
                        <div class="ratting-form">
                            <form action="#">
                                <div class="star-box">
                                    <h2>Rating:</h2>
                                    <div class="ratting-star">
                                        <i class="ion-star theme-color"></i>
                                        <i class="ion-star theme-color"></i>
                                        <i class="ion-star theme-color"></i>
                                        <i class="ion-star theme-color"></i>
                                        <i class="ion-star"></i>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="rating-form-style mb-20">
                                            <input placeholder="Name" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="rating-form-style mb-20">
                                            <input placeholder="Email" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="rating-form-style form-submit">
                                            <textarea name="message" placeholder="Message"></textarea>
                                            <input type="submit" value="add review">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="product-area pb-100">
    <div class="container">
        <div class="product-top-bar section-border mb-35">
            <div class="section-title-wrap">
                <h3 class="section-title section-bg-white">Related Products</h3>
            </div>
        </div>
        <div class="row">
            <?php
            $product2 = new Product();
            $product2->setSubcatId($currentProduct->subcat_id);
            $res = $product2->selectProductsBySubcatId();
            if (!empty($res)) {
                $relatedProducts = $res->fetch_all(MYSQLI_ASSOC);
                foreach ($relatedProducts as $val) {
                    if($val['id'] == $currentProduct->id){
                        continue;
                    }
            ?>
                    <div class="col-3">
                        <div class="product-wrapper">
                            <div class="product-img">
                                <a href="product-details.php?id=<?php echo $val['id']?>">
                                    <img alt="" src="assets/img/product/<?php echo $val['photo']?>">
                                </a>
                                <!-- <span>-30%</span> -->
                                <div class="product-action">
                                    <a class="action-wishlist" href="#" title="Wishlist">
                                        <i class="ion-android-favorite-outline"></i>
                                    </a>
                                    <a class="action-cart" href="#" title="Add To Cart">
                                        <i class="ion-ios-shuffle-strong"></i>
                                    </a>
                                    <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                        <i class="ion-ios-search-strong"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-content text-left">
                                <div class="product-hover-style">
                                    <div class="product-title">
                                        <h4>
                                            <a href="product-details.php"><?php echo $val['name']?></a>
                                        </h4>
                                    </div>
                                    <div class="cart-hover">
                                        <h4><a href="product-details.php">+ Add to cart</a></h4>
                                    </div>
                                </div>
                                <div class="product-price-wrapper">
                                    <span><?php echo $val['price']?> EGP </span>
                                    <span class="product-price-old"><?php echo $val['price']?> EGP </span>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }

            ?>

        </div>

    </div>
</div>
<?php include_once 'footer.php'; ?>