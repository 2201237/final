<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php
    if(!empty($_GET['task_code'])){
        $pdo=new PDO($connect, USER, PASS);
        $sql=$pdo->prepare('DELETE FROM Task WHERE task_code=?');
        $sql->execute([$_GET['task_code']]);
        echo <<<EOF
        <script>
            location.href='task-list.php?delete_comp=1';
        </script>
        EOF;
    }else{
        echo '<p>タスク一覧からアクセスしてください</p>';
    }
?>
<?php require 'footer.php'; ?>