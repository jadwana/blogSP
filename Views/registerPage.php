<?php $title="inscription";?>


<?php ob_start(); ?>
<p><a href="index.php">retour accueil</a></p>
<p>inscrivez-vous :</p> <br>

<?php require ('forms/registerUserForm.php') ?><br>
<p>déjà un compte?</p>
<p><a href="index.php?action=connexion">connection</a></p>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>