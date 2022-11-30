<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>detail section</title>
</head>
<body>
<div class="container">
    <div class="container_creerquestion">
<?php
echo '<div class="detail_section">';
    echo '<H1>Section</H1>';
    echo '<div class="detail">';
        echo '<p id="detail1"> Titre : ' . '</p> ' . '<p id="detail2">' . htmlspecialchars($section->getTitre()) . '</p>';
    echo '</div>';
    echo '<div class="detail">';
        echo '<p id="detail1"> Description :  ' . '</p>' .'<p id="detail2">'. htmlspecialchars($section->getTexteExplicatif()) . '</p>';
    echo '</div>';
echo '</div>';

?>
    </div>
</div>
</body>
</html>