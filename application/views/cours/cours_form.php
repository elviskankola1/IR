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
        <h2 style="margin-top:0px">Cours <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">NomCours <?php echo form_error('nomCours') ?></label>
            <input type="text" class="form-control" name="nomCours" id="nomCours" placeholder="NomCours" value="<?php echo $nomCours; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">DetailsCours <?php echo form_error('detailsCours') ?></label>
            <input type="text" class="form-control" name="detailsCours" id="detailsCours" placeholder="DetailsCours" value="<?php echo $detailsCours; ?>" />
        </div>
	    <input type="hidden" name="idCours" value="<?php echo $idCours; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('cours') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>
