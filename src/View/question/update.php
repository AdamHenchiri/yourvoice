<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Créer Question</title>
</head>
<body>
<form method="post" action="frontController.php?controller=question&action=updated" >
    <fieldset>
        <legend>Mettre à jour une question :</legend>
        <p>
            <label for="intitule">Intitulé</label> :
        </p>
        <textarea name="intitule" id="intitule" cols="60"  rows="1" required><?php echo $v->getIntitule(); ?></textarea>

        <p>
            <label for="explication">Développement de votre question</label> :
        </p>
        <textarea name="explication" id="explication" cols="90"  rows="6" required><?php echo $v->getExplication(); ?></textarea>

        <p>
            <label for="dateDebut_redaction">Date du début de la rédaction</label> :
            <input type="date" value=<?php echo $v->getDateDebutRedaction(); ?> name="dateDebut_redaction" id="dateDebut_redaction" required/>
        </p>

        <p>
            <label for="dateFin_redaction">Date de fin de la rédaction</label> :
            <input type="date" value=<?php echo $v->getDateFinRedaction(); ?> name="dateFin_redaction" id="dateFin_redaction" required/>
        </p>

        <p>
            <label for="dateDebut_vote">Date du début du vote</label> :
            <input type="date" value=<?php echo $v->getDateDebutVote(); ?> name="dateDebut_vote" id="dateDebut_vote" required/>
        </p>

        <p>
            <label for="dateFin_vote">Date de fin du vote</label> :
            <input type="date" value=<?php echo $v->getDateFinVote(); ?> name="dateFin_vote" id="dateFin_vote" required/>
        </p>

        <p>
            <label for="id_utilisateur">Serra rempli automatiquement avec les sessions</label> :
            <input type="int" value=<?php echo $v->getIdUtilisateur(); ?> name="id_utilisateur" id="id_utilisateur" readonly    />


        <p>
            <label for="votants ">choisissez les contributeurs</label> :

            <?php

            use App\YourVoice\Model\Repository\UtilisateurRepository;
            $users = (new UtilisateurRepository())->selectAll();
            if ($users){
            foreach($users as $user)
            {
            ?>
        <div>
            <input type="checkbox" id="<?php echo $user->getIdUtilisateur()?>" name="<?php echo $user->getIdUtilisateur()?>">
            <label for="<?php echo $user->getIdUtilisateur()?>"><?php echo $user->getLogin()?></label>
        </div>
        <?php } }?>
        </p>

        <p>
            <label for="votants ">choisissez les votants</label> :

            <?php


            $users = (new UtilisateurRepository())->selectAll();
            if ($users){
            foreach($users as $user)
            {
            ?>
        <div>
            <input type="checkbox" id="<?php echo $user->getIdUtilisateur()?>" name="<?php echo $user->getIdUtilisateur()?>">
            <label for="<?php echo $user->getIdUtilisateur()?>"><?php echo $user->getLogin()?></label>
        </div>
    <?php } }?>
        </p>

        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>
</body>
</html>

