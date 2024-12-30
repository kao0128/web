<?php
$link = mysqli_connect('localhost', 'root', '', 'school');
if (!$link) {
    die('無法連接資料庫：' . mysqli_connect_error());
}

// 新增學期
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_semester'])) {
        $semester_name = $_POST['semester_name'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $sql = "INSERT INTO semester (semester_name, start_date, end_date) VALUES ('$semester_name', '$start_date', '$end_date')";
        if (mysqli_query($link, $sql)) {
            echo '<script>alert("學期新增成功！"); window.location.href = ""; </script>';
        } else {
            echo '<script>alert("學期新增失敗！"); window.location.href = ""; </script>';
        }
    }

    // 更新學期
    if (isset($_POST['update_semester'])) {
        $semester_id = intval($_POST['id']);
        $semester_name = $_POST['semester_name'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $sql = "UPDATE semester SET semester_name = '$semester_name', start_date = '$start_date', end_date = '$end_date' WHERE id = $semester_id";
        if (mysqli_query($link, $sql)) {
            echo '<script>alert("學期更新成功！"); window.location.href = ""; </script>';
        } else {
            echo '<script>alert("學期更新失敗！"); window.location.href = ""; </script>';
        }
    }

    // 刪除學期
    if (isset($_POST['delete_semester'])) {
        $semester_id = intval($_POST['id']);
        $sql = "DELETE FROM semester WHERE id = $semester_id";
        if (mysqli_query($link, $sql)) {
            echo '<script>alert("學期刪除成功！"); window.location.href = ""; </script>';
        } else {
            echo '<script>alert("學期刪除失敗！"); window.location.href = ""; </script>';
        }
    }
}

$result = mysqli_query($link, "SELECT * FROM semester ORDER BY start_date ASC");

// 新增學期
echo '<div>';
echo '<h2>新增學期</h2>';
echo '<form action="" method="post">';
echo '<input type="hidden" name="add_semester" value="1">';
echo '<label for="semester_name">學期名稱：</label>';
echo '<input type="text" id="semester_name" name="semester_name" placeholder="如：113學年上學期" required><br>';
echo '<label for="start_date">學期開始日期：</label>';
echo '<input type="date" id="start_date" name="start_date" required><br>';
echo '<label for="end_date">學期結束日期：</label>';
echo '<input type="date" id="end_date" name="end_date" required><br>';
echo '<br>';
echo '<button type="submit" class="add-btn">新增</button>';
echo '</form>';
echo '</div>';

// 學期列表
echo '<div>';
echo '<h2>學期列表</h2>';
echo '<table>';
echo '<thead>';
echo '<tr>';
echo '<th>學期名稱</th>';
echo '<th>開始日期</th>';
echo '<th>結束日期</th>';
echo '<th>操作</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($row['semester_name']) . '</td>';
    echo '<td>' . htmlspecialchars($row['start_date']) . '</td>';
    echo '<td>' . htmlspecialchars($row['end_date']) . '</td>';
    echo '<td>';
    echo '<form action="" method="post" style="display:flex; align-items: center; gap: 20px;">';
    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
    echo '<input type="text" name="semester_name" value="' . htmlspecialchars($row['semester_name']) . '" required style="flex: 1; padding: 5px;">';
    echo '<input type="date" name="start_date" value="' . $row['start_date'] . '" required style="flex: 0.5; padding: 5px;">';
    echo '<input type="date" name="end_date" value="' . $row['end_date'] . '" required style="flex: 0.5; padding: 5px;">';
    echo '<div style="display: flex; gap: 10px;">';
    echo '<button type="submit" name="update_semester" class="action-btn update">更新</button>';
    echo '<button type="submit" name="delete_semester" class="action-btn delete">刪除</button>';
    echo '</div>';
    echo '</form>';
    echo '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
echo '</div>';

mysqli_close($link);
?>
