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
            <input type="hidden" value="<?php use App\YourVoice\Model\Repository\ReponseRepository;
            use App\YourVoice\Model\Repository\UtilisateurRepository;
            use App\YourVoice\Model\Repository\VotantRepository;

            echo $v->getIdQuestion(); ?>" name="id_question" id="id_question" />
        </p>
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
            <label for="organisateurs ">choisissez les organisateurs</label> :

            <?php


            $reps = (new ReponseRepository())->selectAll();
            if ($reps){
            foreach($reps as $rep){

            //$responsable =  (new UtilisateurRepository())->selectWhere("id_reponse", $users );
            $usersResponsables=(new ReponseRepository())->selectWhere("id_responsable",$rep->getIdUtilisateur());
            //var_dump($usersResponsables);
            if ($usersResponsables){
            $aux=false;
            foreach ($usersResponsables as $usersResponsable){
            $responsable = $usersResponsable->getIdUtilisateur();
            $user = (new UtilisateurRepository())->select($responsable);
            $tab = array();

            if ($usersResponsable->getIdQuestion()==$v->getIdQuestion() and !in_array($user, $tab)){

            //var_dump($tab);
            ?>
        <div>
            <input type="checkbox" name="idOrganisateur[]" id="<?php echo $user->getIdUtilisateur()?>" value="<?php echo $user->getIdUtilisateur()?>" checked>
            <?php $aux=true;?>
            <label for="<?php echo $user->getIdUtilisateur()?>"><?php echo $user->getLogin()?></label>
        </div>
        <?php }}if($aux===false ){ ?>
            <div>
                <input type="checkbox" name="idOrganisateur[]" id="<?php echo $user->getIdUtilisateur()?>" value="<?php echo $user->getIdUtilisateur()?>">

                <label for="<?php echo $user->getIdUtilisateur()?>"><?php echo $user->getLogin()?></label>
            </div>
        <?php }}else{ ?>
            <div>
                <input type="checkbox" name="idOrganisateur[]" id="<?php echo $user->getIdUtilisateur()?>" value="<?php echo $user->getIdUtilisateur()?>">

                <label for="<?php echo $user->getIdUtilisateur()?>"><?php echo $user->getLogin()?></label>
            </div>
        <?php $tab[] = $user; } }} ?>




        </p>

        <p>
            <label for="votants ">choisissez les votants</label> :

            <?php


            $users = (new UtilisateurRepository())->selectAll();
            if ($users){
            foreach($users as $user){
                $usersVotant=(new VotantRepository())->selectWhere("id_votant",$user->getIdUtilisateur());
            if ($usersVotant){
            $aux=false;
            foreach ($usersVotant as $userVotant){
            if ($userVotant->getIdQuestion()==$v->getIdQuestion()){
            ?>
        <div>
            <input type="checkbox" name="idVotant[]" id="<?php echo $user->getIdUtilisateur()?>" value="<?php echo $user->getIdUtilisateur()?>" checked>
            <?php $aux=true;?>
            <label for="<?php echo $user->getIdUtilisateur()?>"><?php echo $user->getLogin()?></label>
        </div>
        <?php }}if($aux===false){ ?>
        <div>
            <input type="checkbox" name="idVotant[]" id="<?php echo $user->getIdUtilisateur()?>" value="<?php echo $user->getIdUtilisateur()?>">

            <label for="<?php echo $user->getIdUtilisateur()?>"><?php echo $user->getLogin()?></label>
        </div>
        <?php }}else{ ?>
        <div>
            <input type="checkbox" name="idVotant[]" id="<?php echo $user->getIdUtilisateur()?>" value="<?php echo $user->getIdUtilisateur()?>">

            <label for="<?php echo $user->getIdUtilisateur()?>"><?php echo $user->getLogin()?></label>
        </div>
        <?php } }} ?>

        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>
</body>
</html>

