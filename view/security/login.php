

<form action="index.php?ctrl=security&action=login&id=<?= $users->getId() ?>" method="POST">
        <label for="email">Email</label>
        <input type="email" name="email" id="email"><br>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password"><br>

        <input type="submit" name="submit" value="Se connecter">        

    </form>