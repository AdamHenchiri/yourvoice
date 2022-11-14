
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>detail voiture</title>
</head>
<body>
<?php
echo '<p> Titre : ' . htmlspecialchars($section->getTitre()) . '.</p>';
echo '<p> Description :  ' . htmlspecialchars($section->getTexteExplicatif()) . '.</p>';
echo '<p> Numéro :  ' . htmlspecialchars($section->getNumero()) . '.</p>';
echo '<p> ------------------------------------------------------------------</p>';

?>
</body>
</html>