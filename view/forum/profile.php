<?php
$profile = $result['data']['profile'];

?>

<h3>Profil de <?= $profile->getNickname() ?></h3>
<p>Mail : <span><?= $profile->getEmail() ?></span></p>
<p>Rôle : <span><?= $profile->getRole() ?></span></p>