<section class="content-header">

	<h1>
		<?= $title ?>
			<small class="text-muted"><?= $subtitle ?></small>
	</h1> <br />

</section>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('posts/create'); ?>
  <div class="form-group">
    <label>Titre</label>
    <input type="text" class="form-control" name="title" placeholder="Ajouter un titre">
  </div>
  <div class="form-group">
    <label>Message</label>
    <textarea id="editor1" class="form-control" name="body" placeholder="Add Body"></textarea>
  </div>
  <div class="form-group">
	  <label>Categorie</label>
	  <select name="category_id" class="form-control">
		  <?php foreach($categories as $category): ?>
		  	<option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
		  <?php endforeach; ?>
	  </select>
  </div>
  <div class="form-group">
	  <label>Insérer une image</label>
	  <input type="file" name="userfile" size="20">
  </div>
  <button type="submit" class="btn btn-default">Valider</button>
</form>