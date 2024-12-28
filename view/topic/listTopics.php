<?php
$category = $result["data"]['category'];
$topics = $result["data"]['topics'];
?>

<h2>Catégorie : <?= $category->getTypeCategory() ?></h2>
<h3>Topics</h3>


<?php if (!empty($topics)) { ?>

    <?php foreach ($topics as $topic) {

    ?>
        <div class="topic">
            <div class="blockTopic">
                <p class="up">

                    <span class="nameTime">par <?= $topic->getUser()->getNickname() ?> le <?= $topic->getTopicCreationFr() ?></span>


                    <!-- Si auteur du topic alors tu peux modifier le cadenas-->

                    <?php if ($topic->getUser()->getId() == \App\Session::getUser()->getId()) { ?>
                        <a href="index.php?ctrl=topic&action=lockTopic&id=<?= $topic->getId() ?>">
                            <i class="fa-solid cadenas fa-<?= $topic->getLocked() ? 'lock' : 'unlock' ?>"></i>
                        </a>
                    <?php } else { ?>
                        <i class="fa-solid cadenas fa-<?= $topic->getLocked() ? 'lock' : 'unlock' ?>"></i>
                    <?php } ?>
                </p>

                <p class="down"><a href="index.php?ctrl=post&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= $topic->getTopicTitle() ?></a></p>

            </div>
            <p class="fleche">
                <a href="index.php?ctrl=post&action=listPostsByTopic&id=<?= $topic->getId() ?>">
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </p>
        </div>
    <?php } ?>

<?php } else { ?>
    <p>Il n'y a aucun topic.</p>
<?php } ?>


<?php if (App\Session::getUser()) { ?>
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



<?php } else { ?>
    <p class="msgVer">Vous devez être connecté pour poster un message.</p>
<?php } ?>