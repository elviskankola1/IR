<h1>Ajout de l'admin</h1>
<form method='POST' action='<?php echo site_url('admin/add');    ?>'>
    <div>
        <label for='username'>Nom d'utilisateur</label>
        <input name='username' type='text'/>

    </div>
    <div>
        <label for='pwd'>Mot de passe</label>
        <input name='pwd' type='password'/>

    </div>
    
    <div>
        <label for='level'>Votre niveau</label>
        <input name='level' type='text'/>

    </div>
    <div>
    
    <input type='submit' value='Connect'/>

    </div>
</form>