<section class="content-header">

	<h1>
		<?= $title ?>
			<small class="text-muted"><?= $subtitle ?></small>
	</h1> <br />

</section>

<section>

<?php if ($posts):
	
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
			
			     <!--Only the admin can delete a cathegory-->
		<?php if($this->session->userdata('admin_role')) : ?>
	
			<!--Comment unvalidation button-->
			<a href="<?php echo base_url(); ?>posts/unvalidate/<?php echo $post['id'];?>" class="btn btn-danger pull-right btn-small">Invalider</a>
	
			<!--Comment validation button-->
			<a href="<?php echo base_url(); ?>posts/validate/<?php echo $post['id'];?>" class="btn btn-success pull-right btn-small">Valider</a>
	
		<?php endif; ?>	
			
		</div>
	</div>

<?php endforeach; ?>
	
<?php else : ?>

<p><em>Aucune discussion à modérer pour le moment.</em></p>

<?php endif; ?>

</section>