<?php
$link = mysqli_connect('localhost', 'root', '', 'school');

if (!$link) {
    die('無法連接資料庫：' . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $reservation_id = intval($_POST['id']);

    $sql = "DELETE FROM reservations WHERE id = $reservation_id";

    if (mysqli_query($link, $sql)) {
        echo '<script>alert("刪除成功！"); window.location.href = "預約記錄.php";</script>';
    } else {
        echo '<script>alert("刪除失敗：' . mysqli_error($link) . '"); window.location.href = "預約記錄.php";</script>';
    }
} else {
    echo '<script>alert("無效的操作！"); window.location.href = "reservation_records.php";</script>';
}

mysqli_close($link);
?>
