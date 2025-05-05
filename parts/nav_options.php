<nav>
    <a href="./utils/user_deconnect.php"><p class="option"> Se déconnecter </p></a>
    
    <p class="option" id="edit-name"> Changer identifiant </p>
    
    <form id="form-edit-name" method="post" action="./utils/user_edit_name.php" hidden>
        
        <input class="option-open" type="password" name="password" placeholder="Mot de passe actuel" required><br>
        <input class="option-open" type="text" name="newName" placeholder="Nouvel identifiant" required><br>
        
        <input type="hidden" name="token" value="<?= htmlspecialchars($_SESSION['token'], ENT_QUOTES, 'UTF-8'); ?>">
        <input class="option-open" type="submit" name="submitNewName" value="Valider"></input>
    </form>
    
    
    <p class="option" id="edit-password"> Changer de mot de passe </p>
    <form id="form-edit-password" method="post" action="./utils/user_edit_password.php" hidden>
        
        <input class="option-open" type="password" name="oldPassword" placeholder="Ancien mot de passe" required><br>
        <input class="option-open" type="password" name="newPassword" placeholder="Nouveau mot de passe" required><br>
        
        <input type="hidden" name="token" value="<?= htmlspecialchars($_SESSION['token'], ENT_QUOTES, 'UTF-8'); ?>">
        <input class="option-open" type="submit" name="submitNewPassword" value="Valider"></input>
    </form>
    
    
    <p class="option" id="delete-account"> Supprimer le compte </p>
    <form id="form-delete-account" method="post" action="./utils/user_delete_account.php" hidden>
        
        <input class="option-open" type="password" name="password" placeholder="Mot de passe pour confirmer" required><br>
        
        <input type="hidden" name="token" value="<?= htmlspecialchars($_SESSION['token'], ENT_QUOTES, 'UTF-8'); ?>">
        <input class="option-open" type="submit" name="submitDeleteAccount" value="Valider"></input>
    </form>
    
    <?php include("./parts/display_error_or_success_options.php"); ?>
</nav>