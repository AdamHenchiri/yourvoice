<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="../src/Style/Style.css" rel="stylesheet" >
    <title>YourVoice</title>
    <meta name="description" content="site de vote YourVoice.com">
    <meta name="author" content="Mme.RATHIER Sylia, Mme.BETTINGER Sarah, M.HARRIBAUD Kim, M.HENCHIRI Adam">
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

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
            <div class="col-md-4 col-sm-3">
            <a href="https://webinfo.iutmontp.univ-montp2.fr/~henchiria/sae/web/frontController.php" target="_blank" title="YourVoice" ><h1 class="logo"><img class="logo" src="../img/Logo.png">YourVoice</h1></a>
          </div>
          
        <!-- Votre menu de navigation ici -->
        <ul>
            <li><a href="frontController.php?action=readAll&controller=question"> QUESTIONS </a></li>
            <li><a href="frontController.php?controller=question&action=create"> CRÉER QUESTION </a></li>
            <li><a href="#"> MES QUESTIONS </a></li>
            <li><a href="#"> VOTE </a></li>
            <li><a href="frontController.php?controller=utilisateur&action=connexion"> MON COMPTE </a></li>



        </ul>
    </nav>
</header>
<main>
    <?php
    require __DIR__ . "/{$cheminVueBody}";
    ?>
</main>
<footer>
    <p>
        Forum de vote libre créé par l'équipe de choc (Mme.BETTINGER Sarah, M.HARRIBAUD Kim, M.HENCHIRI Adam, Mme.RATHIER Sylia).
    </p>
</footer>
</body>
</html>