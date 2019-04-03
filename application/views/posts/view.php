<h2>
    <?php echo $post['title']; ?> </h2>

<small class="post-date">Publiée le <?php echo $post['created_at']; ?></small><br>

<p align="center"><img class="img-fluid responsive-img" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>"> </p> <br />

<div class="post-body">
    <?php echo $post['body']; ?>
</div>

<!--If the user is the author or the admin he can manage his post-->
<?php if(($this->session->userdata('user_id') == $post['user_id']) || ($this->session->userdata('admin_role'))): ?>

<hr>

<a class="btn btn-default pull-left btn-xs" href="<?php echo base_url(); ?>posts/edit/<?php echo $post['slug']; ?>">Modifier</a>
<?php echo form_open('/posts/delete/'.$post['id']); ?>

<input type="submit" value="Supprimer" class="btn btn-danger pull-right btn-xs"> <br />

<?php endif; ?>



<!--If logged we can answer-->
<?php if($this->session->userdata('logged_in')) : ?>

<hr>

<h3>Répondre</h3>

<?php   echo validation_errors(); 
            echo form_open('comments/create/'.$post['id']); ?>

<div class="form-group">
    <label>Nom</label>
    <input type="text" name="name" class="form-control">
</div>
<div class="form-group">
    <label>Email</label>
    <input type="text" name="email" class="form-control">
</div>
<div class="form-group">
    <label>Message</label>
    <textarea name="body" class="form-control"></textarea>
</div>

<input type="hidden" name="slug" value="<?php echo $post['slug']; ?>">

<button class="btn btn-primary" type="submit">Envoyer</button>

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
    <p>[Réponse de <strong><?php echo $comment['name']; ?></strong>] <br /></p>
    <h5>
        <?php echo $comment['body']; ?> </h5>
</div>

<?php endforeach; ?>

<!--Else we display this message-->
<?php else : ?>

<p><em>Aucune réponse à cette discussion</em></p>

<?php endif; ?>
