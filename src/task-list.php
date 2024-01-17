<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php
    $pdo=new PDO($connect,USER,PASS);
    if(!empty($_GET['update_comp'])){
        echo '<p>更新完了</p>';
    }
    if(!empty($_GET['delete_comp'])){
        echo '<p>削除完了</p>';
    }
    echo '<form action="task-list.php" method="post" id="submit_form">';
        echo '絞り込み：';
        echo '<select name="category" id="submit_item">';
            echo '<option value="">---</option>';
            $sql=$pdo->query('select * from Category');
            foreach($sql as $row){
                echo '<option value="',$row['category_code'],'">',$row['category_name'],'</option>';
            }
        echo '</select><br>';
    echo '</form>';
    if(!empty($_POST['category'])){
        $sql=$pdo->prepare('select * from Task where category_code=? order by task_starttime IS NULL ASC , task_starttime , task_code');
        $sql->execute([$_POST['category']]);
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
    }else{
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
    }
?>
<script src="js/jquery-3.7.1.min.js"></script>
<script>
  $(function(){
    $("#submit_item").change(function(){
      $("#submit_form").submit();
    });
  });
</script>
<?php require 'footer.php'; ?>