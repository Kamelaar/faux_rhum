<?php echo validation_errors(); ?>

<?php echo form_open('users/register'); ?>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<h1 class="text-center"><?= $title; ?></h1>
			<div class="form-group">
				<label>Nom</label>
				<input type="text" class="form-control" name="name" placeholder="Comment vous appelez-vous?">
			</div>
			<div class="form-group">
				<label>Code postal</label>
				<input type="text" class="form-control" name="zipcode" placeholder="5 chiffres?">
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="email" class="form-control" name="email" placeholder="Email">
			</div>
			<div class="form-group">
				<label>Pseudo</label>
				<input type="text" class="form-control" name="username" placeholder="Votre nom d'utilisateur">
			</div>
			<div class="form-group">
				<label>Mot de passe</label>
				<input type="password" class="form-control" name="password" placeholder="Choisissez un mot de passe sûr!">
			</div>
			<div class="form-group">
				<label>Confirmation du mot passe</label>
				<input type="password" class="form-control" name="password2" placeholder="Confirmez-le!">
			</div>
			<button type="submit" class="btn btn-primary btn-block">Valider</button>
		</div>
	</div>
<?php echo form_close(); ?>
