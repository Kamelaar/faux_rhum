<section class="content-header">

	<h1>
		<?= $title ?>
			<small class="text-muted"><?= $subtitle ?></small>
	</h1> <br />

</section>

<section>

	<p>Vous pouvez nous laisser ici vos questions ou vos suggestions. Nous reviendrons vers vous dans les plus brefs délais.</p> <br />
	
	
 

<div class="row">
    <div class="col-lg-12">
        <?php if(!empty($this->session->flashdata('msg'))){ ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('msg'); ?>
            </div>        
        <?php } ?>
        <?php if(validation_errors()) { ?>
          <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
          </div>
        <?php } ?>
    </div>
</div>
 <form action="<?php print site_url();?>contact/send" method="POST" class="add-emp" id="add-emp">
    <div class="row">
        <div class="col-lg-12 emailtel">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-user-o"></i>
                    </span>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Nom & Prénom">
                </div>
            </div>
        </div>
    </div> 
	 
    <div class="row">
		<div class = "emailtel">
        <div class="col-lg-6">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-envelope"></i>
                    </span>
                    <input type="text" name="email" class="form-control" id="email" placeholder="Email">
                </div>
            </div>
        </div> 
		
        <div class="col-lg-6">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-phone"></i>
                    </span>
                    <input type="text" name="contact_no" class="form-control" id="contact-no" placeholder="Téléphone">
                </div>
            </div>
        </div> 
		</div>	
		
        <div class="col-lg-12 emailtel">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-comments"></i>
                    </span>
                    <textarea name="comment" cols="3" rows="5" class="form-control" id="comment" placeholder="Message"></textarea>
                </div>
            </div>
        </div>
    </div>
	 
    <div class="row">
        <div class="col-lg-12 text-right emailtel">
            <button type="reset" name="reset_add_emp" id="re-submit-emp" class="btn btn-danger"><i class="fa fa-undo"></i> Réinitialiser</button>
            <button type="submit" name="add_emp" id="submit-emp" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Envoyer</button>
        </div>
    </div>  
</form>
	
	
	
</section>