<?php
session_start();

$id = $_POST['id'];
$password = $_POST['password'];

$link = mysqli_connect('localhost', 'root', '', 'school');

if (!$link) {
    die('無法連接資料庫：' . mysqli_connect_error());
}

$sql = "SELECT * FROM account WHERE id = '$id' AND password = '$password'";
$result = mysqli_query($link, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    $_SESSION['name'] = $row['name'];
    $_SESSION['level'] = $row['level'];


    if ($row['level'] === 'admin') {
        header('Location: 管理者登入介面.php');
    } elseif ($row['level'] === 'teacher') {
        header('Location: 老師登入介面.php');
    } else {
        echo "<script>alert('無效的使用者角色'); window.location.href='首頁.html';</script>";
    }
    exit;
} else {
    echo "<script>alert('帳號或密碼錯誤'); window.location.href='首頁.html';</script>";
}

mysqli_close($link);
?>
