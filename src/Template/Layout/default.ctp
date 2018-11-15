<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

 //nav v1.2.0
 if(array_key_exists('Auth', $_SESSION)){
	  if($_SESSION['Auth'] != null){
		$role = $_SESSION['Auth']['User']['role'];
		if($role === 2){$role = 'admin';}else if($role === 1){$role = 'member';}
	  } else {$role = 'anonymous';}
  } else {$role = 'anonymous';}


$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css([
            'base.css',
            'style.css',
            'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'
        ]);?>
        <?= $this->Html->css([
            'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'
        ],['integrity'=>"sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO",'crossorigin'=>"anonymous"]);
        ?>

        <?= $this->Html->script([
            'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'],
			
			['integrity'=>"sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy",'crossorigin'=>"anonymous", 
			
			'block'=>"bootstrap"
        ]);
        ?>
        <?php echo $this->Html->script(['https://code.jquery.com/jquery-1.12.4.js',
		
		'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
		
		'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'], 
		
		['block' => 'scriptLibraries']
        );
        ?>

    <?= $this->fetch('meta') ?>
	
    <?= $this->fetch('css') ?>
	
    <?= $this->fetch('script') ?>
	
    <?= $this->fetch('scriptLibraries') ?>
	
    <?= $this->fetch('bootstrap') ?>
	
	<?//= $this->fetch('scriptBottom') ?>
	
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <a class="navbar-brand" href="http://localhost/PHP/trains">Home</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
			  <li class="nav-item active">
				<?php if($role === 'anonymous'){ ?>
                <?= $this->Html->link(__('Login'), ['controller' => 'Users', 'action' => 'login'],['class' => 'nav-link']) ?>
			<?php } else { ?>	
				<?= $this->Html->link(__($role), ['controller' => 'Users', 'action' => 'view/'.$_SESSION['Auth']['User']['id']],['class' => 'nav-link']) ?>
				</li>
			  <li class="nav-item active">
				<?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout'],['class' => 'nav-link']) ?>
				
			<?php } ?>
				<!--<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>-->
			  
			  </li>
			  <li class="nav-item">
				<?= $this->Html->link(__('About'), ['controller' => 'Users', 'action' => 'about'],['class' => 'nav-link']) ?>
			  </li>
			  <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Language
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<?= $this->Html->link('Français', ['action' => 'changeLang', 'fr_CA'], ['class' => 'dropdown-item'], ['escape' => false]) ?>
				<?= $this->Html->link('English', ['action' => 'changeLang', 'en_US'], ['class' => 'dropdown-item'], ['escape' => false]) ?>
				</div>
			  </li>
			  
			</ul>
			
		  </div>
</nav>






<!--
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href="/PHP/trains">Home<?// $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
			<?php if($role === 'anonymous'){ ?>
                <li><?= $this->Html->link(__('Login'), ['controller' => 'Users', 'action' => 'login']) ?></li>
			<?php } else { ?>	
				<li><?= $this->Html->link(__($role), ['controller' => 'Users', 'action' => 'view/'.$_SESSION['Auth']['User']['id']]) ?></li>
				<li><?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']) ?></li>
				
			<?php } ?>
			<li><?= $this->Html->link(__('About'), ['controller' => 'Users', 'action' => 'about']) ?></li>
			
			<li>
				<?= $this->Html->link('Français', ['action' => 'changeLang', 'fr_CA'], ['escape' => false]) ?>
			</li>
			
			<!--<li>
				<?= $this->Html->link('Deutsch', ['action' => 'changeLang', 'de_DE'], ['escape' => false]) ?>
            </li> -/->
			
            <li>
				<?= $this->Html->link('English', ['action' => 'changeLang', 'en_US'], ['escape' => false]) ?>
            </li>
			
			
			
			</ul>
        </div>
    </nav>
	-->
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
		<?= $this->fetch('scriptBottom') ?>
		
		
	
		
		
    </div>
    <footer>
    </footer>
</body>
</html>
