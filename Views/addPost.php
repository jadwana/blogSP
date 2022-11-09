<?php $title="ajout article";?>


<?php ob_start(); ?>
<p><a href="index.php">retour accueil</a></p>
<p><a href="index.php?action=admin">retour administration</a></p>
 <br>

<?php require ('forms/addPostForm.php') ?>

<p>Par : <?= $_SESSION['firstname']." ".$_SESSION['lastname'] ?></p>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>