<?php
session_start();
include("config.php");

if (!isset($_SESSION['valid'])) {
    header("location:login.php");  // Redirect if not logged in
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
<link rel="stylesheet" href="changeprofile.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <?Php
if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $email=$_POST['email'];
    $age=$_POST['age'];
   // $id=$_POST['id'];
    $id= $_SESSION['id'];

    $edit_query=mysqli_query($conn,"UPDATE users SET Username='$username' ,Email='$email' ,Age='$age' WHERE Id='$id' ") or die("error occured");
if($edit_query){
    echo "<div class='message'>
    <p>profile updated!</p>
    </div><br>";
echo "<a href='home.php'><button class='btn'>go home</button></a>";
}
}else{
    $id=$_SESSION['id'];
    $query=mysqli_query($conn,"SELECT * FROM users WHERE Id=$id ");
    while($result=mysqli_fetch_assoc($query)){
        $res_Uname=$result['Username'];
        $res_Email=$result['Email'];
        $res_Age=$result['Age'];

    }
    ?>
    <div class="links">
   <div class="homed"><a href="home.php" class="home">Home</a></div>
    <br>
    <br>
<div class="logoutd"><a href="logout.php" class="logout">logout</a></div>
</div>
<br>
<br>
<div class="changebox">
   <div class="changed"><header>change profile</header></div>
    <form action="" method="post">
<p>username :</p><input type="text" id="username" name="username" value="<?php echo $res_Uname ?>" autocomplete="off"><br>
<p>email :</p><input type="text" id="email" name="email" value="<?php echo $res_Email ?>" ><br>
<p>age :</p><input type="text" id="age" name="age" value="<?php echo $res_Age ?>" >
<br>
<br>
<input type="submit" id="submit" name="submit" value="update">

</p>
    </form>
</div>
   <?php
}
   ?>
</body>
</html>