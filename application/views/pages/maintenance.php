<section class="content-header">

	<h1>
		<?= $title ?>
			<small class="text-muted"><?= $subtitle ?></small>
	</h1> <br />

</section>



<h2>Informations importantes</h2> <br />

<p>Vous êtes sur la page de gestion du mode maintenance. Nous vous recommandons d'activer ce mode en cas de modification du site</p>

<p>En activant ce mode, vous empêcherez les membres de se connecter, à la place, un bandeau de maintenance sera affiché sur toutes les pages.</p>

<p>Nous avons créé ce mode dans un soucis de sécurité et de professionnalisme afin que les utilisateurs ne puissent pas voir les pages en construction. Celles-ci pourraient contenir des portions de code érronées.</p>

<p>Enfin, n'oubliez pas de désactiver le mode à la fin de vos modifications.</p> <br />



<?php if(($this->session->userdata('logged_in')) and ($this->session->userdata('admin_role'))) : ?>

<h3>Mode Maintenance</h3> <br /> 

Le bouton ne marche pas à cause de la protection CSRF, si on la désactive il remarche. <br />

<!--Maintenance mode button totally active-->
<div class="btn-group btn-toggle">
	<?php 
	
	$maintenance = $maintenanceStatus->maintenance_mode;
	
	if ($maintenance == 0){ 
	?> 
		<button id="on" class="btn btn-default ">Actif</button>
		<button id="off" class="btn btn-primary active">Inactif</button>
	<?php
	}
	else
	{
	?>
		<button id="on" class="btn btn-primary active ">Actif</button>
		<button id="off" class="btn btn-default">Inactif</button>
	<?php
	}
	?>
		
</div>
<!--/Maintenance mode button totally active-->
<?php endif; ?>

<br />

<!--    <h3>Mode Maintenance</h3> -->

<!--Maintenance mode switch button not finished-->
<!--
<div class="form-group">

    <div class="checkbox">

        <input type="checkbox" name="gender" id="gender" checked/>

    </div>
</div>
<input type="hidden" name="hidden_gender" id="hidden_gender" value="male" />
-->
<!--/Maintenance mode switch button not finished-->



<script>
	//Colors of the on/off button
    $('.btn-toggle').click(function() {
        $(this).find('.btn').toggleClass('active');

        if ($(this).find('.btn-primary').length > 0) {
            $(this).find('.btn').toggleClass('btn-primary');
            //		alert("Boutton cliqué.");
        }

        $(this).find('.btn').toggleClass('btn-default');



    });

</script>




<script>
	//Functions of the on/off button
    $(document).ready(function() {

        $("#on").click(function() {
            var action = "on";
            $.ajax({
//				type: "GET",
//              url: '<?php echo base_url("pages/maintenance/on") ?>',
//				data: 'action' + action,
//              success: function(data) {
//              	alert("Boutton ON cliqué.");
				
				type: 'post',
				contentType: 'application/x-www-form-urlencoded', 
              	url: '<?php echo base_url("pages/maintenance") ?>',
				data: {'action' : action},
              	success: function(data) {
              	alert("Mode maintenance activé");
                }
            })
        });

        $("#off").click(function() {
            var action = "off";

            $.ajax({
//				type: "GET",
//              url: '<?php echo base_url("pages/maintenance/off") ?>',
//				data: 'action' + action,
//              success: function(data) {
//              	alert("Boutton OFF cliqué.");
				
				type: "post",
				contentType: 'application/x-www-form-urlencoded', 
              	url: '<?php echo base_url("pages/maintenance") ?>',
				data: {'action' : action},
              	success: function(data) {
              	alert("Mode maintenance desactivé.");
                }
            })
        });


    });

</script>



<script>
	
//Functions of the on/off switch button
$(document).ready(function() {

$('#gender').bootstrapToggle();

$('#gender').change(function(){
    if ($(this).prop('checked'))
    {
	var action = "on";
	$.ajax({
//				type: "GET",
//              url: '<?php echo base_url("pages/maintenance/on") ?>',
//				data: 'action' + action,
//              success: function(data) {
//              	alert("Boutton ON cliqué.");

			type: 'post',
			contentType: 'application/x-www-form-urlencoded', 
			url: '<?php echo base_url("pages/maintenance") ?>',
			data: {'action' : action},
			success: function(data) {
			alert("Mode maintenance activé");
			}
		})
    }
    else
    {
	var action = "off";
	$.ajax({
//				type: "GET",
//              url: '<?php echo base_url("pages/maintenance/off") ?>',
//				data: 'action' + action,
//              success: function(data) {
//              	alert("Boutton OFF cliqué.");

	type: "post",
	contentType: 'application/x-www-form-urlencoded', 
	url: '<?php echo base_url("pages/maintenance") ?>',
	data: {'action' : action},
	success: function(data) {
	alert("Mode maintenance desactivé.");
	}
	})
    }
});

    });

</script>
