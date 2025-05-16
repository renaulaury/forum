<?php
$errorMessage = $result["data"]['errorMessage'] ?? null;
?>

<form action="index.php?ctrl=security&action=login&id=" method="POST">
    <legend>Se connecter</legend>

    <?php if (isset($errorMessage)) { ?>
        <div class="error-message">
            <p><?php echo htmlspecialchars($errorMessage); ?></p>
        </div>
    <?php } ?>

    <div class="blockForm title ">
        <p class="mailLogin"><label for="email">Email</label></p>
        <input type="email" name="email" id="email">
    </div>

    <div class="blockForm title">
        <p class="mdpLogin"><label for="password">Mot de passe</label></p>
        <input type="password" name="password" id="password">
    </div>

     <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">

    <p class="button">
        <input class="validInput" type="submit" name="submit" value="Valider">
    </p>

</form>