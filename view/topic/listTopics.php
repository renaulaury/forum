<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h2>Topics</h2>



<?php
if (!empty($topics)) { ?>
    <h2>Catégorie : <?= $category->getTypeCategory() ?></h2>

    <?php
    foreach($topics as $topic ){ ?>

        <div class="topic">
                <div class="blockTopic">
                    <p class="up">
                        <span class="nameTime">par <?= $topic->getUser() ?> le <?= $topic->getTopicCreationFr() ?></span> 
                    </p>
                    <p class="down"><a href="index.php?ctrl=post&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTopicTitle() ?></a> </p>
                </div>
                <p class="fleche"><a href="index.php?ctrl=post&action=listPostsByTopic&id=<?= $topic->getId() ?>"><i class="fa-solid fa-arrow-right"></i></a> </p>
        </div>
    <?php } ?>
<?php } else { ?>
    <p>Il n'y a aucun topic.</p>
<?php } ?>


<form action="index.php?ctrl=topic&action=addTopic&id=<?= $category->getId() ?>" method="post">
    <legend>Création d'un topic</legend>
    
    <div class="blockForm title">
        <p class="topicTitle"><label for="topicTitle">Titre</label></p>
        <input type="text" id="topicTitle" name="topicTitle"></input> 
    </div>

    <div class="blockForm">
        <p class="textTopic"><label for="textTopic">Message</label></p>
        <textarea id="textTopic" name="textTopic"></textarea>
    </div>

    <p class="button">
        <input class="validInput" type="submit" name="submit" value="Valider">
    </p>
</form>