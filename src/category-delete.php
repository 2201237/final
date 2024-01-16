<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php
    if(!empty($_GET['category_code'])){
        $pdo=new PDO($connect, USER, PASS);
        $sql=$pdo->prepare('DELETE FROM Category WHERE category_code=?');
        $sql->execute([$_GET['category_code']]);
        echo <<<EOF
        <script>
            location.href='category-list.php?delete_comp=1';
        </script>
        EOF;
    }else{
        echo '<p>カテゴリ一覧からアクセスしてください</p>';
    }
?>
<?php require 'footer.php'; ?>