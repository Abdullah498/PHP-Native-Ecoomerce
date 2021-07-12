<?php
include_once 'header.php';
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
include_once 'User.php';
?>

<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>Forget Password</h3>
            <ul>
                <li class="active">Login</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<?php
if (isset($_POST['email']) && $_POST['email']) {
    $errors = [];

    $user = new User();
    $user->setEmail($_POST['email']);
    $result = $user->checkEmail();
    if (!empty($result)) {
        $user->setEmail($_POST['email']);
        $code = rand(10000, 99999);
        $user->setCode($code);

        $user->updateCode();
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
            $mail->addAddress($user->getEmail());     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Verification Code';
            $mail->Body    = 'This is your Verification Code : <b>' . $user->getCode() . '</b>';


            $mail->send();

            header('Location: checkCode.php?email=' . $user->getEmail() . '&forget=TRUE');
            //echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $errors['invalid_email'] = "<div class='alert alert-danger'>Email doesn't exsit!</div>";
    }
}
?>
<div class="container py-5 col-4 m-auto">
    <form method="POST">
    <div class="form-group">
        <label for="exampleInputEmail1">Enter your Email :</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <button type="submit" class="btn btn-primary">Send Code</button>

    </form>
    <?php echo(isset($errors['invalid_email'])?$errors['invalid_email']:'');?>
</div>
<?php include_once 'footer.php'; ?>