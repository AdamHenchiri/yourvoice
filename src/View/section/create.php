<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Créer Section</title>
</head>
<body>
<form method="post" action="frontController.php?controller=section&action=created">
    <fieldset>
        <legend>Creer une section :</legend>
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
            <input type="submit" value="Valider" />
        </p>




    </fieldset>
</form>
</body>
</html>

