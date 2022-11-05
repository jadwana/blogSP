<form action="index.php?action=addComment&id=<?= $post->identifier; ?>" method="post">
    <div>
        <label for="content">Mon commenaire :</label> <br>
        <textarea name="content" id="" cols="30" rows="10"></textarea>
    </div>
    <div>
        <label for="author">id utilisateur :</label> <br>
        <input type="text" name="author" id="author"> 
    </div><br>
    <div>
        <input type="submit" value="ajouter">
    </div>

</form>