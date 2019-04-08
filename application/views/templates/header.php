<html>

<head>
    
    <title>Faux Rhum</title>
    
    <!--Jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <!--Datatable-->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="http://cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
    
    <!--CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
	
	<!--CSS pour le footer-->
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/Footer-white.css'); ?>"> 
	
    <!--Bootstrap Toggle-->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
	
	<!--Javascript-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	



	
</head>

<body>
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo base_url(); ?>">Faux Rhum</a>
            </div>
            <div id="navbar">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo base_url(); ?>">Accueil</a></li>
                    <!--<li><a href="<?php echo base_url(); ?>about">A propos</a></li>-->
                    <li><a href="<?php echo base_url(); ?>posts">Discussions</a></li>
                    <li><a href="<?php echo base_url(); ?>categories">Catégories</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    
                    <?php if(!$this->session->userdata('logged_in')) : ?>
                    <li><a href="<?php echo base_url(); ?>users/login">Connexion</a></li>
                    <li><a href="<?php echo base_url(); ?>users/register">Inscription</a></li>
                    <?php endif; ?>
					
					<?php if($this->session->userdata('logged_in')) : ?>
					<li><a href="<?php echo base_url(); ?>users/dashboard">Tableau de bord</a></li>
					<?php endif; ?>
                    
                    <?php if($this->session->userdata('logged_in')) : ?>
                    <li><a href="<?php echo base_url(); ?>posts/create">Nouvelle discussion</a></li>
                    <?php endif; ?>
					
					<?php if($this->session->userdata('logged_in')) : ?>
                    <li><a href="<?php echo base_url(); ?>users/profile">Mon profil</a></li>
                    <?php endif; ?>
					
					<?php if($this->session->userdata('admin_role')) : ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestion du site<span class="caret"></span></a>
					    	<ul class="dropdown-menu">
								<li><a href="<?php echo base_url(); ?>categories/create">Catégories</a></li>
								<li role="separator" class="divider"></li>
                    			<li><a href="<?php echo base_url(); ?>users/allMembers">Membres</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="<?php echo base_url(); ?>posts/moderation">Discussions</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="<?php echo base_url(); ?>comments/moderation">Commentaires</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="<?php echo base_url(); ?>pages/maintenance_check">Maintenance</a></li>
							</ul>
					</li>
                    <?php endif; ?>
                    
                    <?php if($this->session->userdata('logged_in')) : ?>
                    <li><a href="<?php echo base_url(); ?>users/logout">Déconnexion</a></li>
                    <?php endif; ?>					
                </ul>
            </div>
        </div>
    </nav>
	

    

    <div class="container">
        <!-- Flash messages -->
		
	<?php 
	$maintenance = $this->page_model->maintenanceStatus();
	
	if ($maintenance->maintenance_mode == MAINTENANCE_ON){
		echo '<p class="alert alert-warning" align = "center">SITE EN MAINTENANCE</p>'; 
	}
	?>
		
	<?php if($this->session->flashdata('user_registered')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'; ?>
	<?php endif; ?>

	<?php if($this->session->flashdata('post_created')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_created').'</p>'; ?>
	<?php endif; ?>

	<?php if($this->session->flashdata('post_updated')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_updated').'</p>'; ?>
	<?php endif; ?>

	<?php if($this->session->flashdata('category_created')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('category_created').'</p>'; ?>
	<?php endif; ?>

	<?php if($this->session->flashdata('post_deleted')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_deleted').'</p>'; ?>
	<?php endif; ?>

	<?php if($this->session->flashdata('login_failed')): ?>
	<?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>'; ?>
	<?php endif; ?>

	<?php if($this->session->flashdata('user_loggedin')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedin').'</p>'; ?>
	<?php endif; ?>

	<?php if($this->session->flashdata('user_loggedout')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedout').'</p>'; ?>
	<?php endif; ?>

	<?php if($this->session->flashdata('category_deleted')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('category_deleted').'</p>'; ?>
	<?php endif; ?>

	<?php if($this->session->flashdata('profile_updated')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('profile_updated').'</p>'; ?>
	<?php endif; ?>

	<?php if($this->session->flashdata('user_allready_loggedIn')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_allready_loggedIn').'</p>'; ?>
	<?php endif; ?>

	<?php if($this->session->flashdata('member_updated')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('member_updated').'</p>'; ?>
	<?php endif; ?>

	<?php if($this->session->flashdata('profile_deleted')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('profile_deleted').'</p>'; ?>
	<?php endif; ?>

	<?php if($this->session->flashdata('member_deleted')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('member_deleted').'</p>'; ?>
	<?php endif; ?>

	<?php if($this->session->flashdata('category_allready_exists')): ?>
	<?php echo '<p class="alert alert-danger">'.$this->session->flashdata('category_allready_exists').'</p>'; ?>
	<?php endif; ?>

	<?php if($this->session->flashdata('maintenance_mode')): ?>
	<?php echo '<p class="alert alert-danger" align = "center">'.$this->session->flashdata('maintenance_mode').'</p>'; ?>
	<?php endif; ?>
		
	<?php if($this->session->flashdata('comment_validated')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('comment_validated').'</p>'; ?>
	<?php endif; ?>
		
	<?php if($this->session->flashdata('comment_unvalidated')): ?>
	<?php echo '<p class="alert alert-danger">'.$this->session->flashdata('comment_unvalidated').'</p>'; ?>
	<?php endif; ?>
	
	<?php if($this->session->flashdata('post_validated')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_validated').'</p>'; ?>
	<?php endif; ?>
		
	<?php if($this->session->flashdata('comment_sent')): ?>
	<?php echo '<p class="alert alert-success">'.$this->session->flashdata('comment_sent').'</p>'; ?>
	<?php endif; ?>
