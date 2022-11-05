<?php $title="connexion";?>


<?php ob_start(); ?>
<p><a href="index.php">retour accueil</a></p>
<p>connectez-vous :</p> <br>

<?php require ('forms/logonUserForm.php') ?>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>