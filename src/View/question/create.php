<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Créer Question</title>
</head>
<body>
<form method="post" action="frontController.php?controller=question&action=created" name="creationQuestion" id="creationQuestion" onsubmit="return validation()">

    <fieldset>
        <legend>Créer une question :</legend>
        <p>
            <label for="intitule">Intitulé</label>
        </p>
            <textarea placeholder="Comment allez-vous ?" name="intitule" id="intitule" cols="60" , rows="1" required></textarea>

        <p>
            <label for="explication">Développement de la question</label>
        </p>
            <textarea placeholder="Comment répondriez vous à cette question ...." name="explication" id="explication" cols="90" , rows="6" required></textarea>

        <p>
            <label for="dateDebut_redaction">Début de la rédaction</label>
            <input type="date" placeholder="" name="dateDebut_redaction" id="dateDebut_redaction" readonly/>
        </p>

        <p>
            <label for="dateFin_redaction">Fin de la rédaction</label>
            <input type="date" placeholder="" name="dateFin_redaction" id="dateFin_redaction" required

            />
        </p>

        <p>
            <label for="dateDebut_vote">Début du vote</label>
            <input type="date" placeholder="" name="dateDebut_vote" id="dateDebut_vote" required/>
        </p>

        <p>
            <label for="dateFin_vote">Fin du vote</label>
            <input type="date" placeholder="" name="dateFin_vote" id="dateFin_vote" required/>
        </p>

        <p>
            <label for="id_utilisateur">Serra rempli automatiquement avec les sessions</label> :
            <input type="int" placeholder="serra rempli automatiquement avec les sessions" name="id_utilisateur" id="id_utilisateur" required/>


        <p>
            <label for="contributeurs">Choisissez les contributeurs</label> :

            <?php

            use App\YourVoice\Model\Repository\UtilisateurRepository;
            $users = (new UtilisateurRepository())->selectAll();
            if ($users){
            foreach($users as $user)
            {
            ?>
        <div>
            <input type="checkbox" name="idContributeur[]" value="<?php echo $user->getIdUtilisateur()?>">
            <?php echo $user->getLogin()?>
        </div>
    <?php } }?>
        </p>

        <p>
            <label for="votants ">Choisissez les votants</label> :

            <?php


            $users = (new UtilisateurRepository())->selectAll();
            if ($users){
            foreach($users as $user)
            {
            ?>
        <div>
            <input type="checkbox"  name="idVotant[]" value="<?php echo $user->getIdUtilisateur()?>">
            <?php echo $user->getLogin()?>
        </div>
    <?php } }?>
        </p>

        <p>
            <input type="submit" value="Créer" name="valider" />
        </p>
    </fieldset>
</form>
<script src="../src/js/app.js"></script>

</body>
</html>

