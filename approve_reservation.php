<?php
$link = mysqli_connect('localhost', 'root', '', 'school');
if (!$link) {
    die('無法連接資料庫：' . mysqli_connect_error());
}

$reservation_id = $_POST['reservation_id'] ?? null;
if ($reservation_id) {
    $sql = "UPDATE reservations SET status = 'approved' WHERE id = $reservation_id";
    if (mysqli_query($link, $sql)) {
        echo "<script>alert('預約已允許！'); window.location.href='管理預約記錄.php';</script>";
    } else {
        echo "<script>alert('操作失敗，請重試！'); window.location.href='管理預約記錄.php';</script>";
    }
} else {
    echo "<script>alert('未提供預約 ID！'); window.location.href='管理預約記錄.php';</script>";
}
mysqli_close($link);
?>
