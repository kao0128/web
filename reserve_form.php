<?php
$link = mysqli_connect('localhost', 'root', '', 'school');



$classrooms_result = mysqli_query($link, "SELECT * FROM classrooms");

echo '<h2 class="fw-bolder">教室租借申請表單</h2>';
echo '<form action="process_reservation.php" method="post" id="reservationForm">';

// 租借類型
echo '<div class="form-group">';
echo '<label for="rentalType">選擇租借類型</label>';
echo '<select id="rentalType" name="rentalType" required>';
echo '<option value="">-- 請選擇租借類型 --</option>';
echo '<option value="30-days">30天內預借</option>';
echo '<option value="semester">一個學期預借</option>';
echo '</select>';
echo '</div>';

// 教室
echo '<div class="form-group">';
echo '<label for="classroom">選擇教室</label>';
echo '<select id="classroom" name="classroom_id" required>';
echo '<option value="">-- 請選擇教室 --</option>';
while ($row = mysqli_fetch_assoc($classrooms_result)) {
    echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['name']) . '</option>';
}
echo '</select>';
echo '</div>';

// 日期（30天內）
echo '<div class="form-group" id="dateGroup">';
echo '<label for="reservationDate">選擇日期</label>';
echo '<input type="date" id="reservationDate" name="reservation_date">';
echo '</div>';

// 學期（學期預借）
echo '<div class="form-group" id="semesterGroup" style="display: none;">';
echo '<label for="semester">選擇學期</label>';
echo '<select id="semester" name="semester">';
echo '<option value="">-- 請選擇學期 --</option>';
echo '<option value="113-1">113學年 上學期</option>';
echo '<option value="113-2">113學年 下學期</option>';
echo '<option value="113-2">114學年 上學期</option>';
echo '<option value="113-2">114學年 下學期</option>';
echo '</select>';
echo '</div>';

// 星期（學期預借）
echo '<div class="form-group" id="weekGroup" style="display: none;">';
echo '<label for="weekDay">選擇星期</label>';
echo '<select id="weekDay" name="week_day">';
echo '<option value="">-- 請選擇星期 --</option>';
echo '<option value="Monday">星期一</option>';
echo '<option value="Tuesday">星期二</option>';
echo '<option value="Wednesday">星期三</option>';
echo '<option value="Thursday">星期四</option>';
echo '<option value="Friday">星期五</option>';
echo '<option value="Saturday">星期六</option>';
echo '<option value="Sunday">星期日</option>';
echo '</select>';
echo '</div>';

// 節次
echo '<div class="form-group">';
echo '<label for="startPeriod">開始節次</label>';
echo '<select id="startPeriod" name="start_period" required>';
echo '<option value="D1">D1 (8:10-9:00)</option>';
echo '<option value="D2">D2 (9:10-10:00)</option>';
echo '<option value="D3">D3 (10:10-11:00)</option>';
echo '<option value="D4">D4 (11:10-12:00)</option>';
echo '<option value="DN">DN (12:40-13:30)</option>';
echo '<option value="D5">D5 (13:40-14:30)</option>';
echo '<option value="D6">D6 (14:40-15:30)</option>';
echo '<option value="D7">D7 (15:40-16:30)</option>';
echo '<option value="D8">D8 (16:40-17:30)</option>';
echo '<option value="D9">D9 (17:40-18:30)</option>';
echo '</select>';
echo '</div>';

echo '<div class="form-group">';
echo '<label for="endPeriod">結束節次</label>';
echo '<select id="endPeriod" name="end_period" required>';
echo '<option value="D1">D1 (8:10-9:00)</option>';
echo '<option value="D2">D2 (9:10-10:00)</option>';
echo '<option value="D3">D3 (10:10-11:00)</option>';
echo '<option value="D4">D4 (11:10-12:00)</option>';
echo '<option value="DN">DN (12:40-13:30)</option>';
echo '<option value="D5">D5 (13:40-14:30)</option>';
echo '<option value="D6">D6 (14:40-15:30)</option>';
echo '<option value="D7">D7 (15:40-16:30)</option>';
echo '<option value="D8">D8 (16:40-17:30)</option>';
echo '<option value="D9">D9 (17:40-18:30)</option>';
echo '</select>';
echo '</div>';

// 姓名和 Email
echo '<div class="form-group">';
echo '<label for="name">姓名</label>';
echo '<input type="text" id="name" name="name" required>';
echo '</div>';

echo '<div class="form-group">';
echo '<label for="email">Email</label>';
echo '<input type="email" id="email" name="email" required>';
echo '</div>';

echo '<button type="submit" class="submit-btn">提交</button>';
echo '</form>';
?>
