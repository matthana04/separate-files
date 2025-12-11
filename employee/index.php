<?php
require '../middleware/employee.php';
?>
<link rel="stylesheet" href="../assets/style.css">

<div class="dashboard">
    <h2>Employee Dashboard</h2>
    <p>ยินดีต้อนรับพนักงาน <?php echo $_SESSION['fullname']; ?></p>

    <a class="logout" href="../logout.php">ออกจากระบบ</a>
</div>
