<?php
$profile = $result['data']['profile'];

?>

<h3>Profil de <?= $profile->getNickname() ?></h3>
<p>Mail : <span><?= $profile->getEmail() ?></span></p>
<p>Rôle : <span><?= $profile->getRole() ?></span></p>


<a href="index.php?ctrl=security

//Faire un lien qui mene vers un bouton de validation ?


<form action=" index.php?ctrl=user&action=deleteProfile&id=<?= $profile->getId() ?>" method="post">
    <input type="submit" name="submit" value="Supprimer mon profil" />
    </form>