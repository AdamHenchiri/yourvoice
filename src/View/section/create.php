<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Créer Section</title>
</head>
<body>
<form method="post" action="frontController.php?controller=section&action=created">
    <fieldset id="sections">
        <legend>Creer une section :</legend>
        <div id="section">
            <input type="hidden" value="<?php echo $_GET["id_question"]?>" name="id_question" >
            <p>
                <label for="titre">Titre</label> :
                <textarea placeholder="Je vais bien " name="titre" id="titre" required></textarea>
            </p>
            <p>
                <label for="texte_explicatif">Texte explicatif</label> :
                <textarea placeholder="Pourquoi je vais bien" name="texte_explicatif" id="texte_explicatif" required></textarea>
            </p>
        </div>
    </fieldset>
    <input type="submit" value="Créer" name="valider" />
</form>


</body>
</html>

