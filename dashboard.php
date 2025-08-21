<?php
session_start();
include 'db.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user data
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Check if user purchased a plan
if (empty($user['plan'])) {
    header("Location: plan.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
  <div class="row">
    <div class="col-lg-8 mx-auto">
      <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-primary text-white text-center">
          <h3>Welcome, <?php echo $user['name']; ?> 👋</h3>
        </div>
        <div class="card-body p-4">

          <!-- Plan Info -->
          <h5 class="mb-3">📦 Your Plan</h5>
          <p><strong>Selected Plan:</strong> <?php echo $user['plan']; ?></p>
          <p><strong>Balance:</strong> $<?php echo $user['balance']; ?></p>

          <!-- Withdraw Option -->
          <h5 class="mt-4">💳 Withdraw Funds</h5>
          <form action="withdraw.php" method="POST" class="row g-3">
            <div class="col-12">
              <input type="number" name="amount" class="form-control" placeholder="Enter amount" required>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-success w-100">Withdraw</button>
            </div>
          </form>

          <!-- Logout -->
          <div class="mt-4 text-center">
            <a href="logout.php" class="btn btn-danger">Logout</a>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
