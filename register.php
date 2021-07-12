        <?php 
        include_once 'header.php';
        if(isset($_SESSION['user'])){
            header('Location: index.php');
        }
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
					<h3>Register</h3>
                    <ul>
                        <li class="active">Register</li>
                    </ul>
                </div>
            </div>
        </div>
		<!-- Breadcrumb Area End -->
        <div class="login-register-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                
                                <a data-toggle="tab" class ="active" href="#lg2">
                                    <h4> register </h4>
                                </a>
                            </div>
                            <div class="tab-content">
                                </div>
                                <div id="lg2" class="tab-pane">
                                    <div class="login-form-container">
                                        <div class="login-register-form">

                                        <?php
                                                $errors = [];   
                                                $passwordPattern = '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/';
                                                if(!empty($_POST)){
                                                    if(!preg_match($passwordPattern , $_POST['password'])){
                                                        $errors['password'] ="<div class='alert alert-warning'>Minimum eight characters, at least one letter, one number and one special character:</div>";
                                                    }
                                                    if($_POST['password'] != $_POST['password_confirm']){
                                                        $errors['password_confirm'] = "<div class='alert alert-warning'>Password doesn't match</div>";
                                                    }  
                                                    if(empty($errors)){
                                                        include_once 'User.php';
                                                        $user = new User();
                                                        $user->setName($_POST['name']);
                                                        $user->setPhone($_POST['phone']);
                                                        $user->setPassword($_POST['password']);
                                                        $user->setGender($_POST['gender']);
                                                        $user->setEmail($_POST['email']);
                                                        $user->setCode(rand(10000,99999));
                                                        $result = $user->insertData();

                                                        if($result){
                                                           //sending verivication code
                                                           
                                                            // Instantiation and passing `true` enables exceptions
                                                            $mail = new PHPMailer(true);

                                                            try {
                                                                //Server settings
                                                                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                                                                $mail->isSMTP();                                            // Send using SMTP
                                                                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                                                                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                                                                $mail->Username   = 'ntiecommerce585@gmail.com';                     // SMTP username
                                                                $mail->Password   = 'NTI@123456';                               // SMTP password
                                                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                                                                $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                                                                //Recipients
                                                                $mail->setFrom('ntiecommerce585@gmail.com', 'NTI Ecommerce');
                                                                $mail->addAddress($user->getEmail(), $user->getName());     // Add a recipient
                                                 
                                                                // Content
                                                                $mail->isHTML(true);                                  // Set email format to HTML
                                                                $mail->Subject = 'Verification Code';
                                                                $mail->Body    = 'This is your Verification Code : <b>'.$user->getCode().'</b>';
                                                                

                                                                $mail->send();

                                                                header('Location: checkCode.php?email='.$user->getEmail());
                                                                //echo 'Message has been sent';
                                                            } catch (Exception $e) {
                                                                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                                            }
                                                        }else{
                                                            $errors['wrong'] =  "<div class='alert alert-danger'>Somthing went wrong</div>";
                                                        }
                                                    }
                                                }
                                            ?>


                                            <form method="post">
                                                <input type="text" name="name" placeholder="Username" value="<?php echo(isset($_POST['name'])?$_POST['name']:'');?>">
                                                <input type="password" name="password" placeholder="Password" value="<?php echo(isset($_POST['password'])?$_POST['password']:'');?>">
                                                <?php echo(isset($errors['password'])?$errors['password']:'');?>
                                                <input type="password" name="password_confirm" placeholder="Confirm Password" value="<?php echo(isset($_POST['password_confirm'])?$_POST['password_confirm']:'');?>">
                                                <?php echo(isset($errors['password_confirm'])?$errors['password_confirm']:'');?>
                                                <input name="email" placeholder="Email" type="email" value="<?php echo(isset($_POST['email'])?$_POST['email']:'');?>">
                                                <input name="phone" placeholder="phone" type="phone" value="<?php echo(isset($_POST['phone'])?$_POST['phone']:'');?>">
                                                <label for="exampleFormControlSelect1">Gender</label>
                                                <select name="gender" class="form-control" id="exampleFormControlSelect1">
                                                    <option <?php echo(isset($_POST['gender'])&& $_POST['gender']=='m'? 'selected':'');?> value = "m">Male</option>
                                                    <option <?php echo(isset($_POST['gender'])&& $_POST['gender']=='f'? 'selected':'');?> value = "f">Female</option>
                                                </select>
                                                <div class="button-box mt-5">
                                                    <button type="submit"><span>Register</span></button>
                                                </div>
                                                <?php echo(isset($errors['wrong'])?$errors['wrong']:'');?>
                                            </form>

                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include_once 'footer.php'?>