<h2><?= $title ?></h2>
<?php 
	
foreach($posts as $post) : ?>

	<h3><?php echo $post['title']; ?> | <em> Lancée par <?php echo $post['author'] ?></em> </h3>

	<div class="row">
		<div class="col-md-3">
			<img class="post-thumb" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>">
		</div>
		
		<div class="col-md-9">
			<small class="post-date">Publiée le <?= date("d/m/Y à H:i:s",strtotime($post['created_at'])) ?> dans la catégorie <strong><?php echo $post['name']; ?></strong></small><br>
		<?php echo word_limiter($post['body'], 60); ?>
		<br><br>
		<p><a class="btn btn-default" href="<?php echo site_url('/posts/'.$post['slug']); ?>">Découvrir</a></p>
		</div>
	</div>

<?php endforeach; ?>

<div class="pagination-links">
		<?php echo $this->pagination->create_links(); ?>
</div>