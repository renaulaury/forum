<?php
    $topic = $result["data"]['topic']; 
    $posts = $result["data"]['posts']; 

?>


<?php

if (!empty($posts)) { ?>
    <h2><?= $topic ?></h2>

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
