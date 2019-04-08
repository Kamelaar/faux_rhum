

<section>

<div class="container-fluid">
   <div class="row">
	<img src="<?= base_url('assets/images/banner.jpg')?>" class="img-responsive">
   </div>
</div> <br />

</section>

<hr>

<section class = "home_stats">

<div class="welcome col-md-6 ">

	<h2>Bienvenue dans votre forum</h2> <br />

	<p>Vous faites partie de nos <?= $totalMembers ?> heureux membres</p>
	<p>Vous pouvez publier des discussions et des commentaires</p>
	<p>Faites nous part de vos suggestions</p>
	
</div> 
	
<div class="col-md-6 " align ="center">

<h2>Membres les plus actifs</h2> <br />

<div class="panel panel-default">
	
	<table class="table table-bordered table-striped ">

		<thead>
			<tr>
				<th>Classement</th>
				<th>Nom</th>
				<th>Nombre de discussions</th>
			</tr>
		</thead>
		<tbody>

			<!--Loop for browsing $top3Members table-->
			<?php foreach($top3Members as $top3) : ?>

			<tr>
				<td>
					<?php echo $ranking ?> </td>
				<td>
					<?php echo $top3['author'] ?> </td>
				<td>
					<?php echo $top3['COUNT(user_id)'] ?>
				</td>
			</tr>

			<!--Ranking variable incrementation-->
			<?php $ranking +=1 ?>

			<?php endforeach; ?>

		</tbody>

	</table>
	
</div>	
	
</div>
	
</section>

<hr>

<section class = "home_posts">
	
<?php if ($posts): ?>

<h2><?= $lastDiscussions ?></h2> <br />
<?php 
	
foreach($posts as $post) : ?>

	<h3 class = "post_title"><?php echo $post['title']; ?> | <em> Lancée par <?php echo $post['author'] ?></em> </h3>

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
	
<hr>

<?php endforeach; ?>
	
<?php else : ?>

<p><em>Aucune discussion récente dans le forum.</em></p>

<?php endif; ?>

</section>

