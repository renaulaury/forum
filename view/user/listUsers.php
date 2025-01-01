<?php
$listUsers = $result["data"]["listUsers"];
?>



<section>
    <h3 class="titleUsers">Liste des membres</h3>

    <div class="sectionUsers">
        <div class="listUsers">

            <p class="thUsers">Membres</p>
            <p class="thUsers">Rôle</p>
            <p class="thUsers">Edit</p>


            <?php
            foreach ($listUsers as $user) { ?>

                <p class="infosUsers"><?= $user->getNickname() ?></p>
                <p class="infosUsers"><?= $user->getRole() ?></p>
                <p class="editUsers"><a href="index.php?ctrl=user&action=updateRole"><i class="fa-solid fa-pencil"></i></a></p>

            <?php } ?>
        </div>
    </div>
</section>