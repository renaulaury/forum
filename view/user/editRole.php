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

        <label for="banTemp">Bannissement temporaire</label>
        <select name="banTemp">
            <h2>Bannissement temporaire</h2>

            <option value="Insultes ou propos offosant">Insultes ou propos offensants</option>
            <option value="Spams ou pub non autorisée">Spam ou publicité non autorisée</option>
            <option value="Perturbation intentionnelle">Perturbation intentionnelle</option>
            <option value="Irrespect des règles de contenu">Non-respect des règles de contenu</option>
            <option value="Irrespect d'un admin">Manque de respect envers les administrateurs</option>
            <option value="Irrespect droits d'auteur">Non-respect des droits d’auteur</option>
        </select>

        <label for="banDef">Bannissement définitif</label>
        <select name="banDef">
            <h2>Bannissement Définitif</h2>

            <option value="Harcèlement ou menaces">Harcèlement ou menaces</option>
            <option value="Contenus illégaux">Contenus illégaux</option>
            <option value="Usurpation d’identité">Usurpation d’identité</option>
            <option value="Répétition d'infractions graves">Répétition d'infractions graves</option>
            <option value="Violation grave des droits d’auteur">Violation grave des droits d’auteur</option>
            <option value="Diffusion de contenus dangereux">Non-respect des droits d’auteur</option>
        </select>

        <label for="raison">Raison :</label>
        <input type="text" name="raison" />


        <p class="button">
            <input class="validInput" type="submit" name="submit" value="Valider">
        </p>
    </form>
</section>