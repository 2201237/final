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
    $sql=$pdo->query('select * from Category order by category_code');
    echo '<table><tr><td>カテゴリ名</td></tr>';
    foreach($sql as $row){
        echo '<tr>';
        echo '<td>',$row['category_name'],'</td>';
        echo '<td><a href="category-update.php?category_code=',$row['category_code'],'">更新</a></td>';
        echo '<td><a href="category-delete.php?category_code=',$row['category_code'],'">削除</a></td>';
        echo '</tr>';
    }
?>
<?php require 'footer.php'; ?>