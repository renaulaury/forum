<?php
$category = $result["data"]['category'];
$topics = $result["data"]['topics'];
?>


<section>
    <h2>Catégorie : <?= $category->getTypeCategory() ?></h2>
    <h3>Topics</h3>


    <?php if (!empty($topics)) { ?>

        <?php foreach ($topics as $topic) {

        ?>
            <div class="topic">
                <div class="blockTopic">
                    <p class="up">


                        <span class="nameTime">par
                            <?php if ($topic->getUser() == null) { ?>
                                <?= "utilisateur supprimé"; ?>
                            <?php } else { ?>
                                <?= $topic->getUser()->getNickname() ?>
                            <?php } ?>

                            le <?= $topic->getTopicCreationFr() ?>
                        </span>



                        <?php if (\App\Session::getUser()) { //si user co

                            $topicUser = $topic->getUser(); // on stocke le resultat de cette recuperation

                            //$topicUser verif que cest true si true on appelle getId() si c'est faux on recup pas l'id (gestion user delete)
                            if ($topicUser && $topicUser->getId() == \App\Session::getUser()->getId()) { // si user = auteur 
                        ?>
                                <a href="index.php?ctrl=topic&action=lockTopic&id=<?= $topic->getId() ?>">
                                    <i class="fa-solid cadenas fa-<?= $topic->getLocked() ? 'lock' : 'unlock' ?>"></i>

                                <?php } else if (\App\Session::getUser()->isAdmin()) { //si user = admin 
                                ?>
                                    <a href="index.php?ctrl=topic&action=lockTopic&id=<?= $topic->getId() ?>">
                                        <i class="fa-solid cadenas fa-<?= $topic->getLocked() ? 'lock' : 'unlock' ?>"></i>

                                    <?php } else { //si user !auteur
                                    ?>
                                        <i class="fa-solid cadenas fa-<?= $topic->getLocked() ? 'lock' : '' ?>"></i>
                                    <?php } ?>

                                <?php } else { //si visiteur 
                                ?>
                                    <i class="fa-solid cadenas fa-<?= $topic->getLocked() ? 'lock' : '' ?>"></i>
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
</section>

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