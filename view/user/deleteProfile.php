<?php
$profile = $result['data']['profile'];
?>

<form action="index.php?ctrl=user&action=deleteProfile&id=<?= $profile->getId() ?>" method="post">
    <input type="submit" name="submit" value="Confirmer la suppression de mon profil" />
</form>