<form action="index.php?action=addComment&id=<?= $post->identifier; ?>" method="post">
    <div>
        <label for="comment">Mon commenaire :</label> <br>
        <textarea name="comment" id="" cols="30" rows="10"></textarea>
    </div>
    <div>
        <p>auteur : <?= $_SESSION['pseudo']?></p>
    </div><br>
    <div>
        <input type="submit" value="ajouter un commentaire">
    </div>

</form>