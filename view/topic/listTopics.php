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
    <p><a href="index.php?ctrl=topic&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTopicTitle() ?></a>  par <?= $topic->getUser() ?><?= $topic->getTopicCreationFr() ?></p>
    <?php }
} else { ?>
    <p>Il n'y a aucun topic.</p>
<?php } ?>

<form action="index.php?topic&action=addTopic" method="post">
    <p><label for="topicTitle">Titre</label></p>
    <p><input type="text" id="topicTitle" name="topicTitle"></input> </p>

    <p><label for="textTopic">Message</label></p>
    <p><textarea id="textTopic" name="textTopic"></textarea>

    <p><input class="validInput" type="submit" name="submit" value="Valider"></p>
</form>