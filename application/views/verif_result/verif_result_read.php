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
        <h2 style="margin-top:0px">Verif_result Read</h2>
        <table class="table">
	    <tr><td>IdEtd</td><td><?php echo $idEtd; ?></td></tr>
	    <tr><td>DateConnexion</td><td><?php echo $dateConnexion; ?></td></tr>
	    <tr><td>Etat</td><td><?php echo $etat; ?></td></tr>
	    <tr><td>NbV</td><td><?php echo $nbV; ?></td></tr>
	    <tr><td>NbTele</td><td><?php echo $nbTele; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('verif_result') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>
