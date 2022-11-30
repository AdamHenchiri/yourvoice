<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="../src/Style/connexion.css" rel="stylesheet">
    <link href="../src/Style/view.css" rel="stylesheet">
    <link href="../src/Style/inscription.css" rel="stylesheet">
    <link href="../src/Style/create_question.css" rel="stylesheet">
    <link href="../src/Style/liste_question.css" rel="stylesheet">
    <link href="../src/Style/detail_question.css" rel="stylesheet">
    <link href="../src/Style/create_section.css" rel="stylesheet">
    <link href="../src/Style/alert.css" rel="stylesheet">

    <title>YourVoice</title>
    <script src="https://kit.fontawesome.com/26e0d024d1.js" crossorigin="anonymous" defer></script>
    <meta name="description" content="site de vote YourVoice.com">
    <meta name="author" content="Mme.RATHIER Sylia, Mme.BETTINGER Sarah, M.HARRIBAUD Kim, M.HENCHIRI Adam">
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $pagetitle; ?></title>
    <!-- Favicon and Apple Icons -->
    <link rel="apple-touch-icon" sizes="57x57" href="../img/icons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../img/icons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../img/icons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../img/icons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../img/icons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../img/icons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../img/icons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../img/icons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/icons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="../img/icons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../img/icons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/icons/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../img/icons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

</head>
<body>
<header>
    <nav>
            <!--<div class="col-md-4 col-sm-3">
            <a href="https://webinfo.iutmontp.univ-montp2.fr/~henchiria/sae/web/frontController.php" target="_blank" title="YourVoice" ></a>
          </div>-->
        <div class="container_menu">
        <ul id="menu">
            <li class="active"><a href="https://webinfo.iutmontp.univ-montp2.fr/~henchiria/sae/web/frontController.php"><img id="logo" src="../img/logo.gif"></a></li>
            <li><a href="frontController.php?action=readAll"><i class="fa-sharp fa-solid fa-circle-question"></i> Questions</a></li>
            <li><a href="frontController.php?action=create&controller=question"><i class="fa-solid fa-person-circle-question"></i> Créer question</a></li>
            <li><a href="frontController.php?action=readAll"><i class="fa-solid fa-clipboard-question"></i> Mes questions</a></li>
            <li><a href="frontController.php?controller=utilisateur&action=connexion"><i class="fa-solid fa-check-to-slot"></i> Vote</a></li>
            <li><a href="frontController.php?controller=utilisateur&action=connexion"><i class="fa-solid fa-user"></i> Mon compte</a></li>
        </ul>
        </div>
    

    </nav>
</header>
<main>
    <p>
        <?php
        foreach ($messageFlash as $type=>$messages){
            foreach ($messages as $message){
                echo "<div class='alert alert-$type'>$message</div>";
            }
        }
        ?>
    </p>

    <div class="container_main">
    <?php
    require __DIR__ . "/{$cheminVueBody}";
    ?>
    </div>
</main>
<footer>
    <div class="foot">
        Forum de vote libre crée par (Mme.RATHIER Sylia, Mme.BETTINGER Sarah, M.HARRIBAUD Kim, M.HENCHIRI Adam)
    </div>
</footer>
</body>
</html>