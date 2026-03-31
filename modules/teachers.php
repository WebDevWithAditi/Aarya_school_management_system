<?php include '../includes/header.php'; ?>

<h3>Teachers</h3>

<form method="post" class="mb-3">
  <input name="name" class="form-control mb-2" placeholder="Teacher Name" required>
  <button name="add" class="btn btn-primary">Add Teacher</button>
</form>

<?php
// ADD
if(isset($_POST['add'])){
  mysqli_query($conn,"INSERT INTO teachers(name) VALUES('".$_POST['name']."')");
  echo "<script>window.location='teachers.php';</script>";
}

// DELETE
if(isset($_GET['delete'])){
  mysqli_query($conn,"DELETE FROM teachers WHERE id=".$_GET['delete']);
  echo "<script>window.location='teachers.php';</script>";
}

// UPDATE
if(isset($_POST['update'])){
  $id = $_POST['id'];
  $name = $_POST['name'];

  mysqli_query($conn,"UPDATE teachers SET name='$name' WHERE id='$id'");
  echo "<script>alert('Updated'); window.location='teachers.php';</script>";
}
?>

<table class="table table-bordered">
<tr>
  <th>ID</th>
  <th>Name</th>
  <th>Action</th>
</tr>

<?php
$res=mysqli_query($conn,"SELECT * FROM teachers");
while($r=mysqli_fetch_assoc($res)){
?>

<tr>
<form method="post">
  <td><?php echo $r['id']; ?></td>
  <td>
    <input type="text" name="name" value="<?php echo $r['name']; ?>" class="form-control">
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