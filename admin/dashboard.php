<?php include '../includes/header.php'; ?>

<?php
$students = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM students"));
$teachers = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM teachers"));
$fees = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM fees"));
?>

<style>
.card-box {
  border-radius: 15px;
  padding: 20px;
  color: #fff;
  margin-bottom: 20px;
}
.bg1 { background: linear-gradient(45deg, #4e73df, #224abe); }
.bg2 { background: linear-gradient(45deg, #1cc88a, #13855c); }
.bg3 { background: linear-gradient(45deg, #f6c23e, #dda20a); }
</style>

<h2 class="mb-4">Dashboard</h2>

<div class="row">
  <div class="col-md-4">
    <div class="card-box bg1">
      <h4>Total Students</h4>
      <h2><?php echo $students; ?></h2>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card-box bg2">
      <h4>Total Teachers</h4>
      <h2><?php echo $teachers; ?></h2>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card-box bg3">
      <h4>Total Fees Records</h4>
      <h2><?php echo $fees; ?></h2>
    </div>
  </div>
</div>

<canvas id="chart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('chart'), {
  type: 'doughnut',
  data: {
    labels: ['Students', 'Teachers', 'Fees'],
    datasets: [{
      data: [<?php echo $students; ?>, <?php echo $teachers; ?>, <?php echo $fees; ?>]
    }]
  }
});
</script>

<?php include '../includes/footer.php'; ?>



