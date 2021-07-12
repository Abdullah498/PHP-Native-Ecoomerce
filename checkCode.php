<?php 

    include_once 'header.php';
?>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
            <div class="container">
                <div class="breadcrumb-content text-center">
					<h3>Check Code</h3>
                    <ul>
                        <li class="active">Login</li>
                    </ul>
                </div>
            </div>
        </div>
		<!-- Breadcrumb Area End -->
<div class="container m-auto col-4 py-5">
    <?php
        include_once 'User.php';
        if(!empty($_GET) && isset($_GET['email'])){
            
            $user = new User();
            $user->setEmail($_GET['email']);
        }else{
            header('Location: 404.php');
        }

        
        if(!empty($_POST) && isset($_POST['sended_code'])){
            $user->setCode($_POST['sended_code']);
            $result = $user->checkCode();
            
            if(!empty($result)){
                //if user forget password:
                if(isset($_GET['forget']) && $_GET['forget']==TRUE){
                    header('Location: change_password.php?email='.$user->getEmail());
                    die;
                }

                $userData = $result->fetch_object();
                $user->setStatus(1);
                $result2 = $user->updateStatus();
                if($result2){
                    $_SESSION['user'] = $userData;
                    header('Location: index.php');
                }else{
                    $errors['wrong'] ="<div class='alert alert-danger'>Somthing went wrong!</div>";    
                }
            }else{
                $errors['code'] ="<div class='alert alert-danger'>Wrong Code!</div>";
            }
        }
    ?>
    <form method="post">
    <div class="form-group">
        <label for="exampleInputEmail1">Enter Verification Code :</label>
        <input type="text" name="sended_code" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <button type="submit" class="btn btn-primary">Verify</button>
    <?php echo(isset($errors['code'])? $errors['code']:'');?>
    <?php echo(isset($errors['wrong'])? $errors['wrong']:'');?>
    </form>
</div>



<?php include_once 'footer.php';?>