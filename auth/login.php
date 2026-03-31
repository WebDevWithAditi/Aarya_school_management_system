<?php
session_start();
include '../config/db.php';

if(isset($_POST['login'])){
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  $res = mysqli_query($conn,"SELECT * FROM admin WHERE username='$username' AND password='$password'");

  if(mysqli_num_rows($res) > 0){
    $_SESSION['admin'] = $username;
    header("Location: ../admin/dashboard.php");
  } else {
    echo "<script>alert('Invalid Login');</script>";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(45deg, #4e73df, #224abe);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-box {
      background: white;
      padding: 30px;
      border-radius: 15px;
      width: 350px;
      box-shadow: 0 0 20px rgba(0,0,0,0.2);
    }

    .logo {
      width: 80px;
      display: block;
      margin: auto;
    }
  </style>
</head>

<body>

<div class="login-box">

  <!-- LOGO -->
  <img src="../uploads/logo.png" class="logo">

  <h4 class="text-center mt-2">Admin Login</h4>

  <form method="post">
    <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
    <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

    <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
  </form>

</div>

</body>
</html>

<!-- <?php echo  "id:admin password:admin" ?> -->