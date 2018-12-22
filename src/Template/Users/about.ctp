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
	<h5>User admin : 123@admin.admin</h5>
	<h5>Password : 123</h5>
	<br>
	<p>
		<a target="_blank" href="https://github.com/GuillaumeGagnon/PHP_a2018.git">Lien GitHub (désuet, pas à jour)</a>
	</p>

	<div style="border: 1px solid black;padding:2px;">
		<h1>TP3</h1>
		<div style="border: 1px solid blue;padding:2px;">
		<h3>Stratégie d'objectifs</h3>
		<p>Mon site permet de recenser les trains, les stations (ainsi que leur type respectif), 
		et les passagers, en plus d'intégrer un système d'utilisateur avec connection 
		et gestion des droits d'accès. Donc, on peut afficher facilement les informations pertinantes
		sur un train tel que son nom ou encore sa station d'origine et celle d'arrivée. 
		<br>L'information est donc facile d'accèc en plus d'être protégée via le système de gestion des droits d'accès</p>
		</div>
		<br>
		<div style="border: 1px solid blue;padding:2px;">
		<h3>Stratégie de cible</h3>
		<p>Mon site pourrait être utile pour une société de transport en commun comme 
		l'Autorité régionale de transport métropolitain (ARTM) qui gère la STM, la STL, etc.
		Le site pourrait être utilisé autant à l'interne pour les employés (exemple : les chauffeurs 
		pourraient prendre connaissance des noms des passagers pour leur prochain quart de travail)
		ou à l'externe pour que les utilisateurs du réseau de transport en commun puissent réserver
		leurs places.
		
		</p>
		</div>


		<h5>Lors de l'ajout d'un train, nous avons des listes liées en AngularJS : <?= $this->Html->link(__('Listes liées'), ['controller' => 'Trains', 'action' => 'add']) ?> </h5>
		<p>La premiere liste nous donne comme choix les types de stations (exp.: Civil, Militaire, Industrielle, futur_station). <br><br>Si on choisit "Militaire", la deuxième liste s'active et nous donne comme choix
		"Valcartier" et "test_militaire" car ce sont les deux seules stations ayant le type "station_militaire". <br><br>Si on change pour civile par exemple, les choix de la deuxième liste se mettent à jour : ils deviennent "Cartier",
		"Rosemont", "test_civile" et "test_" car ce sont les stations ayant le type "station_civile".
		<br>(Dans mon cas, les listes sont en double car j'ai une paire de liste pour la station d'origine et une autre pour la station finale (les paires sont indépendantes l'une de l'autre).
		</p>
		<br>
		<h5>Le téléversement de fichiers a été implémenté!!! (Enfin!).<br>De plus, nous pouvons maintenant utiliser le drag-and-drop :) . <?= $this->Html->link(__('Drag-and-drop'), ['controller' => 'Images', 'action' => 'index']) ?></h5>
		<p>Pour faire simple, le drag-and-drop appelle une fonction qui "add" directement le fichier et ensuite elle refresh la page index (pour que l'on puisse voir le nouvel enregistrement)</p>
		<h5>Ajout d'un Captcha pour le login : <?= $this->Html->link(__('Login'), ['controller' => 'Users', 'action' => 'login']) ?></h5>
		<p>Si on essaye de se connecter sans effectuer le Captcha, l'application nous retourne une erreur (à l'aide d'un flash error)
		<br><br>Sinon, elle vérifie le Captcha et si le Captcha est validé, fonction login se poursuie et connecte l'utilisateur, comme avant.
		<br><br>Le Captcha est une sécurité simple et efficace qui bloque les bots (les robots/script). Donc, on s'assure à l'aide du Captcha que les utilisateur qui se connecte sont des humains. Bye bye robots :/
		</p>
		<br>
		<p>Opérations "CRUD" avec AngularJS : non-fait<br>
		Jeton JWT avec AngularJS : j'avais commencé à implémenter cette fonction mais j'ai rencontré des difficultés et
		 j'ai du défaire les changements que j'avais fais (je pense qu'il en reste quelques vestiges en commentaire) afin 
		 de pouvoir remettre une application fonctionnelle.
		
		</p>
	</div>

	<br>
	<br>
	<br>


	<h1>Anciens TPs :</h1>



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
		<br>
		La table i18n est créée mais elle n'est pas encore utilisée (manque de temps)
		<br>
		Le "behavior" Translate n'est pas implanter
		<br>
		Le téléversement d'imgage aussi est manquant pour le moment.
		<br>
		L'envoie de courriels n'est pas implanter pour le moment.
	</p>
	<br/>
	<h3>TP2 :</h3>
	<p>Le menu horizontal (navbar) est maintenant géré avec Bootstrap</p>
	<p>La fonction autocomplete de JQuery UI est implémentée dans la page index du controlleur "Trains" Le champs de recherche de nom de train autocomplete l'entré utilisateur.</p>
	<p>La base de données est maintenant sous SQLite.</p>
	<p>On peut enregistrer sous pdf les pages "view" du controlleur "Trains"
		<br>
		(L'application suppose que "wkhtmltopdf" est installé ici : "C:\wkhtmltopdf\bin")
	</p>
	<p>Migration a été utilisée et contient la version initiale de la BD
		<br>
		Les données ont étées exportées dans le dossier "Seeds"
	</p>
	<p>Les tests n'ont pas encore étés écrits même si PHPunit est installé.
		<br>
		Début du codage des tests. Génération de la page "coverage"("webroot\coverage\index.hmtl").
	</p>
	<h1>ATTENTION</h1>
	<h3>Pour une raison que j'ignore, lorsque j'ai roulé mes tests, mon fichier de base de données (sqlite.sqlite) à été vidé de ses tables. J'ai beaucoup cherché mais par manque de temps je n'ai toujours pas trouvé de solution.</h3>
	

	
	
	<br>
	<img src="../img/diagramme.JPG" alt="diagramme de la base de données">
	<a href="../img/diagramme.JPG">Ouvrir l'original</a>
	<?php // echo $this->Html->image('diagramme.JPG', ['fullBase' => true]); ?>
	
	
</div>
