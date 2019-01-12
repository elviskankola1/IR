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
        <h2 style="margin-top:0px">Promotion <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">NomPromo <?php echo form_error('nomPromo') ?></label>
            <input type="text" class="form-control" name="nomPromo" id="nomPromo" placeholder="NomPromo" value="<?php echo $nomPromo; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">IdDept <?php echo form_error('idDept') ?></label>
            <input type="text" class="form-control" name="idDept" id="idDept" placeholder="IdDept" value="<?php echo $idDept; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">DetailsPromo <?php echo form_error('detailsPromo') ?></label>
            <input type="text" class="form-control" name="detailsPromo" id="detailsPromo" placeholder="DetailsPromo" value="<?php echo $detailsPromo; ?>" />
        </div>
	    <input type="hidden" name="idPromo" value="<?php echo $idPromo; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('promotion') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>