<?php
session_start();
error_reporting(0);
require_once('include/config.php');

$msg = "";

if(isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = md5($_POST['password']);
    
    if($email != "" && $password != "") {
        try {
            $query = "SELECT id, EmpId, fname, lname, department_name, email, mobile, country, state, city, address, photo, dob, date_of_joining, password, role FROM tblemployee WHERE email=:email AND password=:password";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam('email', $email, PDO::PARAM_STR);
            $stmt->bindValue('password', $password, PDO::PARAM_STR);
            $stmt->execute();
            
            $count = $stmt->rowCount();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($count == 1 && !empty($row)) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['Empid'] = $row['EmpId'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['fname'];
                
                if($row['role'] == 'admin') {
                    header("location: admin/dashboard.php"); // Redirect to admin dashboard
                } else {
                    header("location: emp/dashboard.php"); // Redirect to employee dashboard
                }
            } else {
                $msg = "Invalid username and password!";
            }
        } catch (PDOException $e) {
            echo "Error : ".$e->getMessage();
        }
    } else {
        $msg = "Both fields are required!";
    }
}

//Forgot Password
if(isset($_POST['reset'])){
    $empid=$_POST['empid'];
    $mobile=$_POST['fmobno'];
    $newpassword=md5($_POST['newpwd']);
    $sql ="SELECT EmpId FROM tblemployee WHERE EmpId=:empid and mobile=:mobile";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':empid', $empid, PDO::PARAM_STR);
    $query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query-> execute();
    $results = $query -> fetchAll(PDO::FETCH_OBJ);
    if($query -> rowCount() > 0){
      $con="update tblemployee set password=:newpassword where EmpId=:empid and mobile=:mobile";
      $chngpwd1 = $dbh->prepare($con);
      $chngpwd1-> bindParam(':empid', $empid, PDO::PARAM_STR);
      $chngpwd1-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
      $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
      $chngpwd1->execute();
      echo "<script>alert('Your Password succesfully changed');</script>";
    }
    else {
      echo "<script>alert('Email id or Mobile no is invalid');</script>"; 
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Montserrat', sans-serif;
}

body{
    background-color: #c9d6ff;
    background: linear-gradient(to right, #e2e2e2, #c9d6ff);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    height: 100vh;
}

.container{
    background-color: #fff;
    border-radius: 30px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
    position: relative;
    overflow: hidden;
    width: 768px;
    max-width: 100%;
    min-height: 480px;
}

.container p{
    font-size: 14px;
    line-height: 20px;
    letter-spacing: 0.3px;
    margin: 20px 0;
}

.container span{
    font-size: 12px;
}

.container a{
    color: #333;
    font-size: 13px;
    text-decoration: none;
    margin: 15px 0 10px;
}

.container button{
    background-color: #512da8;
    color: #fff;
    font-size: 12px;
    padding: 10px 45px;
    border: 1px solid transparent;
    border-radius: 8px;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-top: 10px;
    cursor: pointer;
}

.container button.hidden{
    background-color: transparent;
    border-color: #fff;
}

.container form{
    background-color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 40px;
    height: 100%;
}

.container input{
    background-color: #eee;
    border: none;
    margin: 8px 0;
    padding: 10px 15px;
    font-size: 13px;
    border-radius: 8px;
    width: 100%;
    outline: none;
}

.form-container{
    position: absolute;
    top: 0;
    height: 100%;
    transition: all 0.6s ease-in-out;
}

.sign-in{
    left: 0;
    width: 50%;
    z-index: 2;
}

.container.active .sign-in{
    transform: translateX(100%);
}

.sign-up{
    left: 0;
    width: 50%;
    opacity: 0;
    z-index: 1;
}

.container.active .sign-up{
    transform: translateX(100%);
    opacity: 1;
    z-index: 5;
    animation: move 0.6s;
}

@keyframes move{
    0%, 49.99%{
        opacity: 0;
        z-index: 1;
    }
    50%, 100%{
        opacity: 1;
        z-index: 5;
    }
}

.toggle-container{
    position: absolute;
    top: 0;
    left: 50%;
    width: 50%;
    height: 100%;
    overflow: hidden;
    transition: all 0.6s ease-in-out;
    border-radius: 150px 0 0 100px;
    z-index: 1000;
}

.container.active .toggle-container{
    transform: translateX(-100%);
    border-radius: 0 150px 100px 0;
}

.toggle{
    background-color: #512da8;
    height: 100%;
    background: linear-gradient(to right, #5c6bc0, #512da8);
    color: #fff;
    position: relative;
    left: -100%;
    height: 100%;
    width: 200%;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
}

.container.active .toggle{
    transform: translateX(50%);
}

.toggle-panel{
    position: absolute;
    width: 50%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 30px;
    text-align: center;
    top: 0;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
}

.toggle-left{
    transform: translateX(-200%);
}

.container.active .toggle-left{
    transform: translateX(0);
}

.toggle-right{
    right: 0;
    transform: translateX(0);
}

.container.active .toggle-right{
    transform: translateX(200%);
}
</style>
    <title>RSS | Login</title>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form class="forget-form" method="post">
                <h1>Forgot Password</h1>                                                
                <input class="form-control" type="text" placeholder="Emp Id" name="empid" required>                
                <input class="form-control" type="text" placeholder="Mobile Number" name="fmobno" required>        
                <input class="form-control" type="password" placeholder="New password" name="newpwd" required>            
                <button class="btn btn-primary btn-block" type="submit" name="reset"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
            </form>
        </div>

        <div class="form-container sign-in">
            <form class="login-form" method="POST">
                <h1>Sign In</h1>
                
                <!---Success Message--->
                <?php if($msg){ ?>
            
                <div class="alert alert-danger" role="alert">
                    <strong>Well done!</strong> <?php echo htmlentities($msg);?>
                </div>
            
                <?php } ?>
            
                <!---Error Message--->
                <?php if($error){ ?>

                <div class="alert alert-danger" role="alert">
                    <strong>Oh snap!</strong> <?php echo htmlentities($error);?>
                </div>
            
                <?php } ?>
                
                <input class="form-control" name="email" id="email" type="text" placeholder="Email" autofocus value="<?php echo $email;?>" required>
                <input class="form-control" name="password" id="password" type="password" placeholder="Password" required>
                <button type="submit" name="submit" id="submit">Sign In</button>
            </form>
        </div>

        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>

                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Have you forgotten your password, then click here</p>
                    <button class="hidden" id="register">Forgot Password</button>
                </div>
                
            </div>
        </div>
    </div>

<!-- Essential javascripts for application to work-->
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="../js/plugins/pace.min.js"></script>
<script>
const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});
</script>
</body>
</html>
