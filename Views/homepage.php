

<?php $title="Mon blog Accueil";?>


<?php ob_start(); ?>

<h1>Mon super super blog !</h1>
<p>introduction du blog</p>

<?php $content = ob_get_clean(); ?>
<!-- on appelle le template -->
<?php require('layout.php') ?>