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
        <input id="id_question" name="id_question" type="hidden" value=<?php echo  $id_question ?> >
        <p>
            <label for="numero">Section numéro</label> : <?php echo $num ?>
            <input type="hidden" value=<?php echo $num ?> name="numero" id="numero" readonly/>
        </p>
        <p>
            <label for="titre">Titre</label> :
            <textarea placeholder="Je vais bien " name="titre" id="titre" required></textarea>
        </p>
        <p>
            <label for="texte_explicatif">Texte explicatif</label> :
            <textarea placeholder="Pourquoi je vais bien" name="texte_explicatif" id="texte_explicatif" required></textarea>
        </p>

        <p>
            <input type="submit" value="Ajouter une nouvelle section" name="ajouterBtn"/>
        </p>
        <p>
            <input type="submit" value="Finir" name="finirBtn""/>
        </p>
        <!--<button name="ajouterBtn" onclick="window.location.href = 'frontController.php?controller=section&action=created';">Ajouter une section</button>

        <button name="finirBtn" onclick="window.location.href = 'frontController.php?controller=question&action=readAll';">Finir</button>-->

    </fieldset>
</form>


</body>
</html>

