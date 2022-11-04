<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Créer Question</title>
</head>
<body>
<form method="post" action="frontController.php?controller=section&action=create">
    <fieldset>
        <legend>Créez une question :</legend>
        <p>
            <label for="intitule">Intitulé</label> :
        </p>
            <textarea placeholder="Comment allez-vous ?" name="intitule" id="intitule" cols="60" , rows="1" required></textarea>

        <p>
            <label for="explication">Développement de votre question</label> :
        </p>
            <textarea placeholder="Comment répondriez vous à cette question ...." name="explication" id="explication" cols="90" , rows="6" required></textarea>

        <p>
            <label for="dateDebut_redaction">Date du début de la rédaction</label> :
            <input type="date" placeholder="" name="dateDebut_redaction" id="dateDebut_redaction" required/>
        </p>

        <p>
            <label for="dateFin_redaction">Date de fin de la rédaction</label> :
            <input type="date" placeholder="" name="dateFin_redaction" id="dateFin_redaction" required/>
        </p>

        <p>
            <label for="dateDebut_vote">Date du début du vote</label> :
            <input type="date" placeholder="" name="dateDebut_vote" id="dateDebut_vote" required/>
        </p>

        <p>
            <label for="dateFin_vote">Date de fin du vote</label> :
            <input type="date" placeholder="" name="dateFin_vote" id="dateFin_vote" required/>
        </p>

        <p>
            <label for="id_utilisateur">Serra rempli automatiquement avec les sessions</label> :
            <input type="int" placeholder="serra rempli automatiquement avec les sessions" name="id_utilisateur" id="id_utilisateur" required/>
<!--        </p>-->
<!---->
<!--        <label for="votants ">choisissez les votants</label> :-->
<!--        <p>-->
<!--            --><?php
//            use App\YourVoice\Model\Repository\UtilisateurRepository;
//            $users=UtilisateurRepository::selectAll();
//            if ($users){
//            foreach($users as $user)
//            {
//            ?>
<!--        <div>-->
<!--            <input type="checkbox" id="--><?php //echo $user->getLogin()?><!--" name="--><?php //echo $user->getLogin()?><!--">-->
<!--            <label for="--><?php //echo $user->getLogin()?><!--">--><?php //echo $user->getLogin()?><!--</label>-->
<!--        </div>-->
<!--        --><?php //} ?>
<!--        </p>-->

        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>
</body>
</html>

