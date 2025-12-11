<?php
require '../middleware/customer.php';
?>
<link rel="stylesheet" href="../assets/style.css">

<div class="dashboard">
    <h2>Customer Dashboard</h2>
    <p>สวัสดีลูกค้า <?php echo $_SESSION['fullname']; ?></p>

    <a class="logout" href="../logout.php">ออกจากระบบ</a>
</div>
