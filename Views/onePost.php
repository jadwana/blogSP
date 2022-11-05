<?php $title="mon super blog";?>

<?php ob_start(); ?>
    <h1>mon super blog</h1>
    <p><a href="index.php?action=postlist">retour à la liste des billets</a></p>

    <div>
        <h3>
            <?= htmlspecialchars($post->title) ?>
            <em>le <?= $post->french_creation_date ?></em>
        </h3>
        <p>chapo : <?= htmlspecialchars($post->chapo)?></p>
        <p>
            <?= nl2br(htmlspecialchars($post->content)) ?>
        </p>
        <p>Par :  <?= htmlspecialchars($post->firstname) ?>    <?= htmlspecialchars($post->lastname) ?></p>
    </div>

    <h2>commentaires</h2>
    <!-- on ajoute un formulaire pour pouvoir ajouter des commentaires -->

   <?php require ('forms/addCommentForm.php') ?>

    

    <?php
    foreach ($comments as $comment){
    ?>
        <p>
            <strong><?= htmlspecialchars($comment->pseudo) ?></strong> le <?= $comment->frenchCreationDate ?> 
            <a href="index.php?action=updateComment&id=<?= $comment->identifier ?>">modifier</a> 
        </p>
        <p>
            <?= nl2br(htmlspecialchars($comment->comment)) ?>
        </p>
    <?php
    }
    ?>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
