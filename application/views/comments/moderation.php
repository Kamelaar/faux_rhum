<section class="content-header">

	<h1>
		<?= $title ?>
			<small class="text-muted"><?= $subtitle ?></small>
	</h1> <br />

</section>


<?php if ($comment):
	
	
foreach($comment as $comment) : ?>

<div class="well">
    <p>Envoyée par <strong><?php echo $comment['name']; ?></strong> le <?php echo date("d/m/Y à H:i:s",strtotime($comment['created_at'])); ?><br /></p>
    
        <?php echo $comment['body']; ?>
	
	     <!--Only the admin can delete a cathegory-->
		<?php if($this->session->userdata('admin_role')) : ?>
	
			<!--Comment unvalidation button-->
			<a href="<?php echo base_url(); ?>comments/unvalidate/<?php echo $comment['id'];?>" class="btn btn-danger pull-right btn-small">Invalider</a>
	
			<!--Comment validation button-->
			<a href="<?php echo base_url(); ?>comments/validate/<?php echo $comment['id'];?>" class="btn btn-success pull-right btn-small">Valider</a>
	
		<?php endif; ?>
	
</div>

<?php endforeach; ?>

<?php else : ?>

<p><em>Aucun commentaire à modérer pour le moment.</em></p>

<?php endif; ?>