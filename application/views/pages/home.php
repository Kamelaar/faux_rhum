<h2>
    <?= $title ?>
</h2> <br />

<p>Bienvenue sur le Faux Rhum</p>

<p>Nous avons un total de
    <?= $totalMembers ?> heureux membres</p> <br />

<h3 align="center">Membres les plus actifs</h3> <br />

<table class="table table-bordered table-striped">

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

</table> <br />

<h3>Mode Maintenance</h3> <br />

<!--Maintenance mode button totally active-->
<div class="btn-group btn-toggle">
	<?php 
	
	$maintenance = $maintenanceStatus->maintenance_mode;
	
	if ($maintenance == 0){ 
	?> 
		<button id="on" class="btn btn-default ">ON</button>
		<button id="off" class="btn btn-primary active">OFF</button>
	<?php
	}
	else
	{
	?>
		<button id="on" class="btn btn-primary active ">ON</button>
		<button id="off" class="btn btn-default">OFF</button>
	<?php
	}
	?>
		
</div>
<!--/Maintenance mode button totally active-->

<br />

    <h3>Mode Maintenance</h3> 

<!--Maintenance mode switch button not finished-->
<div class="form-group">

    <div class="checkbox">

        <input type="checkbox" name="gender" id="gender" checked/>

    </div>
</div>
<input type="hidden" name="hidden_gender" id="hidden_gender" value="male" />
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
