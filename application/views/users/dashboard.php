<section class="content-header">

	<h1>
		<?= $title ?>
			<small class="text-muted"><?= $subtitle ?></small>
	</h1> <br />

</section>

<section>
	
<h2 align = "center"><?= $h2 ?></h2> <br />

<!--If there are posts to display-->
<?php if($user_posts) : ?>
	
<?php foreach($user_posts as $post) : ?>

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
	
<!--Else we display this message-->
<?php else : ?>

<p><em>Vous n'avez pas encore lancé de discussion</em></p>

<?php endif; ?>

</section>
