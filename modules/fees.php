<?php include '../includes/header.php'; ?>

<h3>Fees Management</h3>

<form method="post" class="mb-3">
  <input name="student" class="form-control mb-2" placeholder="Student Name" required>
  <input name="amount" type="number" class="form-control mb-2" placeholder="Amount" required>
  <button name="add" class="btn btn-primary">Add Fee</button>
</form>

<?php
// ADD
if(isset($_POST['add'])){
  mysqli_query($conn,"INSERT INTO fees(student,amount) VALUES('".$_POST['student']."','".$_POST['amount']."')");
  echo "<script>window.location='fees.php';</script>";
}

// DELETE
if(isset($_GET['delete'])){
  mysqli_query($conn,"DELETE FROM fees WHERE id=".$_GET['delete']);
  echo "<script>window.location='fees.php';</script>";
}

// UPDATE
if(isset($_POST['update'])){
  $id = $_POST['id'];
  $student = $_POST['student'];
  $amount = $_POST['amount'];

  mysqli_query($conn,"UPDATE fees SET student='$student', amount='$amount' WHERE id='$id'");
  echo "<script>alert('Updated'); window.location='fees.php';</script>";
}
?>

<table class="table table-bordered">
<tr>
  <th>ID</th>
  <th>Student</th>
  <th>Amount</th>
  <th>Action</th>
</tr>

<?php
$res=mysqli_query($conn,"SELECT * FROM fees");
while($r=mysqli_fetch_assoc($res)){
?>

<tr>
<form method="post">
  <td><?php echo $r['id']; ?></td>

  <td>
    <input type="text" name="student" value="<?php echo $r['student']; ?>" class="form-control">
  </td>

  <td>
    <input type="number" name="amount" value="<?php echo $r['amount']; ?>" class="form-control">
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