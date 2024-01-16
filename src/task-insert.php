<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<h1>タスク登録</h1>
<?php
    echo '<form action="task-insert.php" method="post">';
        echo 'タスク名：<input type="text" name="task_name" value="" required><br>';
        echo 'タスク詳細：<textarea name="task_detail" required></textarea><br>';
        echo 'カテゴリ：';
        echo '<select name="category">';
        echo '<option value="">---</option>';
        $pdo=new PDO($connect, USER, PASS);
        $sql=$pdo->query('select * from Category');
        foreach($sql as $row){
            echo '<option value="',$row['category_code'],'">',$row['category_name'],'</option>';
        }
        echo '</select><br>';
        echo '開始時刻：<input type="datetime-local" name="starttime"><br>';
        echo '<input type="submit" value="確定">';
    echo '</form>';
    if(!empty($_POST['task_name'])){
        if(!empty($_POST['category']) && !empty($_POST['starttime'])){
            $sql=$pdo->prepare('insert into Task (task_name,task_detail,category_code,task_starttime) values(?,?,?,?)');
            $sql->execute([$_POST['task_name'],$_POST['task_detail'],$_POST['category'],$_POST['starttime']]);
        }else if(!empty($_POST['category'])){
            $sql=$pdo->prepare('insert into Task (task_name,task_detail,category_code) values(?,?,?)');
            $sql->execute([$_POST['task_name'],$_POST['task_detail'],$_POST['category']]);
        }else if(!empty($_POST['starttime'])){
            $sql=$pdo->prepare('insert into Task (task_name,task_detail,task_starttime) values(?,?,?)');
            $sql->execute([$_POST['task_name'],$_POST['task_detail'],$_POST['starttime']]);
        }else{
            $sql=$pdo->prepare('insert into Task (task_name,task_detail) values(?,?)');
            $sql->execute([$_POST['task_name'],$_POST['task_detail']]);
        }
        echo '登録完了';
    }
?>
<?php require 'footer.php'; ?>