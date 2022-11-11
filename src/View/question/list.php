<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des utilisateurs</title>
</head>
<body>
<?php
echo "Il y a " . $nbLigne . " questions";
foreach ($questions as $question) {
    $questNonFormater = $question->getIdQuestion();
    $questFormater = rawurlencode($questNonFormater);

    echo "<li><a href=\"frontController.php?controller=question&action=read&id_question={$questFormater}\"> question {$question->getIdQuestion()}:\n".  htmlspecialchars ( $question->getIntitule() ) . " </a></li> ";
    echo "<li><a href=\"frontController.php?controller=question&action=update&id_question={$questFormater}\"> Mettre a jour la question </a></li>      ";
    echo "<li><a href=\"frontController.php?controller=question&action=delete&id_question={$questFormater}\"> Supprimer cette question </a></li>      ";
    echo "--------------------------------------------------------------------------\n";
}
?>
</body>
</html>
