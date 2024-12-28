<?php
$profile = $result['data']['profile'];

?>

<h3>Profil de <?= $profile->getNickname() ?></h3>
<p>Mail : <span><?= $profile->getEmail() ?></span></p>
<p>Rôle : <span><?= $profile->getRole() ?></span></p>


<a href="index.php?ctrl=user&action=verifDeleteProfile&id= <?= $profile->getId() ?>">Supprimer mon profil</a>