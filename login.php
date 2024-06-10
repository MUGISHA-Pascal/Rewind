<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php
   
session_start();

include("config.php");
if(isset($_POST['submit'])){
/*$username=mysqli_real_escape_string($conn,$_POST['username']);
$password=mysqli_real_escape_string($conn,$_POST['password']);
$result=mysqli_query($conn,"SELECT * FROM users WHERE Username='$username' AND Password='$password'") or die("select error");
$row=mysqli_fetch_assoc($result);*/
$username=$_POST['username'];
$password=$_POST['password'];
$stmt = $conn->prepare('SELECT * FROM users WHERE Username=? AND Password=?');
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
if(is_array($row) && !empty($row)){
    $_SESSION['valid']=$row['Email'];
    $_SESSION['username']=$row['Username'];
    $_SESSION['age']=$row['Age'];
    $_SESSION['id']=$row['Id'];
}else{
    echo $row;
    echo "<div class='message'>
    <p>wrong username or password</p>
    </div><br>";
echo "<a href='login.php'><button class='btn'>go back</button></a>";
}
    if(isset($_SESSION['valid'])){
        header('location:home.php');
    }
}else{

    ?>
    <div class="loginbox">
    <p class="login">login</p>
    <form action="" method="post">
<p>username :</p><input type="text" id="username" name="username" autocomplete="off" required><br>
<p>password :</p><input type="text" id="password" name="password"  autocomplete="off" required>
<br>
<br>
<input type="submit" id="submit" name="submit" value="login">
<p class="member">if you dont have an account <a href="register.php" class="signin">sign up</a>
</p>
    </form>
</div>
    <?php
}
?>
</body>
</html>