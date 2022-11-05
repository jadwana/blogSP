<form action="index.php?action=updateComment&id=<?= $comment->identifier; ?>" method="post">
    <div>
        <label for="pseudo">Votre pseudo</label> <br/>
        <input type="text" name="pseudo" id="pseudo" value="<?= htmlspecialchars($comment->author) ?>">
    </div>
    <div>
        <label for="comment">Votre commentaire</label> <br/>
        <textarea name="comment" id="comment" cols="30" rows="10"><?= htmlspecialchars($comment->comment) ?></textarea>
    </div>
    <div>
            <input type="submit" value="modifier">
    </div>
</form>