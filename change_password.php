<?php
include_once 'header.php';

include_once 'User.php';
?>

<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>Change Password</h3>
            <ul>
                <li class="active">Login</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->

<?php
    $errors = [];
    if(!empty($_GET) && isset($_GET['email'])){
        $user =new User();
        $user->setEmail($_GET['email']);
        $result = $user->checkEmail();
        if(!empty($result)){

            $user_data = $result->fetch_object();
        
            if(isset($_POST['new_password']) && isset($_POST['password_confirm'])){

                $passwordPattern = '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/';
                if(!preg_match($passwordPattern , $_POST['new_password'])){
                    $errors['invalid_password'] ="<div class='alert alert-warning'>Minimum eight characters, at least one letter, one number and one special character:</div>";
                }
                if($_POST['new_password'] != $_POST['password_confirm']){
                    $errors['password_confirm'] = "<div class='alert alert-warning'>Password doesn't match</div>";
                }
                
                $user->setId($user_data->id);
                $user->setPassword($_POST['new_password']);
                
                $exist_password = ($user_data->password == $user->getPassword());
                if($exist_password)
                    $errors['exist_password'] = "<div class='alert alert-warning'>Password already exsit!</div>";


                if(empty($errors) && !$exist_password){
                    $result2 = $user->updatePassword();
                    if($result2){
                        $_SESSION['user'] = $user_data;
                        header('location: index.php');die;
                    }else{
                        $errors['server'] = "<div class='alert alert-danger'>Somthing went wrong!</div>";
                    }
                }    
            }
        }

        else{
            $errors['invalid_email'] = "<div class='alert alert-danger'>Email doesn't exsit!</div>";
        }

    }else{
        header('location: 404.php');die;
    }
    
?>
<div class="container py-5 col-4 m-auto">
    <?php echo(isset($errors['server'])?$errors['server']:'');?>
    <form method="POST">
    <div class="form-group">
        <label for="exampleInputEmail1">Enter New Password :</label>
        <input type="password" name="new_password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <?php echo(isset($errors['invalid_password'])?$errors['invalid_password']:'');?>
    <div class="form-group">
        <label for="exampleInputEmail1">Confirm Password :</label>
        <input type="password" name="password_confirm" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <?php echo(isset($errors['password_confirm'])?$errors['password_confirm']:'');?>
    <button type="submit" class="btn btn-primary">Submit</button>

    </form>
    <?php echo(isset($errors['exist_password'])?$errors['exist_password']:'');?>
    
    <?php echo(isset($errors['invalid_email'])?$errors['invalid_email']:'');?>
</div>
<?php include_once 'footer.php';?>