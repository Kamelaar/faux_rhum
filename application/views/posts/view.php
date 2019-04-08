<h2>
    <?php echo $post['title']; ?> </h2>

<medium class="post-date">Créée par <strong> <?= $post['author'] ?> </strong> le <?php echo date("d/m/Y à H:i:s",strtotime($post['created_at'])); ?></medium><br>

<p align="center"><img class="img-fluid responsive-img" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>"> </p> <br />

<div class="post-body">
    <?php echo $post['body']; ?>
</div>


<?php if(($this->session->userdata('user_id') == $post['user_id']) || ($this->session->userdata('admin_role'))): ?>

<hr>

<a class="btn btn-default pull-left btn-xs" href="<?php echo base_url(); ?>posts/edit/<?php echo $post['slug']; ?>">Modifier</a>

<!--Form to allow the author or the admin to edit or delete the post -->
<?php echo form_open('/posts/delete/'.$post['id']); ?>

<input type="submit" value="Supprimer" class="btn btn-danger pull-right btn-xs"> <br />

<?php echo form_close(); ?>

<?php endif; ?>
<!--/Form to allow the author or the admin to edit or delete the post -->

<!--If logged we can answer-->
<?php if($this->session->userdata('logged_in')) : ?>

<hr>

<h3>Ajouter une réponse</h3>

<?php echo validation_errors();?>

<!--Form to send a comment if user the user is logged-->
<?= form_open('comments/create/'.$post['id']); ?>

<div class="form-group">
    <label>Votre message</label>
    <textarea name="body" class="form-control"></textarea>
</div>

<input type="hidden" name="slug" value="<?php echo $post['slug']; ?>">

<input type="submit" class="btn btn-primary" value = "Envoyer">

<?php echo form_close(); ?>
<!--/Form to send a comment if user the user is logged-->

<!--Else we ask the user to login-->
<?php else : ?>

<p><em>(Connexion requise pour participer à la discussion)</em></p>

<?php endif; ?>

<hr>

<h3>Réponses</h3>

<!--If there are comments we display them-->
<?php if($comments) : ?>

<?php foreach($comments as $comment) : ?>

<div class="well">
    <p>Envoyée par <strong><?php echo $comment['name']; ?></strong> le <?php echo date("d/m/Y à H:i:s",strtotime($comment['created_at'])); ?><br /></p>
    <h5>
        <?php echo $comment['body']; ?> </h5>
</div>

<?php endforeach; ?>

<!--Else we display this message-->
<?php else : ?>

<p><em>Aucune réponse à cette discussion</em></p>

<?php endif; ?>
