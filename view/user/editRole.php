<?php
$listUsers = $result['data']['listUsers'];
?>


<section>
    <h3 class="titleUsers">Role actuel de <?= $listUsers->getNickname() ?> : <?= $listUsers->getRole() ?></h3>

    <form action="index.php?ctrl=user&action=updateRole" method="post">
        <label for="options">Passer le role à :</label>

        <input type="hidden" name="id" value="<?= $listUsers->getId() ?>"> <!-- Champs caché pour transmettre id  -->

        <select id="options" name="option">
            <option value="Utilisateur">Utilisateur</option>
            <option value="Administrateur">Administrateur</option>
            <option value="Banni Temporairement">Bannissement Temporaire</option>
            <option value="Banni Définitivement">Bannissement Définitif</option>
        </select>


        <p class="button">
            <input class="validInput" type="submit" name="submit" value="Valider">
        </p>
    </form>
</section>