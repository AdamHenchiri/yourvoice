<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Réponses</title>
</head>
<body>
<form method="post" action="#Blank">
    <fieldset>

        <legend>réponse :</legend>

        <?php

        use App\YourVoice\Model\Repository\SectionRepository;
        use App\YourVoice\Model\Repository\UtilisateurRepository;
        foreach ($textes as $texte){
            $section = (new SectionRepository())->select($texte->getIdSection());
            if ($section){                    ?>

                    <input type="hidden" value="<?php echo $section->getIdSection()?>" name="id_section[]" >
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

                <!--<input type="text" placeholder="macron" name="description" id="description" required/>-->
        </p>
                <p id="description">
                <?php
                echo $section->getTexteExplicatif();
                ?>
                </p>

        <p>
            <label for="texte[]">Texte</label> :

        </p>
            <textarea name="texte[]" id="texte[]" cols="90"  rows="6" readonly><?php echo $texte->getTexte() ?></textarea>

        <?php }} ?>
    </fieldset>
</form>
</body>
</html>
