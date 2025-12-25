<?php
session_start();
require_once 'inc/config.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';

    // ตรวจสอบข้อมูล
    if ($username === '' || $email === '' || $password === '' || $confirm === '') {
        $errors[] = 'กรุณากรอกข้อมูลให้ครบทุกช่อง';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'รูปแบบอีเมลไม่ถูกต้อง';
    }

    if ($password !== $confirm) {
        $errors[] = 'รหัสผ่านไม่ตรงกัน';
    }

    if (strlen($password) < 6) {
        $errors[] = 'รหัสผ่านต้องอย่างน้อย 6 ตัวอักษร';
    }

    // ตรวจสอบ username/email ซ้ำ
    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            $errors[] = 'Username หรือ Email ถูกใช้งานแล้ว';
        }
    }

    // บันทึกข้อมูล
    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare(
            "INSERT INTO users (username, email, password, role)
             VALUES (?, ?, ?, 'user')"
        );
        $stmt->execute([$username, $email, $hash]);

        $success = 'สมัครสมาชิกสำเร็จ สามารถเข้าสู่ระบบได้ทันที';
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>สมัครสมาชิก</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded shadow w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center">สมัครสมาชิก</h2>

    <?php if ($errors): ?>
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
            <ul class="list-disc pl-5">
                <?php foreach ($errors as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            <?= $success ?>
        </div>
    <?php endif; ?>

    <form method="post" class="space-y-4">
        <input type="text" name="username" placeholder="Username"
               class="w-full border p-2 rounded" required>

        <input type="email" name="email" placeholder="Email"
               class="w-full border p-2 rounded" required>

        <input type="password" name="password" placeholder="Password"
               class="w-full border p-2 rounded" required>

        <input type="password" name="confirm_password" placeholder="Confirm Password"
               class="w-full border p-2 rounded" required>

        <button class="w-full bg-blue-500 hover:bg-blue-600 text-white p-2 rounded">
            สมัครสมาชิก
        </button>
    </form>

    <p class="text-center mt-4 text-sm">
        มีบัญชีอยู่แล้ว?
        <a href="login.php" class="text-blue-500">เข้าสู่ระบบ</a>
    </p>
</div>

</body>
</html>
