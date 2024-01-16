<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<h1>タスク更新</h1>
<?php
    $pdo=new PDO($connect, USER, PASS);
    if(!empty($_GET['task_code'])){
        $sql=$pdo->prepare('select * from Task where task_code=?');
        $sql->execute([$_GET['task_code']]);
        foreach($sql as $row){
            echo '<form action="task-update.php" method="post">';
                echo '<input type="hidden" name="task_code" value="',$row['task_code'],'">';
                echo 'タスク名：<input type="text" name="task_name" value="',$row['task_name'],'" required><br>';
                echo 'タスク詳細：<textarea name="task_detail" required>',$row['task_detail'],'</textarea><br>';
                echo 'カテゴリ：';
                echo '<select name="category">';
                echo '<option value="">---</option>';
                $sql=$pdo->query('select * from Category');
                foreach($sql as $row2){
                    if($row['category_code']===$row2['category_code']){
                        echo '<option value="',$row2['category_code'],'" selected>',$row2['category_name'],'</option>';
                    }else{
                        echo '<option value="',$row2['category_code'],'">',$row2['category_name'],'</option>';
                    }
                }
                echo '</select><br>';
                echo '開始時刻：<input type="datetime-local" name="starttime" value="',$row['task_starttime'],'"><br>';
                echo '<input type="submit" value="確定">';
            echo '</form>';
        }
    }
    if(!empty($_POST['task_name'])){
        if(!empty($_POST['category']) && !empty($_POST['starttime'])){
            $sql=$pdo->prepare('update Task set task_name=?, task_detail=?, category_code=?, task_starttime=? where task_code=?;');
            $sql->execute([$_POST['task_name'],$_POST['task_detail'],$_POST['category'],$_POST['starttime'],$_POST['task_code']]);
        }else if(!empty($_POST['category'])){
            $sql=$pdo->prepare('update Task set task_name=?, task_detail=?, category_code=? where task_code=?;');
            $sql->execute([$_POST['task_name'],$_POST['task_detail'],$_POST['category'],$_POST['task_code']]);
        }else if(!empty($_POST['starttime'])){
            $sql=$pdo->prepare('update Task set task_name=?, task_detail=?, task_starttime=? where task_code=?;');
            $sql->execute([$_POST['task_name'],$_POST['task_detail'],$_POST['starttime'],$_POST['task_code']]);
        }else{
            $sql=$pdo->prepare('update Task set task_name=?, task_detail=? where task_code=?;');
            $sql->execute([$_POST['task_name'],$_POST['task_detail'],$_POST['task_code']]);
        }
        echo <<<EOF
        <script>
            location.href='task-list.php?update_comp=1';
        </script>
        EOF;
    }
?>
<?php require 'footer.php'; ?>