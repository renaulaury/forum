<?php
$categories = $result["data"]['categories'];
$topics = $result['data']['topics'];

?>

<p class="containColisee"><img class="colisee" src="./public/images/colisee.jpg" alt="Image du colysee sous un couché de soleil bleu rose"></p>
<h1>FORUM</h1>

<section>
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
</section>

<section>
  <h2>Derniers topics :</h2>

  <div class="lastTopics">

    <p class="down">

      <?php foreach ($topics as $topic) { ?>

    <div class="lastTopic">
      <a href="index.php?ctrl=post&action=listPostsByTopic&id=<?= $topic->getId() ?>">

        <p class="space"> <span class="nameTime">par <?= $topic->getNickname() ?> le <?= $topic->getTopicCreationFr() ?></span> </p>
        <p class="titleTopic"><?= $topic->getTopicTitle() ?></p>

        <div class="linePost"></div>
        <p class="nbLastPost"><?= $topic->getNbPost() ?>
          <i class="fa-solid fa-message"></i>
        </p>

      </a>
    </div>
  <?php } ?>

  </div>
</section>