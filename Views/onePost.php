<?php $title="mon super blog";?>

<?php ob_start(); ?>
    <h1>mon super blog</h1>
    <p><a href="index.php">retour à la liste des billets</a></p>

    <div>
        <h3>
            <?= htmlspecialchars($post->title) ?>
            <em>le <?= $post->french_creation_date ?></em>
        </h3>

        <p>
            <?= nl2br(htmlspecialchars($post->content)) ?>
        </p>
    </div>

    <h2>commentaires</h2>
    <!-- on ajoute un formulaire pour pouvoir ajouter des commentaires -->

   
    <form action="index.php?action=addComment&id=<?= $post->identifier; ?>" method="post">
        <div>
            <label for="author">Auteur</label><br />
            <input type="text" name="author" id="author">
        </div>
        <div>
            <label for="comment">Commentaire</label><br />
            <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
        </div>
        <div>
            <input type="submit" value="envoyer">
        </div>

    </form>

    <?php
    foreach ($comments as $comment){
    ?>
        <p>
            <strong><?= htmlspecialchars($comment->author) ?></strong> le <?= $comment->frenchCreationDate ?> 
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
