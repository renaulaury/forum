<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $meta_description ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/style.css">
    <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/media_quieries.css">
    <title>FORUM</title>
</head>

<body>
    <div id="wrapper">
        <div id="mainpage">
            <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
            <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
            <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>

            <header>
                <nav>


                    <div class="blockHeader">
                        <p id="accessibilite"><i class="fa-solid fa-person"></i></p>

                        <div class="accessColors">
                            <div>
                                <p><i class="fa-solid fa-circle dark" data-color="dark"></i></p>
                                <p><i class="fa-solid fa-circle light" data-color="light"></i></p>
                            </div>
                            <p class="linePost"></p>
                            <div class="listColor">
                                <p><i class="fa-solid fa-circle peach" data-color="peach"></i></p>
                                <p><i class="fa-solid fa-circle blue" data-color="blue"></i></p>
                                <p><i class="fa-solid fa-circle purple" data-color="purple"></i></p>
                                <p><i class="fa-solid fa-circle green" data-color="green"></i></p>
                            </div>
                        </div>


                        <ol id="navbar">
                            <li><a href="index.php?ctrl=home&action=home">Accueil</a></li>

                            <?php
                            // si l'utilisateur est connecté 
                            if (App\Session::getUser()) {
                            ?>
                                <li><a href="index.php?ctrl=user&action=listUsers">Liste des membres</a></li>
                                <li><a href="index.php?ctrl=user&action=profile"><span class="fas fa-user"></span>&nbsp;Bienvenue <?= App\Session::getUser() ?> !</a></li>
                                <li><a href="index.php?ctrl=security&action=logout">Déconnexion</a></li>
                            <?php
                            } else {
                            ?>
                                <li><a href="index.php?ctrl=security&action=login">Connexion</a></li>
                                <li><a href="index.php?ctrl=security&action=register">Inscription</a></li>
                            <?php
                            }
                            ?>
                        </ol>

                        <div class="burger_button">
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                    </div>

                    <div class="bande"></div>

                </nav>
            </header>

            <main id="forum">
                <?= $page ?>
            </main>
        </div>
        <footer>
            &copy; <?= date_create("now")->format("Y") ?> Lily <a href="index.php?ctrl=forum&action=reglement">Règlement du forum</a> <a href="#">Mentions légales</a>
        </footer>
    </div>
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $(".message").each(function() {
                if ($(this).text().length > 0) {
                    $(this).slideDown(500, function() {
                        $(this).delay(3000).slideUp(500)
                    })
                }
            })
            $(".delete-btn").on("click", function() {
                return confirm("Etes-vous sûr de vouloir supprimer?")
            })
            tinymce.init({
                selector: '.post',
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                content_css: '//www.tiny.cloud/css/codepen.min.css'
            });
        })
    </script>
    <script src="<?= PUBLIC_DIR ?>/js/burger.js"></script>
    <script src="<?= PUBLIC_DIR ?>/js/formBan.js"></script>
    <script src="<?= PUBLIC_DIR ?>/js/formEditProfile.js"></script>
    <script src="<?= PUBLIC_DIR ?>/js/accessibilite.js"></script>
</body>

</html>