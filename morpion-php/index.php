<!-- ---- Creation de la session de jeu ---- -->
<?php
session_start();
// var_dump($_SESSION);
if (!isset( $_SESSION ['compteur'])) {
    $_SESSION['compteur']=0;
}
?>

<!-- ---- Initialisation de la page html ---- -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Morpion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1 class='titre'>MORPION</h1>
    <form action="index.php" method="post">
        <label for="forme">Joueur1 : </label>
        <input type="radio" name="joueur1"
        <?php
        if (($_SESSION ['compteur']%2)==0) {
            echo 'checked';
        }else{
            echo 'disabled';
        }
        ?>
        >
        <label for="forme">Joueur2 : </label>
        <input type="radio" name="joueur2"        
        <?php
        if (($_SESSION ['compteur']%2)!=0) {
            echo 'checked';
        }else{
            echo 'disabled';
        }
        ?>>
    </form>

<?php
// creation du plateau de jeu
echo '<table>';
$compteur=0;
for ($i=0; $i < 3; $i++) { 
    echo '<tr>';
    for ($j=0; $j < 3; $j++) { 
        echo '<td><form action="index.php" method="post"><button class="button" type="submit" name ="bt'.$compteur.'" value ="'.$compteur.'"><div class="';
        // Si la case a deje ete jouee
        if (isset($_SESSION['content'.$compteur])) {
            echo $_SESSION['content'.$compteur];
        } else {
            // Si le bouton de la case est actionner
            if (isset($_POST['bt'.$compteur]) && $_POST['bt'.$compteur]==$compteur) {
                if (($_SESSION ['compteur']%2)==0) {
                    $_SESSION['content'.$compteur]='cercle';
                }else {
                    $_SESSION['content'.$compteur]='croix';
                }
                header('Location: index.php');
                $_SESSION['compteur']+=1;
            }
        }
        echo '"></div></button></form></td>';
        $compteur++;
    }
    echo '</tr>';
}

echo '</table>';

// Si le coup est gagnant
if (isset($_SESSION['content0']) && isset($_SESSION['content1']) && isset($_SESSION['content2']) && $_SESSION['content0'] == $_SESSION['content1'] && $_SESSION['content0']==$_SESSION['content2']) {
    echo '<div class="gagner">La premiere ligne est gagnante</div>';
} else if (isset($_SESSION['content3']) && isset($_SESSION['content4']) && isset($_SESSION['content5']) && $_SESSION['content3'] == $_SESSION['content4'] && $_SESSION['content3']==$_SESSION['content5']) {
    echo '<div class="gagner">La deuxieme ligne est gagnante</div>';
} else if (isset($_SESSION['content6']) && isset($_SESSION['content7']) && isset($_SESSION['content8']) && $_SESSION['content6'] == $_SESSION['content7'] && $_SESSION['content6']==$_SESSION['content8']) {
    echo '<div class="gagner">La troisieme ligne est gagnante</div>';
}else if (isset($_SESSION['content0']) && isset($_SESSION['content4']) && isset($_SESSION['content8']) && $_SESSION['content0'] == $_SESSION['content4'] && $_SESSION['content0']==$_SESSION['content8'] || isset($_SESSION['content2']) && isset($_SESSION['content6']) && isset($_SESSION['content4']) && $_SESSION['content6'] == $_SESSION['content4'] && $_SESSION['content6']==$_SESSION['content2']) {
    echo '<div class="gagner">Diagonale gagnante</div>';
} else if (isset($_SESSION['content0']) && isset($_SESSION['content6']) && isset($_SESSION['content3']) && $_SESSION['content6'] == $_SESSION['content0'] && $_SESSION['content6']==$_SESSION['content3']) {
    echo '<div class="gagner">La premiere colonne est gagnante</div>';
}else if (isset($_SESSION['content1']) && isset($_SESSION['content4']) && isset($_SESSION['content7']) && $_SESSION['content1'] == $_SESSION['content4'] && $_SESSION['content1']==$_SESSION['content7']) {
    echo '<div class="gagner">La deuxieme colonne est gagnante</div>';
} else if (isset($_SESSION['content2']) && isset($_SESSION['content5']) && isset($_SESSION['content8']) && $_SESSION['content2'] == $_SESSION['content5'] && $_SESSION['content2']==$_SESSION['content8']) {
    echo '<div class="gagner">La troisieme colonne est gagnante</div>';
}

?>
    <!-- ---- Bouton reset ---- -->
    <form action="index.php" method="post">
        <button type="submit" name='btreset' value="1">Reset</button>
    </form>

<?php
// ---- Au click sur le bouton reset ----
if (isset($_POST['btreset']) && $_POST['btreset']== '1' || $_SESSION['compteur']>10) {
    session_destroy();
    header('Location: index.php');
}
?>

</body>
</html>