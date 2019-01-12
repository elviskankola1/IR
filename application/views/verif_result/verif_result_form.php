<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Verif_result <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">IdEtd <?php echo form_error('idEtd') ?></label>
            <input type="text" class="form-control" name="idEtd" id="idEtd" placeholder="IdEtd" value="<?php echo $idEtd; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">DateConnexion <?php echo form_error('dateConnexion') ?></label>
            <input type="text" class="form-control" name="dateConnexion" id="dateConnexion" placeholder="DateConnexion" value="<?php echo $dateConnexion; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Etat <?php echo form_error('etat') ?></label>
            <input type="text" class="form-control" name="etat" id="etat" placeholder="Etat" value="<?php echo $etat; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">NbV <?php echo form_error('nbV') ?></label>
            <input type="text" class="form-control" name="nbV" id="nbV" placeholder="NbV" value="<?php echo $nbV; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">NbTele <?php echo form_error('nbTele') ?></label>
            <input type="text" class="form-control" name="nbTele" id="nbTele" placeholder="NbTele" value="<?php echo $nbTele; ?>" />
        </div>
	    <input type="hidden" name="idVr" value="<?php echo $idVr; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('verif_result') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>