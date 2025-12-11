<?php
require '../middleware/user.php';
?>
<link rel="stylesheet" href="../assets/style.css">

<div class="dashboard">
    <h2>User Dashboard</h2>
    <p>ยินดีต้อนรับ <?php echo $_SESSION['fullname']; ?></p>

    <a class="logout" href="../logout.php">ออกจากระบบ</a>
</div>
