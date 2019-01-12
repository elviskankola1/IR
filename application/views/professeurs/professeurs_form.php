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
        <h2 style="margin-top:0px">Professeurs <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">MatriculeProf <?php echo form_error('matriculeProf') ?></label>
            <input type="text" class="form-control" name="matriculeProf" id="matriculeProf" placeholder="MatriculeProf" value="<?php echo $matriculeProf; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">NomProf <?php echo form_error('nomProf') ?></label>
            <input type="text" class="form-control" name="nomProf" id="nomProf" placeholder="NomProf" value="<?php echo $nomProf; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">PostnomProf <?php echo form_error('postnomProf') ?></label>
            <input type="text" class="form-control" name="postnomProf" id="postnomProf" placeholder="PostnomProf" value="<?php echo $postnomProf; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">PrenomProf <?php echo form_error('prenomProf') ?></label>
            <input type="text" class="form-control" name="prenomProf" id="prenomProf" placeholder="PrenomProf" value="<?php echo $prenomProf; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">EmailProf <?php echo form_error('emailProf') ?></label>
            <input type="text" class="form-control" name="emailProf" id="emailProf" placeholder="EmailProf" value="<?php echo $emailProf; ?>" />
        </div>
	    <input type="hidden" name="idProf" value="<?php echo $idProf; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('professeurs') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>