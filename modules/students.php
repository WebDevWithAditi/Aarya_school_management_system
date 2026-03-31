<?php 
include '../includes/header.php';

// ===== HANDLE ACTIONS FIRST =====

// ADD
if(isset($_POST['add'])){
  $name = $_POST['name'];

  $photo = $_FILES['photo']['name'];
  if($photo != ''){
    move_uploaded_file($_FILES['photo']['tmp_name'], "../uploads/".$photo);
  }

  mysqli_query($conn,"INSERT INTO students(name,photo) VALUES('$name','$photo')");
  echo "<script>window.location='students.php';</script>";
}

// DELETE (with photo delete)
if(isset($_GET['delete'])){
  $id = $_GET['delete'];

  // get photo
  $res = mysqli_query($conn,"SELECT photo FROM students WHERE id='$id'");
  $row = mysqli_fetch_assoc($res);

  // delete photo file
  if($row['photo'] && file_exists("../uploads/".$row['photo'])){
    unlink("../uploads/".$row['photo']);
  }

  mysqli_query($conn,"DELETE FROM students WHERE id='$id'");
  echo "<script>window.location='students.php';</script>";
}

// UPDATE (name + photo)
if(isset($_POST['update'])){
  $id = $_POST['id'];
  $name = $_POST['name'];

  // get old photo
  $res = mysqli_query($conn,"SELECT photo FROM students WHERE id='$id'");
  $row = mysqli_fetch_assoc($res);

  if($_FILES['photo']['name'] != ''){
    
    // delete old photo
    if($row['photo'] && file_exists("../uploads/".$row['photo'])){
      unlink("../uploads/".$row['photo']);
    }

    $photo = $_FILES['photo']['name'];
    move_uploaded_file($_FILES['photo']['tmp_name'], "../uploads/".$photo);

    mysqli_query($conn,"UPDATE students SET name='$name', photo='$photo' WHERE id='$id'");
  
  } else {
    mysqli_query($conn,"UPDATE students SET name='$name' WHERE id='$id'");
  }

  echo "<script>alert('Student Updated Successfully'); window.location='students.php';</script>";
}
?>

<h3>Students</h3>

<!-- ADD FORM -->
<form method="post" enctype="multipart/form-data" class="mb-3">
  <input name="name" class="form-control mb-2" placeholder="Student Name" required>
  <input type="file" name="photo" class="form-control mb-2">
  <button type="submit" name="add" class="btn btn-primary">Add Student</button>
</form>

<!-- SEARCH -->
<form method="get" class="mb-3">
  <input type="text" name="search" class="form-control" placeholder="Search student..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
</form>

<table class="table table-bordered">
<tr>
  <th>ID</th>
  <th>Name</th>
  <th>Photo</th>
  <th>Update Photo</th>
  <th>Action</th>
</tr>

<?php
if(isset($_GET['search'])){
  $search = $_GET['search'];
  $res = mysqli_query($conn,"SELECT * FROM students WHERE name LIKE '%$search%'");
} else {
  $res = mysqli_query($conn,"SELECT * FROM students");
}

while($r=mysqli_fetch_assoc($res)){
?>
<tr>
<form method="post" enctype="multipart/form-data">
  <td><?php echo $r['id']; ?></td>

  <td>
    <input type="text" name="name" value="<?php echo $r['name']; ?>" class="form-control">
  </td>

  <td>
    <?php if($r['photo'] != ''){ ?>
      <img src="../uploads/<?php echo $r['photo']; ?>" width="50">
    <?php } else { ?>
      <img src="../uploads/default.jpeg" width="50">
    <?php } ?>
  </td>

  <td>
    <input type="file" name="photo" class="form-control">
  </td>

  <td>
    <input type="hidden" name="id" value="<?php echo $r['id']; ?>">

    <button type="submit" name="update" class="btn btn-success btn-sm">Update</button>

    <a href="?delete=<?php echo $r['id']; ?>" class="btn btn-danger btn-sm"
       onclick="return confirm('Are you sure?')">Delete</a>
  </td>
</form>
</tr>
<?php } ?>
</table>

<a href="student_pdf.php" class="btn btn-danger mb-3">Download PDF</a>

<?php include '../includes/footer.php'; ?>



