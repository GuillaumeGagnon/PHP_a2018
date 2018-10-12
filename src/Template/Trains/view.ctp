<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Train $train
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
		
		<?php if($role === 'admin'){ ?>
		<li>Item related actions</li>
		<li><?= $this->Html->link(__('Edit Train'), ['action' => 'edit', $train->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Train'), ['action' => 'delete', $train->id], ['confirm' => __('Are you sure you want to delete # {0}?', $train->id)]) ?> </li>

		<?php 
			
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
<div class="trains view large-9 medium-8 columns content">
    <h3><?= h($train->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($train->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Origin Station') ?></th>
            <td><? echo $stations[$train->origin_station]; //<?= h($train->origin_station) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Final Station') ?></th>
            <td><? echo $stations[$train->final_station]; //<?= h($train->final_station) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($train->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($train->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($train->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Private') ?></th>
            <td><?= $train->private ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
