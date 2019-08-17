<?php
/* ---- Lancement de la session de jeu ---- */
session_start();
if (!isset( $_SESSION ['jeu'])) {
    $_SESSION['jeu']=0;
}
?>
<!-- Page html pour le navigateur -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h1 class="title"><span class="title-body">PUISSANCE</span><span class="title-red">I</span><span class="title-green">I</span><span class="title-blue">I</span><span class="title-yellow">I</span></h1>

<?php
/* ---- Bouton de reset ---- */
if (isset($_POST['btreset']) && $_POST['btreset'] == '1') {
    session_destroy();
    header('Location: index.php');
}
echo '<table><form action="index.php" method="post">';
$compteur=0;
for ($i=0; $i < 6; $i++) { 
    echo '<tr>';
    for ($j=0; $j <7; $j++) { 
        /* ---- Cration du plateau de jeu ---- */
        echo '<td><button class="apparence" type="submit" name="bt'.$compteur.'" value="'.$compteur.'"><div class="';
        /* ---- Determiner la couleur de la pastille ---- */
        if (isset($_SESSION['valeur'.$compteur])) {
            echo $_SESSION['valeur'.$compteur];
        }else {
            if (isset($_POST['bt'.$compteur]) && $_POST['bt'.$compteur] == $compteur) {
                /* ---- Fonction qui permet de faire descendre le jeton ---- */
                function caseTest($nombre){
                    if (!isset($_SESSION['valeur'.($nombre+7)]) && ($nombre+7)<42) {
                        caseTest($nombre+7);
                    }else {
                        if (($_SESSION['jeu']%2)==0) {
                            $_SESSION['valeur'.$nombre]='cercleRed">';
                            header('Location: index.php');
                        }else{
                            $_SESSION['valeur'.$nombre]='cercleYellow">';
                            header('Location: index.php');
                        }
                        $_SESSION['jeu']+=1;
                    }
                }
                caseTest($compteur);
            }else{
                /* ---- Case sans jeton ---- */
                echo'cercle">';
            }
        }
        echo'</div></button></td>';
        $compteur++;
    }
    echo '</tr>';
}
echo '</form/></table>';
/* ---- Affichage jeu gagnant ---- */
if (isset($_SESSION['valeur'.$compteur]) && isset($_SESSION['valeur'.($compteur+7)])&& isset($_SESSION['valeur'.($compteur+14)])&& isset($_SESSION['valeur'.($compteur+21)]) && $_SESSION['valeur'.($compteur+7)] == $_SESSION['valeur'.$compteur] && $_SESSION['valeur'.($compteur+14)] == $_SESSION['valeur'.$compteur]&&$_SESSION['valeur'.($compteur+21)] == $_SESSION['valeur'.$compteur]) {
    echo '<div class="winner"><p>Ligne verticale gagnante !</p></div>'; 
}elseif (isset($_SESSION['valeur'.$compteur]) && isset($_SESSION['valeur'.($compteur+1)])&& isset($_SESSION['valeur'.($compteur+2)])&& isset($_SESSION['valeur'.($compteur+3)]) && $_SESSION['valeur'.($compteur+1)] == $_SESSION['valeur'.$compteur] && $_SESSION['valeur'.($compteur+2)] == $_SESSION['valeur'.$compteur]&&$_SESSION['valeur'.($compteur+3)] == $_SESSION['valeur'.$compteur]) {
    echo '<div class="winner"><p>Ligne horizontale gagnante !</p></div>';

}elseif (isset($_SESSION['valeur'.$compteur]) && isset($_SESSION['valeur'.($compteur+6)])&& isset($_SESSION['valeur'.($compteur+12)])&& isset($_SESSION['valeur'.($compteur+18)]) && $_SESSION['valeur'.($compteur+6)] == $_SESSION['valeur'.$compteur] && $_SESSION['valeur'.($compteur+12)] == $_SESSION['valeur'.$compteur]&&$_SESSION['valeur'.($compteur+18)] == $_SESSION['valeur'.$compteur]) {
    echo '<div class="winner"><p>Diagonale gagnante !</p></div>'; 
}elseif (isset($_SESSION['valeur'.$compteur]) && isset($_SESSION['valeur'.($compteur+8)]) && isset($_SESSION['valeur'.($compteur+16)])&&isset($_SESSION['valeur'.($compteur+24)]) && $_SESSION['valeur'.($compteur+8)] == $_SESSION['valeur'.$compteur] && $_SESSION['valeur'.($compteur+16)] == $_SESSION['valeur'.$compteur]&&$_SESSION['valeur'.($compteur+24)] == $_SESSION['valeur'.$compteur]) {
    echo '<div class="winner"><p>Diagonale gagnante !</p></div>';  
}
?>
<!-- ---- Bontou de creation en html ---- -->
<form action="index.php" method="post">
    <button type="submit" name='btreset' value="1" id='reset'>Reset</button>
</form>

</body>
</html>