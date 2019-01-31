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
        <h2 style="margin-top:0px">Departement <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">NomDep <?php echo form_error('nomDep') ?></label>
            <input type="text" class="form-control" name="nomDep" id="nomDep" placeholder="NomDep" value="<?php echo $nomDep; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">IdFac <?php echo form_error('idFac') ?></label>
            <input type="text" class="form-control" name="idFac" id="idFac" placeholder="IdFac" value="<?php echo $idFac; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">DetailsDep <?php echo form_error('detailsDep') ?></label>
            <input type="text" class="form-control" name="detailsDep" id="detailsDep" placeholder="DetailsDep" value="<?php echo $detailsDep; ?>" />
        </div>
	    <input type="hidden" name="idDep" value="<?php echo $idDep; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('departement') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>
