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
        <h2 style="margin-top:0px">Recours Read</h2>
        <table class="table">
	    <tr><td>IdEtd</td><td><?php echo $idEtd; ?></td></tr>
	    <tr><td>DateRec</td><td><?php echo $dateRec; ?></td></tr>
	    <tr><td>TxtRecours</td><td><?php echo $txtRecours; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('recours') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>
