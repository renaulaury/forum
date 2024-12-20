

<form action="index.php?ctrl=security&action=login&id=" method="POST">
    <legend>Se connecter</legend>

    <div class="blockForm title ">
        <p class="mailLogin"><label for="email">Email</label></p>
        <input type="email" name="email" id="email"></input>
    </div>

    <div class="blockForm title">
        <p class="mdpLogin"><label for="password">Mot de passe</label></p>
        <input type="password" name="password" id="password"></input>
    </div>

    <p class="button">
        <input class="validInput" type="submit" name="submit" value="Valider">
    </p>      

    </form>