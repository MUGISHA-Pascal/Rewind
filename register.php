<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php 
include("config.php");
if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $email=$_POST['email'];
    $age=$_POST['age'];
    $age=(int)$age;
    
    $password=$_POST['password'];
$verify_query=mysqli_query($conn,"SELECT Email FROM users WHERE Email='$email' ");
if(mysqli_num_rows($verify_query)!=0){
    echo "<div class='message'>
    <p>the email is used ,try another one please !</p>
    </div><br>";
echo "<a href='javascript:self.history.back()'><button class='btn'>go back</button></a>";
}else{
    $stmt = $conn->prepare("INSERT INTO users (Username, Email, Age, Password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $username, $email, $age, $password);
    $stmt->execute();
    echo "<div class='message'>
    <p> registration successful !</p>
    </div><br>";
echo "<a href='login.php'><button class='btn'>login now</button></a>";
}
}else{
    ?>
    <div class="signbox">
 <div class="signupd"><p class="signup">sign up</p></div>  
    <form action="" method="post">
    
<p>username :</p><input type="text" id="username" name="username" autocomplete="off"  required>
<br>
<p>email :</p><input type="text" id="email" name="email" required>
<br>
<p>age :</p><input type="number" id="age" name="age" required>
<br>
<p>password :</p><input type="text" id="password" name="password" autocomplete="off"  required>
<br>
<br>
<input type="submit" id="submit" name="submit" value="sign up">
<p class="member"> arleady a member <a href="login.php" class="signin">sign in</a>
</p>
    </form>
    </div>
    <?php
}
?>
</body>

</html>