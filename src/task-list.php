<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php
    if(!empty($_GET['update_comp'])){
        echo '<p>更新完了</p>';
    }
    if(!empty($_GET['delete_comp'])){
        echo '<p>削除完了</p>';
    }
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->query('select * from Task order by task_starttime IS NULL ASC , task_starttime , task_code');
    echo '<table><tr><td>タスク名</td><td>タスク詳細</td><td>開始時刻</td><td></td><td></td></tr>';
    foreach($sql as $row){
        echo '<tr>';
        echo '<td>',$row['task_name'],'</td>';
        echo '<td>',$row['task_detail'],'</td>';
        echo '<td>',$row['task_starttime'],'</td>';
        echo '<td><a href="task-update.php?task_code=',$row['task_code'],'">更新</a></td>';
        echo '<td><a href="task-delete.php?task_code=',$row['task_code'],'">削除</a></td>';
        echo '</tr>';
    }
?>
<?php require 'footer.php'; ?>