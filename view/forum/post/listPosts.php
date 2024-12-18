<?php
    $topic = $result["data"]['topic']; 
    $posts = $result["data"]['posts']; 

?>

<h1>Liste des posts</h1>

<?php

if (!empty($posts)) { ?>
    <h2><?= $topic ?></h2>

<?php 
    foreach($posts as $post) { ?>        
        <p><?= $post ?> par <?= $post->getUser() ?> le <?= $post->getPostCreationFr() ?></p>
    <?php }
} else { ?>
    <p>Il n'y a aucun post.</p>
<?php } ?>


<form action="index.php?ctrl=post&action=addPost&id=<?= $topic->getId() ?>" method="post">
    <p><label for="postMsg">Message</label></p>
    <p><textarea type="text" id="postMsg" name="postMsg"></textarea></p>

    <p><input class="validInput" type="submit" name="submit" value="Valider"></p>
</form>
