<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
 
 //nav v1.2.0
 if(array_key_exists('Auth', $_SESSION)){
	  if($_SESSION['Auth'] != null){
		$role = $_SESSION['Auth']['User']['role'];
		if($role === 2){$role = 'admin';}else if($role === 1){$role = 'member';}
	  } else {$role = 'anonymous';}
  } else {$role = 'anonymous';}
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
		<?php if($role === 'admin'){
			
			echo '<li>Administrator actions</li>';
			echo '<li>'. $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) .'</li>';
			echo '<li>'. $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) .'</li>';
			echo '<li>'. $this->Html->link(__('New Train'), ['controller' => 'Trains', 'action' => 'add']) .'</li>';
			//echo '<li>'. $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) .'</li>';
			echo '<li>'. $this->Html->link(__('New Station'), ['controller' => 'Stations', 'action' => 'add']) .'</li>';
			echo '<li>'. $this->Html->link(__('New Station Type'), ['controller' => 'StationTypes', 'action' => 'add']) .'</li>';
			
			/*not sure if admin or not*/
			
			
			//echo '<li class="subtitle">Other actions</li>';
		} ?>
		
		<?php if($role === 'member' || $role === 'admin'){
			
			echo '<li>Member actions</li>';
			echo '<li>'. $this->Html->link(__('List Passenger'), ['controller' => 'Passengers', 'action' => 'index']) .'</li>';
			echo '<li>'. $this->Html->link(__('New Passenger'), ['controller' => 'Passengers', 'action' => 'add']) .'</li>';
			
			
		} ?>
		
	    <li>Basic actions</li>
		<li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Trains'), ['controller' => 'Trains', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Stations'), ['controller' => 'Stations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List Station Types'), ['controller' => 'StationTypes', 'action' => 'index']) ?> </li>
        
		
        
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h3>Guillaume Gagnon</h3>
	<h5>420-5b7 MO Applications internet</h5>
	<h5>Automne 2018, Collège Montmorency</h5>
	<br>
	
	<p>
		Les menus (horizontal et vertical) changent si on se connecte en tant que membre.
		<br> 
		Ils changent encore si on se connecte en tant qu'admin.
	</p>
	
	<p>
		Chaque action du site est soit public (pour les visiteurs), limitée (pour les membres) ou protégée (pour les admin)
	</p>
	
	<p>
		La traduction du fichier *.pot en *.po n'est pas complète.
		<br>La table i18n est créée mais elle n'est pas encore utilisée (manque de temps)
		<br>
		Le "behavior" Translate n'est pas implanter
	</p>
	
	<p>Le téléversement d'imgage aussi est manquant pour le moment.</p>
	<p>L'envoie de courriels n'est pas implanter pour le moment.</p>
	<p>La base de données n'est pas encore sous SQLite.</p>
	
	<img src="../img/diagramme.JPG" alt="diagramme de la base de données">
	<a href="../img/diagramme.JPG">Ouvrir l'original</a>
	<?php // echo $this->Html->image('diagramme.JPG', ['fullBase' => true]); ?>
	
	
</div>
