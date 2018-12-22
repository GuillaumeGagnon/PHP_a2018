<?php


$urlToLinkedListFilter = $this->Url->build([
    "controller" => "StationTypes",
    "action" => "getTypes",
    "_ext" => "json"
        ]);
echo $this->Html->scriptBlock('var urlToLinkedListFilter = "' . $urlToLinkedListFilter . '";', ['block' => true]);
echo $this->Html->script('Trains/add', ['block' => 'scriptBottom']);



?>

<?php

/*
$urlToLinkedListFilter = $this->Url->build([
    "controller" => "Stations",
    "action" => "filtreListeLiees",
    "_ext" => "json"
        ]);
echo $this->Html->scriptBlock('var urlToLinkedListFilter = "' . $urlToLinkedListFilter . '";', ['block' => true]);
echo $this->Html->script('Trains/add', ['block' => 'scriptBottom']);
*/
?>


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

<div class="trains form large-9 medium-8 columns content" ng-app="linkedlists" ng-controller="stationTypesControlleur">
    <?= $this->Form->create($train) ?>
    <fieldset>
		<legend><?= __('Add Train') ?></legend>
		<?php 
		/*debug($station_types);
		debug($station_types);*/

		echo $this->Form->control('name');
		?>
		<div>
			Catégorie de la station d'origine:
            <select name="stationTypes_id"
                    id="stationTypes-id" 
                    ng-model="stationType" 
                    ng-options="stationType.type for stationType in stationTypes track by stationType.id"
                    >
                <option value=''>Select</option>
            </select>
        </div>
        <div>
            Station: 
            <select name="origin_station"
                    id="origin_station" 
                    ng-disabled="!stationType" 
                    ng-model="station"
                    ng-options="station.name for station in stationType.stations track by station.id"
                    >
                <option value=''>Select</option>
            </select>
		</div>

		<div>
			Catégorie de la station finale:
            <select name="final_station_id"
                    id="final_station-id" 
                    ng-model="stationTypeFinal" 
                    ng-options="stationTypeFinal.type for stationTypeFinal in stationTypesFinal track by stationTypeFinal.id"
                    >
                <option value=''>Select</option>
            </select>
        </div>
        <div>
            Station: 
            <select name="final_station"
                    id="final_station" 
                    ng-disabled="!stationTypeFinal" 
                    ng-model="stationFinal"
                    ng-options="stationFinal.name for stationFinal in stationTypeFinal.stations track by stationFinal.id"
                    >
                <option value=''>Select</option>
            </select>
        </div>


		<?php
		
		//sql($stationTypes);
		//debug($stations);
			

			//echo $this->Form->control('Category_station_origin', ['options' => $categories, 'label' => 'Catégorie de la station d\'origine']);
			//echo $this->Form->control('origin_station', ['options' => $subcategories]);
			echo "</br>";
			//echo $this->Form->control('Category_station_final', ['options' => $station_types, 'label' => 'Catégorie de la station finale']);
			//echo $this->Form->control('final_station', ['options' => $stations]);
			//echo $this->Form->control('Category_id', ['options' => $station_types]);
			//echo $this->Form->control('final_station', ['options' => $stations]);
			echo "</br>";
            echo $this->Form->control('private');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>