<?php
$listUsers = $result["data"]["listUsers"];
$profile = $result['data']['profile'];
?>



<section>
    <h3 class="titleUsers">Liste des membres</h3>

    <div class="sectionUsers">
        <div class="listUsers">

            <p class="thUsers">Membres</p>
            <p class="thUsers">Rôle</p>
            <p class="thUsers">Edit</p>


            <?php
            foreach ($listUsers as $user) {
                if ($user->getRole() === 'root') {
                    continue;
                }

                if (App\Session::isRoot()) {
            ?>

                    <p class="infosUsers"><?= $user->getNickname() ?></p>
                    <p class="infosUsers"><?= $user->getRole() ?></p>
                    <p class="editUsers"><a href="index.php?ctrl=user&action=editRole&id=<?= $user->getId() ?>"><i class="fa-solid fa-pencil"></i></a></p>

                <?php } else if (App\Session::isAdmin() && $user->getRole() !== 'admin') {
                ?>
                    <p class="infosUsers"><?= $user->getNickname() ?></p>
                    <p class="infosUsers"><?= $user->getRole() ?></p>
                    <p class="editUsers"><a href="index.php?ctrl=user&action=editRole&id=<?= $user->getId() ?>"><i class="fa-solid fa-pencil"></i></a></p>

                <?php  } else { ?>
                    <p class="infosUsers"><?= $user->getNickname() ?></p>
                    <p class="infosUsers"><?= $user->getRole() ?></p>
            <?php
                }
            } ?>
        </div>
    </div>
</section>