<?php
$errorMessage = $result["data"]['errorMessage'] ?? null; // Récupérer le message d'erreur
?>

<form action="index.php?ctrl=security&action=register" method="POST">
    <legend>Créer un compte</legend>

    <?php if (isset($errorMessage) && $errorMessage) { ?>
        <div class="error-message">
            <?= htmlspecialchars($errorMessage) ?>
        </div>
    <?php } ?>


    <div class="blockForm title">
        <p class="mailLogin"><label for="nickname">Pseudo</label></p>
        <input type="text" name="nickname" id="nickname"></input>
    </div>

    <div class="blockForm title">
        <p class="mailLogin"><label for="email">Mail</label></p>
        <input type="email" name="email" id="email"></input>
    </div>

    <div class="blockForm title">
        <p class="mailLogin"><label for="pass1">Mot de passe</label></p>
        <input type="password" name="password1" id="pass1"></input>
    </div>

    <div class="blockForm title">
        <p class="mailLogin"><label for="pass2">Répéter le mot de passe</label></p>
        <input type="password" name="password2" id="pass2" placeholder="12 caractères, 1 majuscules, 1 chiffre et 1 caractère spécial"></input>
    </div>

    <div class="checkbox-container">
        <label>
            <input type="checkbox" name="terms" id="terms" checked>
            Accepter le <a href="index.php?ctrl=forum&action=reglement" target="_blank">Réglement du forum</a>
        </label>
    </div>


    <p class="button">
        <input type="submit" name="submit" value="Créer">
    </p>
</form>