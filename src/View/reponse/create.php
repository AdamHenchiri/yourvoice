<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Réponses</title>
</head>
<body>
<form method="post" action="frontController.php?controller=reponse&action=created">
    <fieldset>
        <legend>Creéation d'une réponse :</legend>
        <input type="hidden" value="<?php echo $_GET["id_question"]?>" name="id_question" >

        <?php

        use App\YourVoice\Model\Repository\SectionRepository;
        use App\YourVoice\Model\Repository\UtilisateurRepository;
        $sections = (new SectionRepository())->selectWhere("id_question", $_GET['id_question']);
        if ($sections){
        foreach ($sections as $section){ ?>
            <p>
            <label for="titre">Titre</label> :
<!--                <input type="text" placeholder="macrone" name="titre" id="titre" required/>-->
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
            <label for="texte">Texte</label> :
            <textarea name="texte" id="titre"></textarea>;
        </p>

                <?php }}
            ?>

        <p>
            <label for="votants ">Choisissez les co-auteurs</label> :

            <?php


            $users = (new UtilisateurRepository())->selectAll();
            if ($users){
            foreach($users as $user)
            {
            ?>
        <div>
            <input type="checkbox"  name="idCoAuteur[]" value="<?php echo $user->getIdUtilisateur()?>">
            <?php echo $user->getLogin()?>
        </div>
    <?php } }?>
        </p>


        <p>
            <label for="id_utilisateur">Serra rempli automatiquement avec les sessions</label> :
            <input type="int" placeholder="serra rempli automatiquement avec les sessions" name="id_utilisateur" id="id_utilisateur" required/>


        <p>

        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>
</body>
</html>
