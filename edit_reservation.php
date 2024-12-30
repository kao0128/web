<?php
$link = mysqli_connect('localhost', 'root', '', 'school');


if (!isset($_GET['reservation_id'])) {
    die('未指定要修改的預約記錄。');
}

$reservation_id = intval($_GET['reservation_id']);

$sql = "SELECT * FROM reservations WHERE id = $reservation_id";
$result = mysqli_query($link, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    die('找不到指定的預約記錄。');
}

$reservation = mysqli_fetch_assoc($result);

$classrooms_result = mysqli_query($link, "SELECT * FROM classrooms");

echo '<h2 class="fw-bolder">修改教室租借申請表單</h2>';
echo '<form action="" method="post" id="reservationForm">';

// 租借類型
echo '<div class="form-group">';
echo '<label for="rentalType">選擇租借類型</label>';
echo '<select id="rentalType" name="rentalType" required>';
echo '<option value="30-days" ' . ($reservation['rental_type'] === '30-days' ? 'selected' : '') . '>30天內預借</option>';
echo '<option value="semester" ' . ($reservation['rental_type'] === 'semester' ? 'selected' : '') . '>一個學期預借</option>';
echo '</select>';
echo '</div>';

// 教室
echo '<div class="form-group">';
echo '<label for="classroom">選擇教室</label>';
echo '<select id="classroom" name="classroom_id" required>';
echo '<option value="">-- 請選擇教室 --</option>';
while ($row = mysqli_fetch_assoc($classrooms_result)) {
    echo '<option value="' . $row['id'] . '" ' . ($row['id'] == $reservation['classroom_id'] ? 'selected' : '') . '>' . htmlspecialchars($row['name']) . '</option>';
}
echo '</select>';
echo '</div>';

// 日期（30天內）
echo '<div class="form-group" id="dateGroup" ' . ($reservation['rental_type'] === 'semester' ? 'style="display:none;"' : '') . '>';
echo '<label for="reservationDate">選擇日期</label>';
echo '<input type="date" id="reservationDate" name="reservation_date" value="' . htmlspecialchars($reservation['reservation_date']) . '">';
echo '</div>';

// 學期（學期預借）
echo '<div class="form-group" id="semesterGroup" ' . ($reservation['rental_type'] === '30-days' ? 'style="display:none;"' : '') . '>';
echo '<label for="semester">選擇學期</label>';
echo '<select id="semester" name="semester">';
echo '<option value="">-- 請選擇學期 --</option>';
echo '<option value="113-1" ' . ($reservation['semester'] === '113-1' ? 'selected' : '') . '>113學年 上學期</option>';
echo '<option value="113-2" ' . ($reservation['semester'] === '113-2' ? 'selected' : '') . '>113學年 下學期</option>';
echo '</select>';
echo '</div>';

// 節次
echo '<div class="form-group">';
echo '<label for="startPeriod">開始節次</label>';
echo '<select id="startPeriod" name="start_period" required>';
$options = [
    'D1' => 'D1 (8:10-9:00)', 'D2' => 'D2 (9:10-10:00)', 'D3' => 'D3 (10:10-11:00)',
    'D4' => 'D4 (11:10-12:00)', 'DN' => 'DN (12:40-13:30)', 'D5' => 'D5 (13:40-14:30)',
    'D6' => 'D6 (14:40-15:30)', 'D7' => 'D7 (15:40-16:30)', 'D8' => 'D8 (16:40-17:30)', 'D9' => 'D9 (17:40-18:30)'
];
foreach ($options as $key => $value) {
    echo '<option value="' . $key . '" ' . ($reservation['start_period'] === $key ? 'selected' : '') . '>' . $value . '</option>';
}
echo '</select>';
echo '</div>';

echo '<div class="form-group">';
echo '<label for="endPeriod">結束節次</label>';
echo '<select id="endPeriod" name="end_period" required>';
foreach ($options as $key => $value) {
    echo '<option value="' . $key . '" ' . ($reservation['end_period'] === $key ? 'selected' : '') . '>' . $value . '</option>';
}
echo '</select>';
echo '</div>';

// 姓名和 Email
echo '<div class="form-group">';
echo '<label for="name">姓名</label>';
echo '<input type="text" id="name" name="name" value="' . htmlspecialchars($reservation['name']) . '" required>';
echo '</div>';

echo '<div class="form-group">';
echo '<label for="email">Email</label>';
echo '<input type="email" id="email" name="email" value="' . htmlspecialchars($reservation['email']) . '" required>';
echo '</div>';

echo '<button type="submit" class="submit-btn">提交修改</button>';
echo '</form>';

// 更新
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rental_type = mysqli_real_escape_string($link, $_POST['rentalType']);
    $classroom_id = intval($_POST['classroom_id']);
    $reservation_date = mysqli_real_escape_string($link, $_POST['reservation_date']);
    $semester = mysqli_real_escape_string($link, $_POST['semester']);
    $start_period = mysqli_real_escape_string($link, $_POST['start_period']);
    $end_period = mysqli_real_escape_string($link, $_POST['end_period']);
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $email = mysqli_real_escape_string($link, $_POST['email']);

    $update_sql = "UPDATE reservations 
                   SET rental_type = '$rental_type', 
                       classroom_id = $classroom_id, 
                       reservation_date = '$reservation_date', 
                       semester = '$semester', 
                       start_period = '$start_period', 
                       end_period = '$end_period', 
                       name = '$name', 
                       email = '$email' 
                   WHERE id = $reservation_id";

    if (mysqli_query($link, $update_sql)) {
        echo '<script>alert("修改成功！"); window.location.href = "預約記錄.php";</script>';
    } else {
        echo '<script>alert("修改失敗：' . mysqli_error($link) . '");</script>';
    }
}

mysqli_close($link);
?>
