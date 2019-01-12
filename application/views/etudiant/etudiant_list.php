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
        <h2 style="margin-top:0px">Etudiant List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('etudiant/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('etudiant/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('etudiant'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>MatriculeEtd</th>
		<th>NomEtd</th>
		<th>PostnomEtd</th>
		<th>PrenomEtd</th>
		<th>EmailEtd</th>
		<th>GenreEtd</th>
		<th>PwdEtd</th>
		<th>Action</th>
            </tr><?php
            foreach ($etudiant_data as $etudiant)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $etudiant->matriculeEtd ?></td>
			<td><?php echo $etudiant->nomEtd ?></td>
			<td><?php echo $etudiant->postnomEtd ?></td>
			<td><?php echo $etudiant->prenomEtd ?></td>
			<td><?php echo $etudiant->emailEtd ?></td>
			<td><?php echo $etudiant->genreEtd ?></td>
			<td><?php echo $etudiant->pwdEtd ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('etudiant/read/'.$etudiant->idEtd),'Read'); 
				echo ' | '; 
				echo anchor(site_url('etudiant/update/'.$etudiant->idEtd),'Update'); 
				echo ' | '; 
				echo anchor(site_url('etudiant/delete/'.$etudiant->idEtd),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </body>
</html>