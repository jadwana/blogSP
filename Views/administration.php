<?php $title="Mon blog Admin";?>


<?php ob_start(); ?>

<p><a href="index.php?action=postlist">blog</a></p>
<p><a href="index.php">accueil</a></p>



<h1>page d'administration du blog</h1>

<h2>gestion des commentaires</h2>

<p><a href="index.php?action=">validation des commentaires</a></p>

<h2>gestion des articles</h2>
<ul>
    <li><p><a href="index.php?action=addPost">ajout d'un article</a></p></li>
    <li><p><a href="index.php?action=">modification d'un article</a></p></li>
    <li><p><a href="index.php?action=">suppression d'un article</a></p></li>
</ul>

<?php 
    if(isset($_SESSION['user_id'])){
        $userpseudo = $_SESSION['pseudo'];
    }else{
        $userpseudo ="visiteur";
    }
?>
<p>
Bienvenue <?= $userpseudo?>
</p>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>