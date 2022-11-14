<?php $title="Mon blog les billets";?>

<?php ob_start(); ?>

<h1>Mon super super blog !</h1>
<p>Derniers billets du blog :</p>
<p><a href="index.php">retour accueil</a></p>

<?php
foreach ($posts as $post){
?>
   <div class="news">
      <h3>
         <?= $post->getTitle; ?>
         <em>le <?= $post->getFrench_creation_date; ?></em>
      </h3>
      <p><?= htmlspecialchars($post->getChapo) ;?></p>
      <p>Par : <?= htmlspecialchars($post->getFirstname); ?>   <?= htmlspecialchars($post->getLastname) ;?></p>
      <p> 
         <em><a href="index.php?action=post&id=<?= urlencode($post->getIdentifier) ?>">Voir la suite ...</a></em>
      </p>
   </div>
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>