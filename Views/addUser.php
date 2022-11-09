<?php $title="ajout article";?>


<?php ob_start(); ?>
<p><a href="index.php">retour accueil</a></p>

<p>connectez-vous :</p> <br>

<?php require ('forms/logonUserForm.php') ?>
<p>pas encore de compte?</p>
<p><a href="index.php?action=addUser">inscription</a></p>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>