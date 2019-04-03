<?php
$id = $userInfo->id;
$name = $userInfo->name;
$email = $userInfo->email;
$username = $userInfo->username;
$register_date = $userInfo->register_date;
$zipcode = $userInfo->zipcode;
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

        <h1>
            <?= $title ?>
                <small class="text-muted"><?= $subtitle ?>  <?= $username ?></small>
        </h1> <br />

    </section>

    <!-- Main content -->
    <section class="content">


        <?php echo validation_errors(); ?>

        <?php echo form_open('users/updateOneMember'); ?>

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
        <a href="../allMembers" class="btn btn-warning" role="button">Annuler</a>

        <?php echo form_close(); ?>

        <br />

        <hr>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
