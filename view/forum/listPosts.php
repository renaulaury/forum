<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des posts</h1>

<?php
foreach($posts as $post ){ ?>
    <p><a href="index.php?ctrl=forum&action=lis"><?= $post->getId() ?></a> par <?= $post->getUser() ?></p>
<?php }
