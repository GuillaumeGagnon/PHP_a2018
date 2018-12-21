<?php

$urlToCarsAutocompletedemoJson = $this->Url->build([
    "controller" => "trains",
    "action" => "trouverTrain",
    "_ext" => "json"
        ]);

echo $this->Html->scriptBlock('var urlToAutocompleteAction = "' . $urlToCarsAutocompletedemoJson . '";', ['block' => true]);
echo $this->Html->script('trains/autocompletetrains', ['block' => 'scriptBottom']);
?>


<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Train[]|\Cake\Collection\CollectionInterface $trains
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
<div class="trains index large-9 medium-8 columns content">
    <h3><?= __('Trains') ?></h3>
	
		
		<fieldset>
			<legend><?= __('Chercher un nom de train (autocomplete)') ?></legend>
			<?php
			echo $this->Form->control('name', ['id' => 'autocomplete']);
			?>
		</fieldset>
	
	
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <!--<th scope="col"><?= $this->Paginator->sort('id') ?></th>-->
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('origin_station') ?></th>
                <th scope="col"><?= $this->Paginator->sort('final_station') ?></th>
                <!--<th scope="col"><?= $this->Paginator->sort('private') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>-->
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($trains as $train): ?>
            <tr>
                <!--<td><?= $this->Number->format($train->id) ?></td>-->
                <td><?= h($train->name) ?></td>
                <td><? echo $stations[$train->origin_station];  //= h($train->origin_station) ?></td>
                <td><? echo $stations[$train->final_station];  //= h($train->final_station) ?></td>
                <!--<td><?= h($train->private) ?></td>
                <td><?= h($train->created) ?></td>
                <td><?= h($train->modified) ?></td>-->
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $train->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $train->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $train->id], ['confirm' => __('Are you sure you want to delete # {0}?', $train->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
