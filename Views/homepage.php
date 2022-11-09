

<?php $title="Mon blog Accueil";?>


<?php ob_start(); ?>

<p><a href="index.php?action=postlist">blog</a></p>
<p><a href="index.php?action=connexion">connection</a></p>
<p><a href="index.php?action=logout">déconnection</a></p>
<p><a href="index.php?action=register">inscription</a></p>
<h1>Mon super super blog !</h1>

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
<p class="bg-primary">introduction du blog</p>
<p>paragraphe d'introduction</p>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>