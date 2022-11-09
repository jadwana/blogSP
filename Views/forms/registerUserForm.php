<form action="index.php?action=addUser" method="post">
    <div>
        <label for="firstname">Votre prénom</label>
        <input type="text" name="firstname" id="firstname">   
    </div>
    <div>
        <label for="lastname">Votre nom</label>
        <input type="text" name="lastname" id="lastname">   
    </div>
    <div>
        <label for="pseudo">Votre pseudo (minimum 6 caractères)</label>
        <input type="text" name="pseudo" id="pseudo">   
    </div>
    <div>
        <label for="email">Votre email</label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="password">Votre mot de passe</label>
        <input type="password" name="password" id="password">
    </div>
    <div>
        <input type="submit" name="add" value="ajouter">
    </div>

</form>