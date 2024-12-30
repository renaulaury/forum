<?php
$topic = $result["data"]['topic'];
$posts = $result["data"]['posts'];
?>

<p class="containColisee"><img class="colisee" src="./public/images/colisee.jpg" alt="Image du colysee sous un couché de soleil bleu rose"></p>
<h1>FORUM</h1>

<section>
    <h2>Catégorie : <?= $topic->getCategoryType() ?></h2>

    <div class="topic">
        <div class="up">
            <span class="nameTime">par <?= $topic->getUser()->getNickname() ?> le <?= $topic->getTopicCreationFr() ?></span>
            <h4><?= $topic ?></h4>
            <p><?= $topic->getTextTopic() ?></p>
        </div>
    </div>


    <?php

    if (!empty($posts)) { ?>

        <?php
        foreach ($posts as $post) { ?>

            <div class="topic">
                <div class="blockTopic">
                    <p class="up"><span class="nameTime">par <?= $post->getUser() ?> le <?= $post->getPostCreationFr() ?></span></p>
                    <p class="down"><?= $post ?>
                    <p>
                </div>
            </div>
        <?php } ?>

    <?php } else { ?>
        <p class="noPost">Il n'y a aucun post.</p>
    <?php } ?>
</section>


<?php if (App\Session::getUser()) { ?>
    <?php if (!$topic->getLocked()) { // Vérif si topic n'est pas ver 
    ?>

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
        <p class="msgVer">Ce sujet est verrouillé. Vous ne pouvez pas poster de message.</p>
    <?php } ?>

<?php } else { ?>
    <p class="msgVer">Vous devez être connecté pour poster un message.</p>
<?php } ?>