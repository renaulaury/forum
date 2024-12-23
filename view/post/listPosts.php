<?php
    $topic = $result["data"]['topic']; 
    $posts = $result["data"]['posts']; 

?>
<h2>Catégorie : <?= $topic->getCategoryType() ?></h2>

<h3><?= $topic ?></h3>
<p><?= $topic->getTextTopic() ?></p>


<?php

if (!empty($posts)) { ?>  
    

<?php 
    foreach($posts as $post) { ?> 

     <div class="topic">
        <div class="blockTopic">       
            <p class="up"><span class="nameTime">par <?= $post->getUser() ?> le <?= $post->getPostCreationFr() ?></span></p>
            <p class="down"><?= $post ?><p>
        </div>
     </div>
    <?php } ?>
<?php } else { ?>
    <p>Il n'y a aucun post.</p>
<?php } ?>

<?php if (!$topic->getLocked()) { // Vérifie si le topic n'est pas verrouillé ?>
    <form action="index.php?ctrl=post&action=addPost&id=<?= $topic->getId() ?>" method="post">
        <legend>Création d'un post</legend>

        <div class="blockForm">
            <p class="textTopic"><label for="postMsg">Message</label></p>
            <textarea type="text" id="postMsg" name="postMsg"></textarea>
        </div>

        <p class="button">
            <input class="validInput" type="submit" name="submit" value="Valider">
        </p>
    </form>
<?php } else { ?>
    <p>Ce sujet est verrouillé. Vous ne pouvez pas poster de message.</p>
<?php } ?>



<!-- <form action="index.php?ctrl=post&action=addPost&id=<?= $topic->getId() ?>" method="post">
    <legend>Création d'un post</legend>

    <div class="blockForm">
        <p class="textTopic"><label for="postMsg">Message</label></p>
        <textarea type="text" id="postMsg" name="postMsg"></textarea>
    </div>

        <p class="button">
            <input class="validInput" type="submit" name="submit" value="Valider">
        </p>
</form> -->
