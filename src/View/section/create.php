<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Créer Section</title>
</head>
<body>
<form method="post" action="frontController.php?controller=section&action=create">
    <fieldset>
        <legend>Créez une section :</legend>
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
        <?php
            $id_question = $_POST['id_question'];
        ?>

        <p>
            <input type="submit" value="Envoyer" />
        </p>



    </fieldset>
</form>
</body>
</html>

