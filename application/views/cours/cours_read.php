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
        <h2 style="margin-top:0px">Cours Read</h2>
        <table class="table">
	    <tr><td>NomCours</td><td><?php echo $nomCours; ?></td></tr>
	    <tr><td>DetailsCours</td><td><?php echo $detailsCours; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('cours') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>
