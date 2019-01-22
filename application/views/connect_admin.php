<!DOCTYPE html>
<html>


<h1>Connection de l'administrateur</h1>
<form method='POST'  action ='<?php echo site_url('admin/log');?>' >
    <div>
        <label for='username'>Nom d'utilisateur</label>
        <input name='username' type='text'/>

        
    </div>
    <?php echo form_error('username');?>
    <div>
        <label for='pwd'>Mot de passe</label>
        <input name='pwd' type='password' value='<?php echo set_value('pwd');?>'/>
       
    </div>
    <?php echo form_error('pwd');?>
    
    <div>
    
    <input type='submit' value='Connect'/>

    </div>
    <?php echo $this->session->erreur;?>
</form>
<a href='<?php echo site_url('admin/add');?>'> ajouter un admin</a></br>
<a href='<?php echo site_url('admin/voir');?>'> voir les admin</a>
</html>