<?php require __DIR__ . '/header.php' ?>
    <div class="form">
        <form action="" method="post">
            <input type="hidden" name="_csrf" value="<?= $csrf ?>">
            <fieldset>
                <legend>Se connecter</legend>
                <div class="field">
                    <label for="email">Email</label>
                    <?php 
                    if(isset($errors['email'])){ ?>
                        <span class="form-error"> <?= $errors['email'] ?> </span>
                    <?php } ?>
                    <input type="text" name="email" id="email">
                </div>
                <div class="field">
                    <label for="psw">Mot de passe</label>
                    <input type="password" name="psw" id="psw">
                </div>
            </fieldset>
            <div class="footer">
                <div>
                    <button class="btn" type="submit">Se connecter</button>
                    <a href="/register">Créer un compte</a>
                </div>
                <div>
                    <a href="">Mot de passe oublié ?</a>
                </div>
            </div>
        </form>
    </div>
<?php require __DIR__ . '/footer.php' ?>
