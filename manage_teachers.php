<?php
$link = mysqli_connect('localhost', 'root', '', 'school');
if (!$link) {
    die('無法連接資料庫：' . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_teacher'])) {
        $name = mysqli_real_escape_string($link, $_POST['name']);
        $username = mysqli_real_escape_string($link, $_POST['username']);
        $department = mysqli_real_escape_string($link, $_POST['department']);
        $is_admin = isset($_POST['is_admin']) ? 1 : 0;

        $sql = "INSERT INTO teachers (name, username, department, is_admin) VALUES ('$name', '$username', '$department', $is_admin)";
        if (mysqli_query($link, $sql)) {
            echo '<script>alert("教師新增成功！"); window.location.href = "管理教師權限.php"; </script>';
        } else {
            echo '<script>alert("教師新增失敗：' . mysqli_error($link) . '"); window.location.href = ""; </script>';
        }
    }

    if (isset($_POST['delete_teacher'])) {
        $teacher_id = intval($_POST['id']);
        $sql = "DELETE FROM teachers WHERE id = $teacher_id";
        if (mysqli_query($link, $sql)) {
            echo '<script>alert("教師刪除成功！"); window.location.href = ""; </script>';
        } else {
            echo '<script>alert("教師刪除失敗：' . mysqli_error($link) . '"); window.location.href = ""; </script>';
        }
    }

    if (isset($_POST['update_teacher'])) {
        $teacher_id = intval($_POST['id']);
        $name = mysqli_real_escape_string($link, $_POST['name']);
        $username = mysqli_real_escape_string($link, $_POST['username']);
        $department = mysqli_real_escape_string($link, $_POST['department']);

        $sql = "UPDATE teachers SET name = '$name', username = '$username', department = '$department' WHERE id = $teacher_id";
        if (mysqli_query($link, $sql)) {
            echo '<script>alert("教師資訊更新成功！"); window.location.href = ""; </script>';
        } else {
            echo '<script>alert("教師資訊更新失敗：' . mysqli_error($link) . '"); window.location.href = ""; </script>';
        }
    }

    if (isset($_POST['toggle_admin'])) {
        $teacher_id = intval($_POST['id']);
        $is_admin = intval($_POST['is_admin']);
        $sql = "UPDATE teachers SET is_admin = $is_admin WHERE id = $teacher_id";
        if (mysqli_query($link, $sql)) {
            echo '<script>alert("教師權限更新成功！"); window.location.href = ""; </script>';
        } else {
            echo '<script>alert("教師權限更新失敗：' . mysqli_error($link) . '"); window.location.href = ""; </script>';
        }
    }
}

$result = mysqli_query($link, "SELECT * FROM teachers ORDER BY name ASC");

// css
echo '<style>
.form-container {
    background-color: #ffffff;
    border: 1px solid #e0e0e0;
    padding: 50px;
    margin: 50px;
    border-radius: 8px;
    width: 1000px;

}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

input,
select,
textarea {
    width: 100%;
    padding: 8px;

    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 0.9rem;

}

textarea {
    resize: vertical;
}

.submit-btn {
    width: 100px;
    height: 35px;
    margin-left: 780px;
    background-color: #6c757d;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.submit-btn:hover {
    background-color: #5a6268;
}
    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }
    form {
        margin-bottom: 20px;
    }
    .form-group {
        margin-bottom: 15px;
    }
    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }
    input, select, textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 0.9rem;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        color: #333; 
    }
    
    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
        color: #333;
    }
    
    th {
        background-color: #f2f2f2;
        color: #333; 
    }
    .switch {
        position: relative;
        display: inline-block;
        width: 34px;
        height: 20px;
    }
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 34px;
    }
    .slider:before {
        position: absolute;
        content: "";
        height: 14px;
        width: 14px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: 0.4s;
        border-radius: 50%;
    }
    input:checked + .slider {
        background-color: #4CAF50;
    }
    input:checked + .slider:before {
        transform: translateX(14px);
    }
    .add-btn {
        background-color: #6c757d;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 5px;
    }
    .add-btn:hover {
        background-color: #5a6268;
    }
</style>';

// 新增教師
echo '<h2>新增教師</h2>';
echo '<form action="" method="post">';
echo '<label for="name">教師名稱：</label><input type="text" id="name" name="name" required><br>';
echo '<label for="username">教師帳號：</label><input type="text" id="username" name="username" required><br>';
echo '<label for="department">科系：</label><input type="text" id="department" name="department" required><br>';
echo '<label>是否為管理者：</label><label class="switch"><input type="checkbox" name="is_admin"><span class="slider"></span></label><br>';
echo '<button type="submit" name="add_teacher" class="add-btn">新增教師</button>';
echo '</form>';

// 教師列表
echo '<h2>教師列表</h2>';
echo '<table>';
echo '<thead><tr><th>教師名稱</th><th>帳號</th><th>科系</th><th>是否為管理者</th><th>操作</th></tr></thead>';
echo '<tbody>';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<form action="" method="post">';
    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
    echo '<td><input type="text" name="name" value="' . htmlspecialchars($row['name']) . '" required></td>';
    echo '<td><input type="text" name="username" value="' . htmlspecialchars($row['username']) . '" required></td>';
    echo '<td><input type="text" name="department" value="' . htmlspecialchars($row['department']) . '" required></td>';
    echo '<td>';
    echo '<form action="" method="post" style="display:inline;">';
    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
    echo '<input type="hidden" name="toggle_admin" value="1">';
    echo '<input type="hidden" name="is_admin" value="' . ($row['is_admin'] ? 0 : 1) . '">';
    echo '<label class="switch">';
    echo '<input type="checkbox" ' . ($row['is_admin'] ? 'checked' : '') . ' onchange="this.form.submit()">';
    echo '<span class="slider"></span>';

 
    echo '</td>';
    echo '<td>';
    echo '<button type="submit" name="update_teacher" class="add-btn">更新</button>';
    echo '<button type="submit" name="delete_teacher" class="add-btn" style="background-color: #e74c3c; margin-left: 10px;">刪除</button>';
    echo '</label>';
    echo '</td>';
    echo '</form>';
    echo '</tr>';
}
echo '</tbody></table>';

mysqli_close($link);
?>
