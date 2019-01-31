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
        <h2 style="margin-top:0px">Resultat_cours <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">IdCe <?php echo form_error('idCe') ?></label>
            <input type="text" class="form-control" name="idCe" id="idCe" placeholder="IdCe" value="<?php echo $idCe; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">IdEtd <?php echo form_error('idEtd') ?></label>
            <input type="text" class="form-control" name="idEtd" id="idEtd" placeholder="IdEtd" value="<?php echo $idEtd; ?>" />
        </div>
	    <div class="form-group">
            <label for="float">Td <?php echo form_error('td') ?></label>
            <input type="text" class="form-control" name="td" id="td" placeholder="Td" value="<?php echo $td; ?>" />
        </div>
	    <div class="form-group">
            <label for="float">Tp <?php echo form_error('tp') ?></label>
            <input type="text" class="form-control" name="tp" id="tp" placeholder="Tp" value="<?php echo $tp; ?>" />
        </div>
	    <div class="form-group">
            <label for="float">Interro <?php echo form_error('interro') ?></label>
            <input type="text" class="form-control" name="interro" id="interro" placeholder="Interro" value="<?php echo $interro; ?>" />
        </div>
	    <div class="form-group">
            <label for="float">Examen <?php echo form_error('examen') ?></label>
            <input type="text" class="form-control" name="examen" id="examen" placeholder="Examen" value="<?php echo $examen; ?>" />
        </div>
	    <input type="hidden" name="idRc" value="<?php echo $idRc; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('resultat_cours') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>
