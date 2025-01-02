<?php
$listUsers = $result["data"]["listUsers"];
$profile = $result['data']['profile'];
?>



<section>
    <h3 class="titleUsers">Liste des membres</h3>



    <?php if (App\Session::isRoot() || App\Session::isAdmin()) { ?>
        <div class="sectionUsers">
            <div class="listUsers1">

                <p class="thUsers">Membres</p>
                <p class="thUsers">Rôle</p>
                <p class="thUsers">Edit</p>

                <?php
                foreach ($listUsers as $user) {
                    // != apparition Root
                    if ($user->getRole() === 'root') {
                        continue;
                    } ?>

                    <p class="infosUsers"><?= $user->getNickname() ?></p>
                    <p class="infosUsers"><?= $user->getRole() ?></p>

                    <?php
                    // Edit admin par root
                    if (App\Session::isRoot()) { ?>

                        <p class="editUsers"><a href="index.php?ctrl=user&action=editRole&id=<?= $user->getId() ?>"><i class="fa-solid fa-pencil"></i></a></p>

                    <?php // Edit user par admin
                    } else if (App\Session::isAdmin() && $user->getRole() === 'Utilisateur') { ?>

                        <p class="editUsers"><a href="index.php?ctrl=user&action=editRole&id=<?= $user->getId() ?>"><i class="fa-solid fa-pencil"></i></a></p>
                    <?php } else { ?>
                        <p></p>
                <?php }
                } ?>
            </div>
        </div>

    <?php } ?>


    <?php if (!(App\Session::isRoot() || App\Session::isAdmin())) { ?>
        <div class="sectionUsers">
            <div class="listUsers2">
                <p class="thUsers">Membres</p>
                <p class="thUsers">Rôle</p>

                <?php foreach ($listUsers as $user) {
                    // != appartition Root
                    if ($user->getRole() === 'root') {
                        continue;
                    } ?>

                    <p class="infosUsers"><?= $user->getNickname() ?></p>
                    <p class="infosUsers"><?= $user->getRole() ?></p>

            <?php }
            } ?>
            </div>
        </div>

</section>