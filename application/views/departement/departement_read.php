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
        <h2 style="margin-top:0px">Departement Read</h2>
        <table class="table">
	    <tr><td>NomDep</td><td><?php echo $nomDep; ?></td></tr>
	    <tr><td>IdFac</td><td><?php echo $idFac; ?></td></tr>
	    <tr><td>DetailsDep</td><td><?php echo $detailsDep; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('departement') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>
