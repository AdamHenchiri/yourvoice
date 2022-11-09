<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>detail voiture</title>
</head>
<body>
<?php
echo '<p> Intitulé : ' . htmlspecialchars($question->getIntitule()) . '.</p>';
echo '<p> Développement de la question :  ' . htmlspecialchars($question->getExplication()) . '.</p>';
echo '<p> Date de début de la rédaction :  ' . htmlspecialchars($question->getDateDebutRedaction()) . '.</p>';
echo '<p> Date de fin de la rédaction :  ' . htmlspecialchars($question->getDateFinRedaction()) . '.</p>';
echo '<p> Date de début des votes :  ' . htmlspecialchars($question->getDateDebutVote()) . '.</p>';
echo '<p> Date de fin des votes :  ' . htmlspecialchars($question->getDateFinVote()) . '.</p>';



echo '<p> ------------------------------------------------------------------</p>';

?>
</body>
</html><?php