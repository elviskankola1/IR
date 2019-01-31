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
        <h2 style="margin-top:0px">Admin Read</h2>
        <table class="table">
	    <tr><td>Username</td><td><?php echo $username; ?></td></tr>
	    <tr><td>Pwd</td><td><?php echo $pwd; ?></td></tr>
	    <tr><td>Level</td><td><?php echo $level; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('admin') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>
