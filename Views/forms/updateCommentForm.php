<form action="index.php?action=updateComment&id=<?= $comment->identifier; ?>" method="post">
   
    <div>
        <label for="comment">Votre commentaire à modifier :</label> <br/>
        <textarea name="comment" id="comment" cols="30" rows="10"><?= htmlspecialchars($comment->comment) ?></textarea>
    </div>
    <div>
            <input type="submit" value="modifier">
    </div>
</form>