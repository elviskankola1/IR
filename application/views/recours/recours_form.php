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
        <h2 style="margin-top:0px">Recours <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">IdEtd <?php echo form_error('idEtd') ?></label>
            <input type="text" class="form-control" name="idEtd" id="idEtd" placeholder="IdEtd" value="<?php echo $idEtd; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">DateRec <?php echo form_error('dateRec') ?></label>
            <input type="text" class="form-control" name="dateRec" id="dateRec" placeholder="DateRec" value="<?php echo $dateRec; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">TxtRecours <?php echo form_error('txtRecours') ?></label>
            <input type="text" class="form-control" name="txtRecours" id="txtRecours" placeholder="TxtRecours" value="<?php echo $txtRecours; ?>" />
        </div>
	    <input type="hidden" name="idRecours" value="<?php echo $idRecours; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('recours') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>