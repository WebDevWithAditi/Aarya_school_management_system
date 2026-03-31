<?php include '../includes/header.php'; ?>

<h3>Attendance</h3>

<form method="post" class="mb-3">
  <input name="student" class="form-control mb-2" placeholder="Student Name" required>
  
  <select name="status" class="form-control mb-2">
    <option value="Present">Present</option>
    <option value="Absent">Absent</option>
  </select>

  <button name="add" class="btn btn-primary">Mark Attendance</button>
</form>

<?php
// ADD
if(isset($_POST['add'])){
  mysqli_query($conn,"INSERT INTO attendance(student,status) VALUES('".$_POST['student']."','".$_POST['status']."')");
  echo "<script>window.location='attendance.php';</script>";
}

// DELETE
if(isset($_GET['delete'])){
  mysqli_query($conn,"DELETE FROM attendance WHERE id=".$_GET['delete']);
  echo "<script>window.location='attendance.php';</script>";
}

// UPDATE
if(isset($_POST['update'])){
  $id = $_POST['id'];
  $student = $_POST['student'];
  $status = $_POST['status'];

  mysqli_query($conn,"UPDATE attendance SET student='$student', status='$status' WHERE id='$id'");
  echo "<script>alert('Updated'); window.location='attendance.php';</script>";
}
?>


<table class="table table-bordered">
<tr>
  <th>ID</th>
  <th>Student</th>
  <th>Status</th>
  <th>Action</th>
</tr>

<?php
$res=mysqli_query($conn,"SELECT * FROM attendance");
while($r=mysqli_fetch_assoc($res)){
?>

<tr>
<form method="post">
  <td><?php echo $r['id']; ?></td>
  
  <td>
    <input type="text" name="student" value="<?php echo $r['student']; ?>" class="form-control">
  </td>

  <td>
    <select name="status" class="form-control">
      <option <?php if($r['status']=="Present") echo "selected"; ?>>Present</option>
      <option <?php if($r['status']=="Absent") echo "selected"; ?>>Absent</option>
    </select>
  </td>

  <td>
    <input type="hidden" name="id" value="<?php echo $r['id']; ?>">
    <button name="update" class="btn btn-success btn-sm">Update</button>
    <a href="?delete=<?php echo $r['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
  </td>
</form>
</tr>

<?php } ?>
</table>

<?php include '../includes/footer.php'; ?>