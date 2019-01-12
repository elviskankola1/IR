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
        <h2 style="margin-top:0px">Promotion Read</h2>
        <table class="table">
	    <tr><td>NomPromo</td><td><?php echo $nomPromo; ?></td></tr>
	    <tr><td>IdDept</td><td><?php echo $idDept; ?></td></tr>
	    <tr><td>DetailsPromo</td><td><?php echo $detailsPromo; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('promotion') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>