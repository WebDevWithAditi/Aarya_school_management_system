<?php
session_start();
include '../config/db.php';

if(!isset($_SESSION['admin'])){
  header("Location: ../auth/login.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Aarya International School</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: #f4f6f9;
    }
    .navbar {
      background: #4e73df;
    }
    .navbar-brand {
      color: #fff !important;
      font-weight: bold;
    }
    .nav-link {
      color: #fff !important;
    }
    .logo {
      height: 40px;
      margin-right: 10px;
    }
  </style>
</head>

<body>

<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">

    <!-- LOGO -->
    <a class="navbar-brand" href="../admin/dashboard.php">
      <img src="../uploads/logo.png" class="logo"> 
      Aarya International School
    </a>

    <div class="ms-auto">
      <a href="../admin/dashboard.php" class="btn btn-light btn-sm">Dashboard</a>
      <a href="../modules/students.php" class="btn btn-light btn-sm">Students</a>
      <a href="../modules/teachers.php" class="btn btn-light btn-sm">Teachers</a>
      <a href="../modules/fees.php" class="btn btn-light btn-sm">Fees</a>
      <a href="../modules/attendance.php" class="btn btn-light btn-sm">Attendance</a>
      <a href="../auth/logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>

  </div>
</nav>

<div class="container mt-4">