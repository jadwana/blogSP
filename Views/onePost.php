<?php $title="mon super blog";?>

<?php ob_start(); ?>
    <h1>mon super blog</h1>
    <p><a href="index.php?action=postlist">retour à la liste des billets</a></p>

    <div>
        <h3>
            <?= htmlspecialchars($post->getTitle) ?>
            <em>le <?= $post->getFrench_creation_date ?></em>
        </h3>
        <p>chapo : <?= htmlspecialchars($post->getChapo)?></p>
        <p>
            <?= nl2br(htmlspecialchars($post->getContent)) ?>
        </p>
        <p>Par :  <?= htmlspecialchars($post->getFirstname) ?>    <?= htmlspecialchars($post->getLastname) ?></p>
    </div>

    <h2>commentaires</h2>
    <!-- on ajoute un formulaire pour pouvoir ajouter des commentaires -->

   <?php require ('forms/addCommentForm.php') ?>

    
    <br>
    <?php
    foreach ($comments as $comment){
    ?>
        <p>
            <strong><?= htmlspecialchars($comment->getPseudo) ?></strong> le <?= $comment->getFrenchCreationDate ?> 
            <?php
                if(isset($_SESSION['pseudo']) && $comment->getPseudo == $_SESSION['pseudo']){
                 echo '<a href="index.php?action=updateComment&id='.$comment->getIdentifier.'">modifier</a>';
               }
            ?>
        </p>  
        <p>
            <?= nl2br(htmlspecialchars($comment->getComment)) ?>
        </p>
    <?php
    }
    ?>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
