<?php
$listUsers = $result["data"]["listUsers"];
?>

<h3>Liste des membres</h3>


<?php

foreach ($listUsers as $user) { ?>
    <div>
        <p>Membre : <span><?= $user->getNickname() ?></span>
        <p>Email : <span><?= $user->getEmail() ?></span>
        <p>Rôle : <span><?= $user->getRole() ?></span>
    </div>

<?php } ?>