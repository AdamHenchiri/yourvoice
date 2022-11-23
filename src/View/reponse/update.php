<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Réponses</title>
</head>
<body>
<form method="post" action="frontController.php?controller=reponse&action=updated">
    <fieldset>
        <legend>Creéation d'une réponse :</legend>
        <input type="hidden" value="<?php echo $_GET["id_reponse"]?>" name="id_question" >

        <?php

        use App\YourVoice\Model\Repository\SectionRepository;
        use App\YourVoice\Model\Repository\UtilisateurRepository;
        $sections = (new SectionRepository())->selectWhere("id_question", $_GET['id_question']);
        if ($sections){
            foreach ($sections as $section){ ?>
                <p>
                    <label for="titre">Titre</label> :
                </p>
                <p id="titre">
                    <?php
                    echo $section->getTitre();
                    ?>
                </p>
                <p>
                    <label for="description">Description</label> :
                </p>
                <p id="description">
                    <?php
                    echo $section->getTexteExplicatif();
                    ?>
                </p>

                <p>
                    <label for="texte">Texte</label> :

                </p>
                <textarea name="texte" id="texte" cols="90"  rows="6"></textarea>;

            <?php }}
        ?>

        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>
</body>
</html>
