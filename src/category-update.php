<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<h1>カテゴリ更新</h1>
<?php
    $pdo=new PDO($connect, USER, PASS);
    if(!empty($_GET['category_code'])){
        $sql=$pdo->prepare('select * from Category where category_code=?');
        $sql->execute([$_GET['category_code']]);
        foreach($sql as $row){
            echo '<form action="category-update.php" method="post">';
                echo '<input type="hidden" name="category_code" value="',$row['category_code'],'">';
                echo 'カテゴリ名：<input type="text" name="category_name" value="',$row['category_name'],'" required><br>';
                echo '<input type="submit" value="確定">';
            echo '</form>';
        }
    }
    if(!empty($_POST['category_code'])){
        $sql=$pdo->prepare('update Category set category_name=? where category_code=?');
        $sql->execute([$_POST['category_name'],$_POST['category_code']]);
        echo <<<EOF
        <script>
            location.href='category-list.php?update_comp=1';
        </script>
        EOF;
    }
?>
<?php require 'footer.php'; ?>