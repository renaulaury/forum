<?php
    $topic = $result["data"]['topic']; 
    $posts = $result["data"]['posts']; 

?>

<h1>Liste des posts</h1>

<?php

if (!empty($posts)) { 
    foreach($posts as $post) { ?>        
        <p><?= $post ?> par <?= $post->getUser() ?> le <?= $post->getPostCreationFr() ?></p>
    <?php }
} else { ?>
    <p>Il n'y a aucun post.</p>
<?php } ?>

