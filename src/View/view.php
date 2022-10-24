<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="../src/Style/Style.css" rel="stylesheet" >

    <title><?php echo $pagetitle; ?></title>
</head>
<body>
<header>
    <nav>
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