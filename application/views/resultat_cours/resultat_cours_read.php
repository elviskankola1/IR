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
        <h2 style="margin-top:0px">Resultat_cours Read</h2>
        <table class="table">
	    <tr><td>IdCe</td><td><?php echo $idCe; ?></td></tr>
	    <tr><td>IdEtd</td><td><?php echo $idEtd; ?></td></tr>
	    <tr><td>Td</td><td><?php echo $td; ?></td></tr>
	    <tr><td>Tp</td><td><?php echo $tp; ?></td></tr>
	    <tr><td>Interro</td><td><?php echo $interro; ?></td></tr>
	    <tr><td>Examen</td><td><?php echo $examen; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('resultat_cours') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>