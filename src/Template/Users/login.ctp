<?php 
    //echo $this->Html->script('https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit');
    echo $this->Html->script('https://www.google.com/recaptcha/api.js');
?>
<div ng-app="app">
    <div ng-controller="UsersController">
        <h1>Login</h1>
        <!--<div id="capcha"></div> -->
        

        <!--<p style="color:red;">{{ captcha_status }}</p>-->
        <?= $this->Form->create() ?>
        <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
        <?= $this->Form->control('email') ?>
        <?= $this->Form->control('password') ?>
        <?= $this->Form->button('Connexion') ?>
        <?= $this->Form->end() ?>
    </div>
</div>
