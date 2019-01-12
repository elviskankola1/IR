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
        <h2 style="margin-top:0px">Cours_enseigne <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">IdPe <?php echo form_error('idPe') ?></label>
            <input type="text" class="form-control" name="idPe" id="idPe" placeholder="IdPe" value="<?php echo $idPe; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">IdProf <?php echo form_error('idProf') ?></label>
            <input type="text" class="form-control" name="idProf" id="idProf" placeholder="IdProf" value="<?php echo $idProf; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">IdCours <?php echo form_error('idCours') ?></label>
            <input type="text" class="form-control" name="idCours" id="idCours" placeholder="IdCours" value="<?php echo $idCours; ?>" />
        </div>
	    <input type="hidden" name="idCe" value="<?php echo $idCe; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('cours_enseigne') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>