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
        <h2 style="margin-top:0px">Etudiant <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">MatriculeEtd <?php echo form_error('matriculeEtd') ?></label>
            <input type="text" class="form-control" name="matriculeEtd" id="matriculeEtd" placeholder="MatriculeEtd" value="<?php echo $matriculeEtd; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">NomEtd <?php echo form_error('nomEtd') ?></label>
            <input type="text" class="form-control" name="nomEtd" id="nomEtd" placeholder="NomEtd" value="<?php echo $nomEtd; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">PostnomEtd <?php echo form_error('postnomEtd') ?></label>
            <input type="text" class="form-control" name="postnomEtd" id="postnomEtd" placeholder="PostnomEtd" value="<?php echo $postnomEtd; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">PrenomEtd <?php echo form_error('prenomEtd') ?></label>
            <input type="text" class="form-control" name="prenomEtd" id="prenomEtd" placeholder="PrenomEtd" value="<?php echo $prenomEtd; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">EmailEtd <?php echo form_error('emailEtd') ?></label>
            <input type="text" class="form-control" name="emailEtd" id="emailEtd" placeholder="EmailEtd" value="<?php echo $emailEtd; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">GenreEtd <?php echo form_error('genreEtd') ?></label>
            <input type="text" class="form-control" name="genreEtd" id="genreEtd" placeholder="GenreEtd" value="<?php echo $genreEtd; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">PwdEtd <?php echo form_error('pwdEtd') ?></label>
            <input type="text" class="form-control" name="pwdEtd" id="pwdEtd" placeholder="PwdEtd" value="<?php echo $pwdEtd; ?>" />
        </div>
	    <input type="hidden" name="idEtd" value="<?php echo $idEtd; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('etudiant') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>