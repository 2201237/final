<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<h1>カテゴリ登録</h1>
<form action="category-insert.php" method="post">
    カテゴリ名：<input type="text" name="category_name" value="" required><br>
    <input type="submit" value="確定">
</form>
<?php
    if(!empty($_POST['category_name'])){
        $pdo=new PDO($connect, USER, PASS);
        $sql=$pdo->prepare('insert into Category (category_name) values(?)');
        $sql->execute([$_POST['category_name']]);
        echo '登録完了しました。';
    }
?>
<?php require 'footer.php'; ?>