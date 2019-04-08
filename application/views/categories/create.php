<h1>
            <?= $title ?>
                <small class="text-muted"><?= $subtitle ?></small>
        </h1> <br />

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('categories/create'); ?>
	<div class="form-group">
		<label>Nom</label>
		<input type="text" class="form-control" name="category_name" placeholder="Nouvelle catégorie">
	</div>
	<button type="submit" class="btn btn-default">Créer</button>
</form>

<h3>Toutes les catégories</h3>

<ul class="list-group">
<?php foreach($categories as $category) : ?>
    
	<li class="list-group-item"><a class = "category-text-color" href="<?php echo site_url('/categories/posts/'.$category['id']); ?>"><?php echo $category['name']; ?></a>
        
        <!--Only the admin can delete a cathegory-->
		<?php if($this->session->userdata('admin_role')) : ?>
        
			<form class="cat-delete" action="delete/<?php echo $category['id']; ?>" method="POST">
				<input type="submit" class="btn btn-danger pull-right btn-xs" value="Supprimer">
			</form>
        
		<?php endif; ?>
        
	</li>
    
<?php endforeach; ?>
</ul>

