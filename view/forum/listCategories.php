<?php
$categories = $result["data"]['categories'];
?>
<!-- Affiche la liste des catégories
Le lien doit emmener a la liste des topics  -->

<div>
    <h2>Catégories</h2>


    <?php
    foreach ($categories as $category) { ?>
        <div class="listCat">
            <div class="cat">
                <p class="up"><a href="index.php?ctrl=topic&action=listTopicsByCategory&id=<?= $category->getId() ?>"><?= $category->getTypeCategory() ?></a> </p>
                <p class="down">Venez discuter avec nous !</p>
            </div>
        </div>

    <?php } ?>
</div>

<h2>Derniers posts :</h2>
<div>

</div>