<?php require dirname(__DIR__) . '/header.php' ?>
<h1>Créer votre établissement</h1>
<h2>Nous allons commencer par vous identifier</h2>
    <div class="form">
        <form action="" method="post">
            <input type="hidden" name="_csrf" value="<?= $csrf ?>">
            <div class="field">
                <label for="lastname">Nom</label>
                <?php 
                if(isset($errors['lastname'])){ ?>
                    <span class="form-error"> <?= $errors['lastname'] ?> </span>
                <?php } ?>
                <input type="text" name="lastname" id="lastname">
            </div>
            <div class="field">
                <label for="firstname">Prénom</label>
                <?php 
                if(isset($errors['firstname'])){ ?>
                    <span class="form-error"> <?= $errors['firstname'] ?> </span>
                <?php } ?>
                <input type="text" name="firstname" id="firstname">
            </div>
            <div class="field">
                <label for="email">Email professionel</label>
                <?php 
                if(isset($errors['firstname'])){ ?>
                    <span class="form-error"> <?= $errors['email'] ?> </span>
                <?php } ?>
                <input type="email" name="email" id="email" placeholder="hello@monecole.be">
            </div>
            <div class="field">
                <label for="function">Fonction</label>
                <select name="function" id="function">
                    <option value="Directeur / Directrice">Directeur / Directrice</option>
                    <option value="Sous-directeur / Sous-directrice">Sous-directeur / Sous-directrice</option>
                    <option value="Responsable administratif">Responsable administratif</option>
                    <option value="">Responsable informatique (IT)</option>
                    <option value="">Responsable pédagogique</option>
                    <option value="">Responsable RH</option>
                    <option value="">Secrétaire de direction</option>
                    <option value="">Coordinateur / Coordinatrice</option>
                    <option value="">Gestionnaire de l'établissement</option>
                    <option value="">Membre du pouvoir organistateur (PO)</option>
                </select>
            </div>
            <div class="footer">
                <button class="btn btn-primary">Continuer</button>
            </div>
            <div class="field">
                <label for="school-name">Nom de l'école</label>
                <?php 
                if(isset($errors['school-name'])){ ?>
                    <span class="form-error"> <?= $errors['school-name'] ?> </span>
                <?php } ?>
                <input type="text" name="school-name" id="school-name">
            </div>
            <div class="field">
                <label for="type">Type d'établissement</label>
                <select name="school-type" id="type">
                    <option value="">public</option>
                </select>
            </div>
            <div class="field">
                <label for="school-country">Pays</label>
                <?php 
                if(isset($errors['school-country'])){ ?>
                    <span class="form-error"> <?= $errors['school-country'] ?> </span>
                <?php } ?>
                <input type="text" name="school-country" id="school-country">
            </div>
            <div class="field">
                <label for="school-city">Ville</label>
                <?php 
                if(isset($errors['school-city'])){ ?>
                    <span class="form-error"> <?= $errors['school-city'] ?> </span>
                <?php } ?>
                <input type="text" name="school-city" id="school-city">
            </div>
            <div class="field">
                <label for="school-road">Rue</label>
                <?php 
                if(isset($errors['school-road'])){ ?>
                    <span class="form-error"> <?= $errors['school-road'] ?> </span>
                <?php } ?>
                <input type="text" name="school-road" id="school-road">
            </div>
            <div class="field">
                <label for="school-number">Numéro</label>
                <?php 
                if(isset($errors['school-number'])){ ?>
                    <span class="form-error"> <?= $errors['school-number'] ?> </span>
                <?php } ?>
                <input type="number" name="school-number" id="school-number">
            </div>
        </form>
    </div>
<?php require dirname(__DIR__) . '/footer.php' ?>