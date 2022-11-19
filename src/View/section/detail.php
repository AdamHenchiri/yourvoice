<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>detail section</title>
</head>
<body>
<?php
echo '<p> Titre : ' . htmlspecialchars($section->getTitre()) . '.</p>';
echo '<p> Description :  ' . htmlspecialchars($section->getTexteExplicatif()) . '.</p>';
    echo '<p> ------------------------------------------------------------------</p>';

?>
</body>
</html>