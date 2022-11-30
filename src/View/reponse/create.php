<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Réponses</title>
</head>
<body>
<form method="post" action="frontController.php?controller=reponse&action=created">
    <div class="container">
        <div class="container_creerquestion">
            <div class="titre">
                <a id="boutonpublic" class="public"><i class="fa-solid fa-eye"></i> Public</a>
                <h1>CRÉER UNE REPONSE</h1>
            </div>

            <input type="hidden" value="<?php echo $_GET["id_reponse"]?>" name="id_reponse" >
            <input type="hidden" value="<?php echo $_GET["id_question"]?>" name="id_question" >

            <?php

            use App\YourVoice\Model\Repository\SectionRepository;
            use App\YourVoice\Model\Repository\UtilisateurRepository;
            $sections = (new SectionRepository())->selectWhere("id_question", $_GET['id_question']);
            if ($sections){
                foreach ($sections as $section){ ?>
                    <input type="hidden" value="<?php echo $section->getIdSection()?>" name="id_section[]" >

                    <label class="ecart_texte" for="titre">Section : <NOBR class = "texte_des"><?php
                            echo $section->getTitre();
                            ?>
                            </NOBR>
                        </label>
                        <!--                <input type="text" placeholder="macrone" name="titre" id="titre" required/>-->



            <label class="ecart_texte" for="description">Description : <NOBR class = "texte_des"><?php
                            echo $section->getTexteExplicatif();
                            ?>
                        </NOBR>
                        </label>

                        <!--<input type="text" placeholder="macron" name="description" id="description" required/>-->



                    <p>
                        <label for="texte[]">Texte</label>

                    </p>
                    <textarea name="texte[]" id="texte[]" cols="90"  rows="6"></textarea>

                <?php }}
            ?>

            <p>
                <label for="idCoAuteur ">Choisissez les co-auteurs</label> :

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
        </div>
    </div>



</form>
</body>
</html>
