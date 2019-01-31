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
        <h2 style="margin-top:0px">Professeurs Read</h2>
        <table class="table">
	    <tr><td>MatriculeProf</td><td><?php echo $matriculeProf; ?></td></tr>
	    <tr><td>NomProf</td><td><?php echo $nomProf; ?></td></tr>
	    <tr><td>PostnomProf</td><td><?php echo $postnomProf; ?></td></tr>
	    <tr><td>PrenomProf</td><td><?php echo $prenomProf; ?></td></tr>
	    <tr><td>EmailProf</td><td><?php echo $emailProf; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('professeurs') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>
