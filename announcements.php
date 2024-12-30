<?php
$link = mysqli_connect('localhost', 'root', '', 'school');


$sql = "SELECT id, title, content, posted_at, author FROM announcements ORDER BY posted_at DESC";
$result = mysqli_query($link, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="post-box">';

        echo '<div class="post-header">';
        echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
        echo '<small>' . htmlspecialchars(date('Y/m/d H:i', strtotime($row['posted_at']))) . '</small>';
        echo '</div>';
        echo '<div class="post-content">';
        echo '<p>' . htmlspecialchars($row['content']) . '</p>';
        echo '</div>';

        $announcement_id = $row['id'];
        $comment_sql = "SELECT comment, posted_at FROM comments WHERE announcement_id = $announcement_id ORDER BY posted_at ASC";
        $comment_result = mysqli_query($link, $comment_sql);

        echo '<div class="comment-section">';
        echo '<hr>';
        echo '<h6>留言區：</h6>';
        if (mysqli_num_rows($comment_result) > 0) {
            while ($comment = mysqli_fetch_assoc($comment_result)) {
                echo '<div class="comment">';
                echo '<p>' . htmlspecialchars($comment['comment']) . '</p>';
                echo '<small>於 ' . htmlspecialchars(date('Y/m/d H:i', strtotime($comment['posted_at']))) . '</small>';
                echo '</div>';
            }
        } else {
            echo '<p>目前沒有留言。</p>';
        }
        echo '</div>'; // 

        echo '<div class="comment-box">';
        echo '<form action="add-comment.php" method="post" style="position: relative; padding-bottom: 50px;">';
        echo '<textarea name="comment" rows="3" placeholder="寫下你的留言..." required></textarea>';
        echo '<input type="hidden" name="announcement_id" value="' . $row['id'] . '">';
        echo '<button type="submit" class="submit-btn">提交留言</button>';
        echo '</form>';
        echo '</div>'; 

        echo '</div>'; 
    }
} else {
    echo '<p style="color:red;">查詢失敗：' . mysqli_error($link) . '</p>';
}

mysqli_close($link);
?>
