<?php
$id = $userInfo->id;
$name = $userInfo->name;
$email = $userInfo->email;
$username = $userInfo->username;
$register_date = $userInfo->register_date;
$zipcode = $userInfo->zipcode;
?>

    <h2>Edition du profil</h2>

    <?php echo validation_errors(); ?>

    <?php echo form_open('users/update_profile'); ?>

    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <div class="form-group">
        <label>Nom</label>
        <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
        <label>Code postal</label>
        <input type="text" class="form-control" name="zipcode" value="<?php echo $zipcode; ?>">
        <label>Email</label>
        <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
        <label>Pseudo</label>
        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
    </div>

    <button type="submit" class="btn btn-default">Valider</button>
    <a href="profile" class="btn btn-warning" role="button">Annuler</a>

    <?php echo form_close(); ?>
