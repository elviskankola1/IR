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
        <h2 style="margin-top:0px">Etudiant Read</h2>
        <table class="table">
	    <tr><td>MatriculeEtd</td><td><?php echo $matriculeEtd; ?></td></tr>
	    <tr><td>NomEtd</td><td><?php echo $nomEtd; ?></td></tr>
	    <tr><td>PostnomEtd</td><td><?php echo $postnomEtd; ?></td></tr>
	    <tr><td>PrenomEtd</td><td><?php echo $prenomEtd; ?></td></tr>
	    <tr><td>EmailEtd</td><td><?php echo $emailEtd; ?></td></tr>
	    <tr><td>GenreEtd</td><td><?php echo $genreEtd; ?></td></tr>
	    <tr><td>PwdEtd</td><td><?php echo $pwdEtd; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('etudiant') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>
