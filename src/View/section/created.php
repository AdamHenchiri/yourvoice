<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Créer Section</title>
</head>
<body>
<?php
echo "section bien ajouter";
?>
<form method="post" action="frontController.php?controller=section&action=created">
    <fieldset>
        <legend>Creer une section :</legend>
        <input id="id_question" name="id_question" type="hidden" value=<?php echo $id_question ?> >
        <?php echo $id_question?>
    </fieldset>
</form>
<p>
<a href="frontController.php?controller=section&action=create">Ajouter une section</a>
</p>
<p>
    <a href="frontController.php?controller=question&action=list">Finir et voir la question </a>
</p>
</body>