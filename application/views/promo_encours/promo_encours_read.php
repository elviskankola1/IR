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
        <h2 style="margin-top:0px">Promo_encours Read</h2>
        <table class="table">
	    <tr><td>IdPromo</td><td><?php echo $idPromo; ?></td></tr>
	    <tr><td>IdEtd</td><td><?php echo $idEtd; ?></td></tr>
	    <tr><td>Annee</td><td><?php echo $annee; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('promo_encours') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>
