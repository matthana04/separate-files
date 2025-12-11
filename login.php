<?php
session_start();
require 'config.php';

$err = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['fullname'] = $user['fullname'];
        $_SESSION['role']     = $user['role'];

        switch ($user['role']) {
            case 'admin': header("Location: admin/index.php"); break;
            case 'user': header("Location: user/index.php"); break;
            case 'customer': header("Location: customer/index.php"); break;
            case 'employee': header("Location: employee/index.php"); break;
        }
        exit;

    } else {
        $err = "❌ ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เข้าสู่ระบบ</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="container">
    <h2>เข้าสู่ระบบ</h2>

    <form method="POST">
        <input type="text" name="username" placeholder="ชื่อผู้ใช้" required>
        <input type="password" name="password" placeholder="รหัสผ่าน" required>
        <button type="submit">เข้าสู่ระบบ</button>
    </form>

    <?php if ($err) echo "<p class='error'>$err</p>"; ?>
</div>

</body>
</html>
