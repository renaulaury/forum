<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des topics</h1>



<?php
if (!empty($topics)) { ?>
    <h2>Catégorie : <?= $category->getTypeCategory() ?></h2>

    <?php
    foreach($topics as $topic ){ ?>
    <p><a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTopicTitle() ?></a>  par <?= $topic->getUser() ?><?= $topic->getTopicCreationFr() ?></p>
    <?php }
} else { ?>
    <p>Il n'y a aucun topic.</p>
<?php } ?>

