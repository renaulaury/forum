<h1>Inscription</h1>

<form action="index.php?ctrl=security&action=register" method="POST">
    <label for="pseudo">Pseudo</label>
    <input type="text" name="pseudo" id="pseudo"><br>

    <label for="email">Mail</label>
    <input type="email" name="email" id="email"><br>

    <label for="pass1">Mot de passe</label>
    <input type="password" name="password1" id="pass1"><br>

    <label for="pass2">Répéter le mot de passe</label>
    <input type="password" name="password2" id="pass2"><br>
    <input type="submit" name="submit" value="S'enregistrer">
</form>