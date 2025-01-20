<?php
$profile = $result['data']['profile'];
?>

<p class="alertDelete">Attention toute suppression est définitive !</p>

<form class="buttonDelete" action="index.php?ctrl=user&action=deleteProfile&id=<?= $profile->getId() ?>" method="post">

    <p class="buttonDelete">
        <input type="submit" name="submit" value="Confirmer la suppression de mon profil" />
    </p>

</form>