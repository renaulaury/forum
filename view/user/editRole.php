<?php
$listUsers = $result['data']['listUsers'];
?>


<section>
    <h3 class="titleUsers">Role actuel de <?= $listUsers->getNickname() ?> : <?= $listUsers->getRole() ?></h3>

    <form action="index.php?ctrl=user&action=updateRole" method="post">
        <div class="chooseRole">
            <label for="options">Passer le role à :</label>

            <input type="hidden" name="id" value="<?= $listUsers->getId() ?>"> <!-- Champs caché pour transmettre id  -->

            <select id="options" name="option" onchange="toggleBanOptions()">
                <option value="Utilisateur">Utilisateur</option>
                <option value="Administrateur">Administrateur</option>
                <option value="Banni Temporairement">Bannissement Temporaire</option>
                <option value="Banni Définitivement">Bannissement Définitif</option>
            </select>
        </div>

        <div id="banTempDiv" style="display: none;">
            <h3 class="titre">
                <i class="fa-solid fa-triangle-exclamation"></i>Bannissement temporaire
            </h3>

            <div class="chooseBan">
                <label for="banTemp">Raison :</label>
                <select name="banTemp">
                    <option value="Insultes ou propos offosant">Insultes ou propos offensants</option>
                    <option value="Spams ou pub non autorisée">Spam ou publicité non autorisée</option>
                    <option value="Perturbation intentionnelle">Perturbation intentionnelle</option>
                    <option value="Irrespect des règles de contenu">Non-respect des règles de contenu</option>
                    <option value="Irrespect d'un admin">Manque de respect envers les administrateurs</option>
                    <option value="Irrespect droits d'auteur">Non-respect des droits d’auteur</option>
                </select>
            </div>

            <div class="containBan">
                <label for="raison">Précision :</label>
                <input class="raisonBan" type="text" name="raison" />
            </div>
        </div>

        <div id="banDefDiv" style="display: none;">
            <h3 class="titre">
                <i class="fa-solid fa-triangle-exclamation"></i>Bannissement définitif
            </h3>

            <div class="chooseBan">
                <label for="banTemp">Raison :</label>
                <select name="banDef">
                    <option value="Harcèlement ou menaces">Harcèlement ou menaces</option>
                    <option value="Contenus illégaux">Contenus illégaux</option>
                    <option value="Usurpation d’identité">Usurpation d’identité</option>
                    <option value="Répétition d'infractions graves">Répétition d'infractions graves</option>
                    <option value="Violation grave des droits d’auteur">Violation grave des droits d’auteur</option>
                    <option value="Diffusion de contenus dangereux">Non-respect des droits d’auteur</option>
                </select>
            </div>

            <div class="containBan">
                <label for="raison">Précision :</label>
                <input class="raisonBan" type="text" name="raison" />
            </div>
        </div>




        <p class="button">
            <input class="validInput" type="submit" name="submit" value="Valider">
        </p>
    </form>
</section>