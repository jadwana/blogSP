

<?php $title="Mon blog Accueil";?>


<?php ob_start(); ?>

<p><a href="index.php?action=postlist">blog</a></p>
<p><a href="index.php?action=connexion">connection</a></p>
<h1>Mon super super blog !</h1>
<p class="bg-primary">introduction du blog</p>
<p>paragraphe d'introduction</p>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>