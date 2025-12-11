<?php
require '../middleware/admin.php';
?>
<link rel="stylesheet" href="../assets/style.css">

<div class="dashboard">
    <h2>👑 Admin Dashboard</h2>
    <p>สวัสดีคุณ <?php echo $_SESSION['fullname']; ?></p>

    <a class="logout" href="../logout.php">ออกจากระบบ</a>
</div>
