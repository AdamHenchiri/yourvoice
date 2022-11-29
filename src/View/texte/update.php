<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Réponses</title>
</head>
<body>
<form method="post" action="frontController.php?controller=reponse&action=updated">
    <fieldset>

        <legend>réponse :</legend>
        <?php

        use App\YourVoice\Model\Repository\SectionRepository;
        use App\YourVoice\Model\Repository\UtilisateurRepository;
        foreach ($textes as $texte){
            $section = (new SectionRepository())->select($texte->getIdSection());
            if ($section){                    ?>

                <input type="hidden" value="<?php echo $section->getIdQuestion()?>" name="id_question" >

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
                <textarea name="texte[]" id="texte[]" cols="90"  rows="6" ><?php echo $texte->getTexte() ?></textarea>
            <?php                $coauteurs=(new \App\YourVoice\Model\Repository\CoauteurRepository())->selectWhere("id_reponse",$texte->getIdReponse());

            }} ?>
        <p>
            <label for="idCoAuteur ">Choisissez les co-auteurs</label> :

            <?php

            $users = (new UtilisateurRepository())->selectAll();
            if ($users){
            foreach($users as $user){
            $aux=false;
            foreach ($coauteurs as $coauteur){
            if($user->getIdUtilisateur()==$coauteur->getIdUtilisateur()){
            ?>
        <div>
            <input type="checkbox"  name="idCoAuteur[]" value="<?php echo $user->getIdUtilisateur()?>" checked >
            <?php echo $user->getLogin() ; $aux = true;?>
        </div>
        <?php }}if($aux===false){ ?>
        <div>
            <input type="checkbox"  name="idCoAuteur[]" value="<?php echo $user->getIdUtilisateur()?>"  >
            <?php echo $user->getLogin() ;?>
        </div>
        <?php }?>

    <?php  }}?>
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
