<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="../src/Style/Style.css" rel="stylesheet" >
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <title>YourVoice</title>
    <meta name="description" content="site de vote YourVoice.com">
    <meta name="author" content="Mme.RATHIER Sylia, Mme.BETTINGER Sarah, M.HARRIBAUD Kim, M.HENCHIRI Adam">

    <title><?php echo $pagetitle; ?></title>
    <!-- Favicon and Apple Icons -->
    <link rel="shortcut icon" href="/img/icons/favicon.ico">
    <link rel="apple-touch-icon" href="/img/icons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/img/icons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/icons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/img/icons/apple-icon-144x144.png">
    <script type="text/javascript" src="js/modernizr-1.0.min.js"></script>

</head>
<body>
<header>
    <nav>
            <div class="col-md-4 col-sm-3">
            <a href="http://www.YourVoice.org/" target="_blank" title="YourVoice" ><h1 class="logo">YourVoice</h1></a>
          </div>
          
        <!-- Votre menu de navigation ici -->
        <ul>
            <li><a href="frontController.php?controller=question&action=readAll"> Q&A </a></li>
            <li><a href="frontController.php?controller=utilisateur&action=readAll"> VOTE </a></li>
            <li><a href="frontController.php?action=readAll&controller=utilisateur"> YOUR QUESTION </a></li>


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
        Forum de vote libre crée par l'équipe de choc (Mme.RATHIER Sylia, Mme.BETTINGER Sarah, M.HARRIBAUD Kim, M.HENCHIRI Adam).
    </p>
</footer>
</body>
</html>