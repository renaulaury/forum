<?php foreach ($categories as $category) { ?>
  <div class="listCat">
    <div class="cat">
      <p class="up"><a href="index.php?ctrl=topic&action=listTopicsByCategory&id=<?= $category->getId() ?>"><?= $category->getTypeCategory() ?></a> </p>
      <p class="down">Venez discuter avec nous !</p>

    </div>
  </div>

<?php } ?>


<?php foreach ($allTopics as $allTopic) { ?>
  <div class="listCat">
    <div class="cat">
      <p class="nbLastPost"><?= $allTopic->getNbTopic() ?>
        <i class="fa-solid fa-message"></i>
      </p>
    </div>
  </div>

<?php } ?>