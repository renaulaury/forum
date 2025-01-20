<?php
$topic = $result["data"]['topic'];
$posts = $result["data"]['posts'];
?>

<p class="containColisee"><img class="colisee" src="./public/images/colisee.jpg" alt="Image du colysee sous un couché de soleil bleu rose"></p>
<h1 class="titleForum">FORUM</h1>

<section>
    <h2>Catégorie : <?= $topic->getCategoryType() ?></h2>

    <div class="topic">
        <div class="up">
            <span class="nameTime">par <?= $topic->getNickname() ?> le <?= $topic->getTopicCreationFr() ?></span>
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



<p class="msgVer">Vous devez être connecté pour poster un message.</p>