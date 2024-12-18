<?php
    $categories = $result["data"]['categories']; 
?>
<!-- Affiche la liste des catégories
Le lien doit emmener a la liste des topics  -->


<h1>Liste des catégories</h1>

<?php
foreach($categories as $category ){ ?>
    <p><a href="index.php?ctrl=topic&action=listTopicsByCategory&id=<?= $category->getId() ?>"><?= $category->getTypeCategory() ?></a> </p>
<?php }


  
