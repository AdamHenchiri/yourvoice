<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Créer Section</title>
</head>
<body>
<form method="post" action="frontController.php?controller=section&action=created">
    <fieldset>
        <legend>Créez une section :</legend>
        <input id="id_question" name="id_question" type="hidden" value=<?php echo $id_question ?> >
        <?php echo $id_question?>
        <p>
            <label for="titre">Titre</label> :
            <textarea placeholder="Je vais bien " name="titre" id="titre" required></textarea>
        </p>
        <p>
            <label for="texte_explicatif">Texte explicatif</label> :
            <textarea placeholder="Pourquoi je vais bien" name="texte_explicatif" id="texte_explicatif" required></textarea>
        </p>
        <p>
            <label for="numero">Numéro de la section</label> :
            <input type="number" placeholder="1" name="numero" id="numero" required/>
        </p>
        <p>
            <label for="votants ">choisissez les votants</label> :

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
            <input type="submit" value="Envoyer" />
        </p>



    </fieldset>
</form>
</body>
</html>

