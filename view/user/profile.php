<?php
$profile = $result['data']['profile'];

?>

<section id="profile">
    <div id="editProfile" class="containInfosProfile">
        <h2>Profil de <?= $profile->getNickname() ?>
            <a class=" editH2" href="#" onclick="toggleEditProfile();"><i class=" fa-solid fa-pencil"></i></a>
        </h2>

        <div class="containProfile">
            <p>Inscrit depuis le : <?= $profile->getDateInscription() ?></p>
            <p>Rôle : <span><?= $profile->getRole() ?></span></p>
            <?php if (($profile->getRole() === 'Banni temporairement') || ($profile->getRole() === 'Banni temporairement')) { ?>
                <p>Jusqu'au : <span><?= $profile->getDateEndBan() ?></span></p>
                <p>Si la date si dessus est dépassée, pensez à vous reconnecter pour mettre à jour vos droits.</p>
            <?php } ?>
        </div>

        <div class="containInfos">
            <p>Mail : <span><?= $profile->getEmail() ?></span></p>
            <p>Mot de passe</p>
        </div>

        <div class="containDelProfile">
            <a class="delProfile" href="index.php?ctrl=user&action=verifDeleteProfile&id= <?= $profile->getId() ?>">Supprimer mon profil</a>
        </div>
    </div>



    <form id="formProfile" style="display: none;" method="index.php?ctrl=user&action=editProfile" action="POST">
        <div class="containEditProfile">
            <div class="editNicknameMail">
                <div class="blockForm title">
                    <p class="mailLogin"><label for="nickname">Pseudo</label></p>
                    <input type="text" name="nickname" id="nickname"></input>
                </div>

                <div class="blockForm title">
                    <p class="mailLogin"><label for="email">Mail</label></p>
                    <input type="email" name="email" id="email"></input>
                </div>
            </div>

            <div id="editPassword">
                <div>
                    <div class="blockForm title">
                        <p class="mailLogin"><label for="pass1">Mot de passe</label></p>
                        <input type="password" name="password1" id="pass1"></input>
                    </div>

                    <div>
                        <div class="blockForm title">
                            <p class="mailLogin"><label for="pass2">Répéter le mot de passe</label></p>
                            <input type="password" name="password2" id="pass2" placeholder="12 caractères, 1 majuscules, 1 chiffre et 1 caractère spécial"></input>
                        </div>
                    </div>
                </div>
            </div>

            <p class="button">
                <input type="submit" name="submit" value="Editer">
            </p>

        </div>
    </form>


</section>