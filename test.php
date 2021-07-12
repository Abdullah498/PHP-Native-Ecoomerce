<?php include_once 'header.php';
include_once 'User.php';
include_once 'City.php';
include_once 'Region.php';
include_once 'Address.php';

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
?>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>MY ACCOUNT</h3>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">My Account</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<!-- my account start -->
<div class="checkout-area pb-80 pt-100">
    <div class="container">
        <div class="row">
            <div class="ml-auto mr-auto col-lg-9">
                <div class="checkout-wrapper">
                    <div id="faq" class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>1</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-1">Edit your account information </a></h5>
                            </div>
                            <div id="my-account-1" class="panel-collapse collapse <?php echo (isset($_POST['general_info']) ? 'show' : '') ?>">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>My Account Information</h4>
                                            <h5>Your Personal Details</h5>
                                        </div>

                                        <?php

                                        if (isset($_POST['general_info'])) {
                                            $errors = [];
                                            $success = [];

                                            $user = new User();

                                            $user->setId($_SESSION['user']->id);
                                            if (!empty(trim($_POST['name']))) {
                                                $user->setName($_POST['name']);
                                            }

                                            if (!empty(trim($_POST['phone']))) {
                                                $user->setPhone($_POST['phone']);
                                            }
                                            if (!empty(trim($_POST['gender']))) {
                                                $user->setgender($_POST['gender']);
                                            }

                                            if ($_FILES['photo']['name']) {

                                                $directory = 'uploads/users/';
                                                $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                                                $imageName = time() . '.' . $extension;
                                                $fullPath = $directory . $imageName;

                                                if ($_FILES['photo']['size'] > 1000000) {
                                                    $errors['size'] = "<div class='alert alert-danger'>maximum available size is 1 MG!</div>";
                                                }

                                                $extensionsArray = ['png', 'jpg', 'jpeg'];
                                                if (!in_array($extension, $extensionsArray)) {
                                                    $errors['extension'] = "<div class='alert alert-danger'> Only available extensions are png,jpg,jpeg </div>";
                                                }

                                                if (!isset($errors['size']) && !isset($errors['extension'])) {
                                                    move_uploaded_file($_FILES['photo']['tmp_name'], $fullPath);
                                                    $user->setPhoto($imageName);
                                                }
                                            }

                                            $result = $user->updateProfile();

                                            if ($result && (!isset($errors['size']) && !isset($errors['extension']))) {
                                                $_SESSION['user']->gender = $_POST['gender'];
                                                $_SESSION['user']->name = $_POST['name'];
                                                $_SESSION['user']->phone = $_POST['phone'];
                                                if ($_FILES['photo']['name']) {
                                                    $_SESSION['user']->photo = $user->getPhoto();
                                                }

                                                $success['upload'] = "<div class='alert alert-success'>Your data is updated</div>";
                                            } else {
                                                $errors['server'] = "<div class='alert alert-danger'>something went wrong!</div>";
                                            }
                                        }
                                        ?>
                                        <form method="post" enctype="multipart/form-data">
                                            <div>
                                                <?php echo (isset($success['upload']) ? $success['upload'] : ''); ?>
                                                <?php echo (isset($errors['server']) ? $errors['server'] : ''); ?>
                                                <div class="row">

                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <img class="img-fluid" src="uploads/users/<?php echo $_SESSION['user']->photo; ?>">
                                                                <input type="file" name="photo">
                                                            </div>
                                                        </div>
                                                        <?php echo (isset($errors['size']) ? $errors['size'] : ''); ?>
                                                        <?php echo (isset($errors['extension']) ? $errors['extension'] : ''); ?>
                                                    </div>

                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="billing-info">
                                                            <label>Full Name</label>
                                                            <input type="text" name="name" value="<?php echo (isset($_SESSION['user']) ? $_SESSION['user']->name : '') ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Telephone</label>
                                                            <input type="phone" name="phone" value="<?php echo (isset($_SESSION['user']) ? $_SESSION['user']->phone : '') ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="billing-info">
                                                            <label>Gender</label>
                                                            <select name="gender">
                                                                <option <?php echo ($_SESSION['user']->gender == 'm' ? 'selected' : '') ?> value='m'>Male</option>
                                                                <option <?php echo ($_SESSION['user']->gender == 'f' ? 'selected' : '') ?> value='f'>Female</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="billing-back-btn">
                                                    <div class="billing-btn">
                                                        <button name="general_info">Continue</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>2</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-2">Change your password </a></h5>
                            </div>
                            <div id="my-account-2" class="panel-collapse collapse <?php echo (isset($_POST['update_password']) ? 'show' : '') ?>">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Change Password</h4>
                                            <h5>Your Password</h5>
                                        </div>
                                        <?php

                                        if (isset($_POST['update_password']) && $_POST['old_password'] && $_POST['new_password'] && $_POST['confirm_password']) {
                                            $errors = [];
                                            $success = [];

                                            $user = new User();
                                            $user->setId($_SESSION['user']->id);

                                            $user->setPassword($_POST['old_password']);

                                            if ($user->getPassword() != $_SESSION['user']->password) {
                                                $errors['old_password'] = "<div class='alert alert-danger'>uncorrect password!</div>";
                                            }
                                            if ($_POST['new_password'] != $_POST['confirm_password']) {
                                                $errors['matching'] = "<div class='alert alert-danger'>password dosen't match!</div>";
                                            }
                                            $passwordPattern = '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/';
                                            if (!preg_match($passwordPattern, $_POST['new_password'])) {
                                                $errors['password'] = "<div class='alert alert-warning'>Minimum eight characters, at least one letter, one number and one special character:</div>";
                                            }
                                            $user->setPassword($_POST['new_password']);
                                            if ($user->getPassword() == $_SESSION['user']->password) {
                                                $errors['same_password'] = "<div class='alert alert-warning'>you can't set same password enter a new one</div>";
                                            };
                                            if (empty($errors)) {
                                                $user->setPassword($_POST['new_password']);
                                                $result = $user->updatePassword();

                                                if ($result) {
                                                    $success['password'] = "<div class='alert alert-success'>your password is successfully updated</div>";
                                                    $_SESSION['user']->password = $user->getPassword();
                                                } else {
                                                    $errors['server'] = "<div class='alert alert-danger'>something went wrong!</div>";
                                                }
                                            }
                                        }
                                        ?>
                                        <form method="post">
                                            <div class="row">
                                                <?php echo (isset($errors['server']) ? $errors['server'] : ''); ?>
                                                <?php echo (isset($success['password']) ? $success['password'] : ''); ?>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Old Password</label>
                                                        <input type="password" name="old_password">
                                                    </div>
                                                    <?php echo (isset($errors['old_password']) ? $errors['old_password'] : ''); ?>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>New Password</label>
                                                        <input type="password" name="new_password">
                                                    </div>
                                                    <?php echo (isset($errors['password']) ? $errors['password'] : ''); ?>
                                                    <?php echo (isset($errors['same_password']) ? $errors['same_password'] : ''); ?>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Password Confirm</label>
                                                        <input type="password" name="confirm_password">
                                                    </div>
                                                    <?php echo (isset($errors['matching']) ? $errors['matching'] : ''); ?>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">
                                                <div class="billing-back">
                                                    <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                                </div>
                                                <div class="billing-btn">
                                                    <button name="update_password">Continue</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ************************************************************************* -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>3</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-3">Change your Email </a></h5>
                            </div>
                            <div id="my-account-3" class="panel-collapse collapse <?php echo (isset($_POST['update_email']) ? 'show' : '') ?>">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Change Email</h4>
                                            <h5>Your Email</h5>
                                        </div>
                                        <?php
                                        if (isset($_POST['update_email']) && $_POST['new_email']) {
                                            $errors = [];

                                            if ($_POST['new_email'] == $_SESSION['user']->email) {
                                                $errors['same_email'] = "<div class='alert alert-warning'>email doesn't change!</div>";
                                            }
                                            if (empty($errors)) {
                                                $user = new User();
                                                $user->setId($_SESSION['user']->id);
                                                $user->setEmail($_POST['new_email']);
                                                $user->setStatus(2);
                                                $code = rand(10000, 99999);
                                                $user->setCode($code);

                                                $result = $user->updateEmail();
                                                if ($result) {
                                                    $_SESSION['user']->email = $user->getEmail();
                                                    $_SESSION['user']->status = $user->getStatus();

                                                    $mail = new PHPMailer(true);

                                                    try {
                                                        //Server settings
                                                        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                                                        $mail->isSMTP();                                            // Send using SMTP
                                                        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                                                        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                                                        $mail->Username   = 'ntiecommerce585@gmail.com';                     // SMTP username
                                                        $mail->Password   = 'NTI@123456';                               // SMTP password
                                                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                                                        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                                                        //Recipients
                                                        $mail->setFrom('ntiecommerce585@gmail.com', 'NTI Ecoomerce');
                                                        $mail->addAddress($user->getEmail());     // Add a recipient

                                                        // Content
                                                        $mail->isHTML(true);                                  // Set email format to HTML
                                                        $mail->Subject = 'Verfication Code';
                                                        $mail->Body    = "Your verification code: <b>" . $user->getCode() . "</b>";

                                                        $mail->send();
                                                        header('Location:checkCode.php?email=' . $user->getEmail());
                                                        // echo 'Message has been sent';
                                                    } catch (Exception $e) {
                                                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                                    }
                                                } else {
                                                    $errors['server'] = "<div class='alert alert-danger'>something went wrong!</div>";
                                                }
                                            }
                                        }
                                        ?>
                                        <form method="post">
                                            <div class="row">
                                                <?php echo (isset($errors['server']) ? $errors['server'] : ''); ?>

                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>New Email</label>
                                                        <input type="email" name="new_email" value="<?php echo (isset($_SESSION['user']) ? $_SESSION['user']->email : ''); ?>">
                                                    </div>
                                                </div>
                                                <?php echo (isset($errors['same_email']) ? $errors['same_email'] : ''); ?>
                                            </div>
                                            <div class="billing-back-btn">
                                                <div class="billing-back">
                                                    <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                                </div>
                                                <div class="billing-btn">
                                                    <button name="update_email">Continue</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ***************************************************************************** -->
                        <div class="panel panel-default">

                            <?php
                            $success = [];
                            $errors1 = [];
                            if (isset($_POST['add_address']) && $_POST['street'] && $_POST['building'] && $_POST['flat'] && $_POST['floor'] && $_POST['detail'] && $_POST['region']) {
                                

                                $address = new Address();
                                $address->setStreet($_POST['street']);
                                $address->setBuilding($_POST['building']);
                                $address->setFlat($_POST['flat']);
                                $address->setFloor($_POST['floor']);
                                $address->setDetail($_POST['detail']);
                                $address->setRegionId($_POST['region']);
                                $address->setUserId($_SESSION['user']->id);

                                $response = $address->insertData();

                                if (!$response) {

                                    $success['address'] = "<div class='alert alert-success'>Your address is added</div>";
                                } else {
                                   
                                    $errors1['server'] = "<div class='alert alert-danger'>something went wrong!</div>";
                                }
                            }

                            ?>
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>4</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-4">Modify your address book entries </a></h5>
                            </div>
                            <div id="my-account-4" class="panel-collapse collapse <?php echo ((isset($_POST['add_address']) ||  isset($_POST['edit_address']) ||  isset($_POST['delete_address'])) ? 'show' : '') ?>">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Address Book Entries</h4>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 d-flex align-items-center justify-content-center">
                                                <div class="container">

                                                    <form method="post">
                                                        <?php echo (isset($errors1['server']) ? $errors1['server'] : ''); ?>
                                                        <?php echo (isset($success['address']) ? $success['address'] : ''); ?>
                                                        <div class="form-group">
                                                            <label for="inputAddress">Street</label>
                                                            <input type="text" name="street" class="form-control" id="inputAddress">
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="inputEmail4">Building</label>
                                                                <input type="number" name="building" class="form-control" id="inputEmail4">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="inputPassword4">Flat</label>
                                                                <input type="number" name="flat" class="form-control" id="inputPassword4">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="inputAddress2">Floor</label>
                                                            <input type="text" name="floor" class="form-control" id="inputAddress2">
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="inputState">Details</label>
                                                                <textarea name="detail" id="" cols="30" rows="10">

                                                            </textarea>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="inputState">Regions</label>
                                                                <select id="inputState" name="region" class="form-control">
                                                                    <?php
                                                                    $city = new City();
                                                                    $result = $city->selectData();

                                                                    if (!empty($result)) {
                                                                        $cities = $result->fetch_all(MYSQLI_ASSOC);

                                                                        foreach ($cities as $key => $value) {
                                                                    ?>
                                                                            <optgroup label="<?php echo $value['name'] ?>">
                                                                                <?php
                                                                                $region = new Region();
                                                                                $region->setCityId($value['id']);
                                                                                $result2 = $region->selectRegionsByCityId();
                                                                                if (!empty($result2)) {
                                                                                    $regions = $result2->fetch_all(MYSQLI_ASSOC);
                                                                                    foreach ($regions as $key1 => $value1) {
                                                                                ?>
                                                                                        <option value="<?php echo $value1['id']; ?>"><?php echo $value1['name']; ?></option>
                                                                                <?php
                                                                                    }
                                                                                }
                                                                                ?>

                                                                            </optgroup>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <button name="add_address" class=" form-group btn btn-primary my-2 m-auto">Add Address</button>

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        <hr style="width:100%; height:5px; color:black">
                                        <div class="account-info-wrapper">
                                            <h4>Your Addresses</h4>
                                        </div>
                                        <!-- Upadte and delete Addresses -->
                                        <?php
                                        $user_address = new Address();
                                        $user_address->setUserId($_SESSION['user']->id);
                                        $result = $user_address->getAddressesByUserId();
                                        if (!empty($result)) {
                                            $allAdresses = $result->fetch_all(MYSQLI_ASSOC);
                                            foreach ($allAdresses as $key => $value) {
                                        ?>
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                        <div class="container">
                                                            <?php
                                                            if (isset($_POST['edit_address' . $value['id']]) && $_POST['street'] && $_POST['building'] && $_POST['flat'] && $_POST['floor'] && $_POST['detail'] && $_POST['region']) {
                                                                $success = [];
                                                                $errors = [];

                                                                $address = new Address();
                                                                $address->setStreet($_POST['street']);
                                                                $address->setBuilding($_POST['building']);
                                                                $address->setFlat($_POST['flat']);
                                                                $address->setFloor($_POST['floor']);
                                                                $address->setDetail($_POST['detail']);
                                                                $address->setRegionId($_POST['region']);
                                                                $address->setUserId($_SESSION['user']->id);

                                                                $address->setId($value['id']);

                                                                $result = $address->editAddress();

                                                                if ($result) {

                                                                    $success['address' . $value['id']] = "<div class='alert alert-success'>Your address is edited</div>";
                                                                } else {
                                                                    $errors['server' . $value['id']] = "<div class='alert alert-danger'>something went wrong!</div>";
                                                                }
                                                            }
                                                            if (isset($_POST['delete_address' . $value['id']])) {
                                                                $success = [];
                                                                $errors = [];
                                                                $address = new Address();
                                                                $address->setId($value['id']);
                                                                $res = $address->deleteAddress();
                                                                if ($res) {
                                                                    $success['address' . $value['id']] = "<div class='alert alert-success'>Your address is deleted</div>";
                                                                } else {
                                                                    $errors['server' . $value['id']] = "<div class='alert alert-danger'>something went wrong!</div>";
                                                                }
                                                            }

                                                            ?>
                                                            <form method="post">
                                                                <?php echo (isset($errors['server' . $value['id']]) ? $errors['server' . $value['id']] : ''); ?>
                                                                <?php echo (isset($success['address' . $value['id']]) ? $success['address' . $value['id']] : ''); ?>
                                                                <div class="form-group">
                                                                    <label for="inputAddress">Street</label>
                                                                    <input type="text" name="street" class="form-control" id="inputAddress" value="<?php echo $value['street'] ?>">
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputEmail4">Building</label>
                                                                        <input type="number" name="building" class="form-control" id="inputEmail4" value="<?php echo $value['building'] ?>">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputPassword4">Flat</label>
                                                                        <input type="number" name="flat" class="form-control" id="inputPassword4" value="<?php echo $value['flat'] ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="inputAddress2">Floor</label>
                                                                    <input type="text" name="floor" class="form-control" id="inputAddress2" value="<?php echo $value['floor'] ?>">
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputState">Details</label>
                                                                        <textarea name="detail" id="" cols="30" rows="10">
                                                                    <?php echo $value['detail'] ?>
                                                                </textarea>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="inputState">Regions</label>
                                                                        <select id="inputState" name="region" class="form-control">
                                                                            <?php
                                                                            $city = new City();
                                                                            $result3 = $city->selectData();

                                                                            if (!empty($result3)) {
                                                                                $cities = $result3->fetch_all(MYSQLI_ASSOC);

                                                                                foreach ($cities as $key2 => $value2) {
                                                                            ?>
                                                                                    <optgroup label="<?php echo $value2['name'] ?>">
                                                                                        <?php
                                                                                        $region = new Region();
                                                                                        $region->setCityId($value2['id']);
                                                                                        $result2 = $region->selectRegionsByCityId();
                                                                                        if (!empty($result2)) {
                                                                                            $regions = $result2->fetch_all(MYSQLI_ASSOC);
                                                                                            foreach ($regions as $key1 => $value3) {
                                                                                        ?>
                                                                                                <option <?php echo (($value3['id'] == $value['region_id']) ? 'selested' : ''); ?> value="<?php echo $value3['id'] ?>"><?php echo $value3['name']; ?></option>
                                                                                        <?php
                                                                                            }
                                                                                        }
                                                                                        ?>

                                                                                    </optgroup>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>

                                                                        </select>
                                                                    </div>
                                                                </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                        <div class="entries-edit-delete text-center">
                                                            <button name="<?php echo 'edit_address' . $value['id'] ?>" class=" form-group btn btn-warning my-2 m-auto">Edit</button>
                                                            <button name="<?php echo 'delete_address' . $value['id'] ?>" class=" form-group btn btn-danger my-2 m-auto">Delete</button>

                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                        <?php
                                            }
                                        } else {
                                        }

                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>4</span> <a href="wishlist.html">Modify your wish list </a></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end----------------------------------- -->
            </div>
        </div>
    </div>
</div>



<!-- my account end -->
<?php include_once 'footer.php' ?>