<?php
$link = mysqli_connect('localhost', 'root', '', 'school');


$sql = "SELECT r.id, r.rental_type, c.name AS classroom_name, r.reservation_date, r.semester, r.start_period, r.end_period, r.name, r.email
        FROM reservations r
        JOIN classrooms c ON r.classroom_id = c.id
        ORDER BY r.reservation_date DESC";

$result = mysqli_query($link, $sql);


echo '<style>
body {
    font-family: Arial, sans-serif;
    background-color: #2f2f2f;
    color: white;
    margin: 0;
    padding: 0;
}
.table-container {
    width: 1100px;
    margin: 40px auto;
    background-color: #FAFAFA;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
}
h2 {
    text-align: center;
    font-size: 2.5rem;
    margin-bottom: 30px;
    color: black;
}
table {
    width: 100%;
    font-size: 1.2rem;
    border-collapse: collapse;
    margin: 0 auto;
}
thead tr {
    background-color: #A1A1A1;
    color: #333; 
}
thead th {
    padding: 15px;
    text-align: left;
    font-weight: bold;
    border-bottom: 2px solid #b3b3b3; 
}
tbody tr:nth-child(even) {
    background-color: #f2f2f2; 
}
tbody tr:nth-child(odd) {
    background-color: #e6e6e6; 
}
tbody td {
    padding: 10px;
    border-bottom: 1px solid #d9d9d9; 
    color: #333; 
}
tbody tr:hover {
    background-color: #d9d9d9;
}
button {
    padding: 10px 15px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1rem;
}
button.edit {
    background-color: #9C9C9C;
    color: white;
}
button.edit:hover {
    background-color: #EDEDED;
}
button.delete {
    background-color: #696969;
    color: white;
}
button.delete:hover {
    background-color: #828282;
}

</style>';

echo '<div class="table-container">';
echo '<h2 class="fw-bolder">預約記錄</h2>';
echo '<table>';
echo '<thead>
        <tr>
            <th>教室名稱</th>
            <th>日期 / 學期</th>
            <th>時間段</th>
            <th>姓名</th>
            <th>Email</th>
            <th>操作</th>
        </tr>
      </thead>';
echo '<tbody>';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['classroom_name']) . '</td>';
        echo '<td>' . ($row['rental_type'] === 'semester' ? htmlspecialchars($row['semester']) : htmlspecialchars($row['reservation_date'])) . '</td>';
        echo '<td>' . htmlspecialchars($row['start_period']) . ' - ' . htmlspecialchars($row['end_period']) . '</td>';
        echo '<td>' . htmlspecialchars($row['name']) . '</td>';
        echo '<td>' . htmlspecialchars($row['email']) . '</td>';
        echo '<td>
        <div class="action-buttons">
            <form action="修改預約記錄.php" method="get" style="display:inline;">
                <input type="hidden" name="reservation_id" value="' . $row['id'] . '">
                <button type="submit" class="edit">修改</button>
            </form>
            <form action="delete_reservation.php" method="post" style="display:inline;">
                <input type="hidden" name="id" value="' . $row['id'] . '">
                <button type="submit" class="delete">刪除</button>
            </form>
        </div>
      </td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="7" style="text-align: center;">目前沒有預約記錄。</td></tr>';
}

echo '</tbody>';
echo '</table>';
echo '</div>';


mysqli_close($link);
?>
