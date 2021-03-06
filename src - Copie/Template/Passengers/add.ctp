<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Passenger $passenger
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
<div class="passengers form large-9 medium-8 columns content">
    <?= $this->Form->create($passenger) ?>
    <fieldset>
        <legend><?= __('Add Passenger') ?></legend>
        <?php
		//$test = $_SESSION['Auth']['User']['id'];
		//debug($test);
		//debug($_SESSION['Auth']['User']);
            //echo $this->Form->control('user_id', ['options' => $users]);
			//echo '<br>';
			/*echo*/ $this->Form->control('user_id', ['options' => array($_SESSION['Auth']['User']['id'])]);
			
			echo 'Email Address<br><b>';
			echo $_SESSION['Auth']['User']['email'];
			echo'</b><br><br>';
			//debug($this->Form->control('train_id', ['options' => $trains]));
			echo $this->Form->control('train_id', ['options' => $trains]);
            echo $this->Form->control('name');
            echo $this->Form->control('address');
            echo $this->Form->control('phone');
            echo $this->Form->control('other');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
