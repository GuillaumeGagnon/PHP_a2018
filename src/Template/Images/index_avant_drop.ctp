<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Image[]|\Cake\Collection\CollectionInterface $images
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
      <li></li>
      <li><?= $this->Html->link(__('New Image'), ['action' => 'add']) ?></li>
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



?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Image'), ['action' => 'add']) ?></li>
    </ul>
</nav>


<div class="images index large-9 medium-8 columns content">
    <h3><?= __('Images') ?></h3>
    <table class="table">
        <tr>
            <th width="5%">#</th>
            <th width="20%">Fichier</th>
            <th width="20%">Emplacement</th>
			<th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php if($fichiersRangerNumero > 0):$count = 0; foreach($images as $image): $count++;?>
        <tr>
        <?php 
        //debug($image);
        
        
        ?>
            <td><?php echo $count; ?></td>
            <td><img src="/PHP/webroot/img/<?= $image->emplacement ?>" /></td>
            <td><?php echo $image->emplacement; ?></td>
			<td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $image->id]) ?>
                    <?php echo""; /*$this->Html->link(__('Edit'), ['action' => 'edit', $image->id])*/ ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $image->id], ['confirm' => __('Are you sure you want to delete # {0}?', $image->id)]) ?>
                </td>
        </tr>
        <?php endforeach; else:?>
        <tr><td colspan="3">No file(s) found......</td>
        <?php endif; ?>
    </table>
</div>
