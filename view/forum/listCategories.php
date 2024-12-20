<?php
    $categories = $result["data"]['categories']; 
?>
<!-- Affiche la liste des catégories
Le lien doit emmener a la liste des topics  -->


<h2>Catégories</h2>


    <?php
        foreach($categories as $category ){ ?>
            <div class="listCat">
                <div class="cat">
                    <p class="up"><a href="index.php?ctrl=topic&action=listTopicsByCategory&id=<?= $category->getId() ?>"><?= $category->getTypeCategory() ?></a> </p>
                    <p class="down">Venez discuter avec nous !</p>
                </div>
            </div>
            
    <?php } ?>

    <h2>Nouveaux posts :</h2>
    
    <div class="lastPosts">
        <p class="lastPost">1</p>
        <p class="lastPost">2</p>
        <p class="lastPost">3</p>
    </div>


  
