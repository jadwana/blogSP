<?php $title="Mon blog les billets";?>

<?php ob_start(); ?>

<h1>Mon super super blog !</h1>
<p>Derniers billets du blog :</p>

<?php
foreach ($posts as $post){
?>
   <div class="news">
      <h3>
         <?= htmlspecialchars($post->title); ?>
         <em>le <?= $post->french_creation_date; ?></em>
      </h3>
      <p><?= $post->chapo;?></p>
      <p>
         <?= nl2br(htmlspecialchars( $post->content));?>
         <br />
         <em><a href="index.php?action=post&id=<?= urlencode($post->identifier) ?>">Commentaires</a></em>
      </p>
   </div>
<?php
}
?>
<?php $content = ob_get_clean(); ?>
<!-- on appelle le template -->
<?php require('layout.php') ?>