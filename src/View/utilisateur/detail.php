<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>detail voiture</title>
</head>
<body>
<?php
echo '<p> login : ' . htmlspecialchars($user->getLogin()) . '.</p>';
echo '<p> nom :  ' . htmlspecialchars($user->getNom()) . '.</p>';
echo '<p> prenom :  ' . htmlspecialchars($user->getPrenom()) . '.</p>';
echo '<p> ------------------------------------------------------------------</p>';

?>
</body>
</html><?php
