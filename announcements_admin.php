<?php
$link = mysqli_connect('localhost', 'root', '', 'school');



// 新增公告
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['new_announcement']=="1") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = '管理者'; 
    $sql = "INSERT INTO announcements (title, content, posted_at, author) VALUES ('$title', '$content', NOW(), '$author')";
    if (!mysqli_query($link, $sql)) {
        echo '<p style="color:red;">新增公告失敗：' . mysqli_error($link) . '</p>';
    }
}

// 刪除留言
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['delete_comment']==1) {
    $comment_id = intval($_POST['comment_id']);
    $sql = "DELETE FROM comments WHERE id = $comment_id";
    if (!mysqli_query($link, $sql)) {
        echo '<p style="color:red;">刪除留言失敗：' . mysqli_error($link) . '</p>';
    }
}

$sql = "SELECT id, title, content, posted_at, author FROM announcements ORDER BY posted_at DESC";
$result = mysqli_query($link, $sql);

if ($result) {
    // 新增公告
    echo '<div class="new-announcement">';
    echo '<form action="" method="post">';
    echo '<input type="hidden" name="new_announcement" value="1">';
    echo '<input type="text" name="title" placeholder="公告標題" required>';
    echo '<textarea name="content" rows="4" placeholder="公告內容" required></textarea>';
    echo '<input type="submit" name="新增公告">';
    echo '</form>';
    echo '</div>';

    // 顯示公告
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="post-box">';
        echo '<div class="post-header">';
        echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
        echo '<small>' . htmlspecialchars(date('Y/m/d H:i', strtotime($row['posted_at']))) . '</small>';
        echo '</div>';
        echo '<div class="post-content">';
        echo '<p>' . htmlspecialchars($row['content']) . '</p>';
        echo '</div>';

        // 留言
        $announcement_id = $row['id'];
        $comment_sql = "SELECT id, comment, posted_at FROM comments WHERE announcement_id = $announcement_id ORDER BY posted_at ASC";
        $comment_result = mysqli_query($link, $comment_sql);

        echo '<div class="comment-section">';
        echo '<hr>';
        echo '<h6>留言區：</h6>';
        if (mysqli_num_rows($comment_result) > 0) {
            while ($comment = mysqli_fetch_assoc($comment_result)) {
                echo '<div class="comment">';
                echo '<p>' . htmlspecialchars($comment['comment']) . '</p>';
                echo '<small>於 ' . htmlspecialchars(date('Y/m/d H:i', strtotime($comment['posted_at']))) . '</small>';
                echo '<form action="" method="post" style="display:inline;">';
                echo '<input type="hidden" name="delete_comment" value="1">';
                echo '<input type="hidden" name="comment_id" value="' . $comment['id'] . '">';
                echo '<button type="submit" style="color:red; background:none; border:none; cursor:pointer;">刪除</button>';
                echo '</form>';
                echo '</div>';
            }
        } else {
            echo '<p>目前沒有留言。</p>';
        }
        echo '</div>'; 
        echo '</div>'; 
    }
} else {
    echo '<p style="color:red;">查詢失敗：' . mysqli_error($link) . '</p>';
}

mysqli_close($link);
?>