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
        <h2 style="margin-top:0px">Cours_enseigne Read</h2>
        <table class="table">
	    <tr><td>IdPe</td><td><?php echo $idPe; ?></td></tr>
	    <tr><td>IdProf</td><td><?php echo $idProf; ?></td></tr>
	    <tr><td>IdCours</td><td><?php echo $idCours; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('cours_enseigne') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>
