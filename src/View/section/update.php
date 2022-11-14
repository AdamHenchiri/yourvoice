<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mettre à jour une section</title>
</head>
<body>
<form method="post" action="frontController.php?controller=section&action=created">
    <fieldset>
        <legend>Creer une section :</legend>
        <input id="id_question" name="id_question" type="hidden" value=<?php echo htmlspecialchars($v->getIdSection()) ?> >
        <p>
            <label for="numero">Section numéro</label> : <?php echo $v->getNumero() ?>
            <input type="hidden" value=<?php echo htmlspecialchars($v->getNumero()) ?> name="numero" id="numero" readonly/>
        </p>
        <p>
            <label for="titre">Titre</label> :
            <textarea name="titre" id="titre" required><?php echo $v->getTitre(); ?></textarea>
        </p>
        <p>
            <label for="texte_explicatif">Texte explicatif</label> :
            <textarea name="texte_explicatif" id="texte_explicatif" required><?php echo $v->getTexteExplicatif(); ?></textarea>
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
