<?php
$link = mysqli_connect('localhost', 'root', '', 'school');



// 新增教室
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_classroom'])) {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $capacity = intval($_POST['capacity']);
    $equipment = mysqli_real_escape_string($link, $_POST['equipment']);

    $sql = "INSERT INTO classrooms (name, capacity, equipment) VALUES ('$name', $capacity, '$equipment')";
    if (!mysqli_query($link, $sql)) {
        echo '<p style="color:red;">新增失敗：' . mysqli_error($link) . '</p>';
    }
}

// 刪除教室
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_classroom'])) {
    $id = intval($_POST['id']);
    $sql = "DELETE FROM classrooms WHERE id = $id";
    if (!mysqli_query($link, $sql)) {
        echo '<p style="color:red;">刪除失敗：' . mysqli_error($link) . '</p>';
    }
}

// 更新教室
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_classroom'])) {
    $id = intval($_POST['id']);
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $capacity = intval($_POST['capacity']);
    $equipment = mysqli_real_escape_string($link, $_POST['equipment']);

    $sql = "UPDATE classrooms SET name = '$name', capacity = $capacity, equipment = '$equipment' WHERE id = $id";
    if (!mysqli_query($link, $sql)) {
        echo '<p style="color:red;">更新失敗：' . mysqli_error($link) . '</p>';
    }
}


$sql = "SELECT * FROM classrooms";
$result = mysqli_query($link, $sql);

// 新增教室
echo '<h2>新增教室</h2>
    <form action="" method="post">
        <input type="hidden" name="add_classroom" value="1">
        <label for="name">教室名稱：</label>
        <input type="text" id="name" name="name" required><br>
        <label for="capacity">容納人數：</label>
        <input type="number" id="capacity" name="capacity" required><br>
        <label for="equipment">設備：</label>
        <input type="text" id="equipment" name="equipment" required><br>
        <br>
        <button type="submit" name="add_classroom" class="add-btn">新增</button>
    </form>';


echo '<h2>可預約教室列表</h2>';
echo '<table>';
echo '<thead><tr><th>教室名稱</th><th>容納人數</th><th>設備</th><th>操作</th></tr></thead>';
echo '<tbody>';

while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($row['name']) . '</td>';
    echo '<td>' . htmlspecialchars($row['capacity']) . '</td>';
    echo '<td>' . htmlspecialchars($row['equipment']) . '</td>';
    echo '<td>
        <form action="" method="post" style="display:flex; align-items: center; gap: 20px;">
        <input type="hidden" name="id" value="' . $row['id'] . '">
        <input type="text" name="name" value="' . htmlspecialchars($row['name']) . '" required style="flex: 1; padding: 5px;">
        <input type="number" name="capacity" value="' . $row['capacity'] . '" required style="flex: 0.5; padding: 5px;">
        <input type="text" name="equipment" value="' . htmlspecialchars($row['equipment']) . '" required style="flex: 2; padding: 5px;">
        <div style="display: flex; gap: 10px;">
            <button type="submit" name="update_classroom" class="action-btn update">更新</button>
            <form action="" method="post" style="display:inline;">
                <input type="hidden" name="id" value="' . $row['id'] . '">
                <button type="submit" name="delete_classroom" class="action-btn delete">刪除</button>
            </form>
        </div>
        </form>


    </td>';
    echo '</tr>';
}

echo '</tbody></table>';

mysqli_close($link);
?>
