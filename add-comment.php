<?php

$link = mysqli_connect('localhost', 'root', '', 'school');

if (!$link) {
    die('資料庫連接失敗：' . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $announcement_id = $_POST['announcement_id'];
    $comment = $_POST['comment'];

    $announcement_id = mysqli_real_escape_string($link, $announcement_id);
    $comment = mysqli_real_escape_string($link, $comment);

    $sql = "INSERT INTO comments (announcement_id, comment) VALUES ('$announcement_id', '$comment')";
    if (mysqli_query($link, $sql)) {
        header('Location: 老師登入介面.php'); 
        exit();
    } else {
        echo '<p style="color:red;">留言提交失敗：' . mysqli_error($link) . '</p>';
    }
}

mysqli_close($link);
?>
