<!doctype html>
<html>
    <head>
        <title>Instant Result 1.0</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Promo_encours <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">IdPromo <?php echo form_error('idPromo') ?></label>
            <input type="text" class="form-control" name="idPromo" id="idPromo" placeholder="IdPromo" value="<?php echo $idPromo; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">IdEtd <?php echo form_error('idEtd') ?></label>
            <input type="text" class="form-control" name="idEtd" id="idEtd" placeholder="IdEtd" value="<?php echo $idEtd; ?>" />
        </div>
	    <div class="form-group">
            <label for="year">Annee <?php echo form_error('annee') ?></label>
            <input type="text" class="form-control" name="annee" id="annee" placeholder="Annee" value="<?php echo $annee; ?>" />
        </div>
	    <input type="hidden" name="idPe" value="<?php echo $idPe; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('promo_encours') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>
