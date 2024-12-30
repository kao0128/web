<?php
$link = mysqli_connect('localhost', 'root', '', 'school');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rentalType = mysqli_real_escape_string($link, $_POST['rentalType']);
    $classroom_id = intval($_POST['classroom_id']);
    $reservation_date = !empty($_POST['reservation_date']) ? mysqli_real_escape_string($link, $_POST['reservation_date']) : null;
    $semester = !empty($_POST['semester']) ? mysqli_real_escape_string($link, $_POST['semester']) : null;
    $start_period = mysqli_real_escape_string($link, $_POST['start_period']);
    $end_period = mysqli_real_escape_string($link, $_POST['end_period']);
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $email = mysqli_real_escape_string($link, $_POST['email']);

 
    $sql = "INSERT INTO reservations (rental_type, classroom_id, reservation_date, semester, start_period, end_period, name, email)
            VALUES ('$rentalType', $classroom_id, " . ($reservation_date ? "'$reservation_date'" : "NULL") . ", " . ($semester ? "'$semester'" : "NULL") . ", '$start_period', '$end_period', '$name', '$email')";

    if (mysqli_query($link, $sql)) {
        header("Location: 預約記錄.php");
        exit;
    } else {
        echo '預約失敗：' . mysqli_error($link);
    }
}

mysqli_close($link);
?>
