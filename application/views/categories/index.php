<section class="content-header">

	<h1>
		<?= $title ?>
			<small class="text-muted"><?= $subtitle ?></small>
	</h1> <br />
	
	<p>En cliquant sur une catégorie vous aurez accès à toutes discussions la concernant.</p>

</section>

<section>

<ul class="list-group">
    
<?php foreach($categories as $category) : ?>
    
	<li class="list-group-item">
        <a class = "category-text-color" href="<?php echo site_url('/categories/posts/'.$category['id']); ?>"><?php echo $category['name']; ?></a>
	</li>
    
<?php endforeach; ?>
    
</ul>

</section>