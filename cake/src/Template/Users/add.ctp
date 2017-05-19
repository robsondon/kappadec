<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Profiles'), ['controller' => 'Profiles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Profile'), ['controller' => 'Profiles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo $this->Form->control('email');
            echo $this->Form->control('role');
        ?>
        <h3>Perfil</h3>
        <?php
        echo $this->Form->control('profiles.0.name');
        echo $this->Form->control('profiles.0.born', ['empty' => true]);
        echo $this->Form->control('profiles.0.sex');
        echo $this->Form->control('profiles.0.cpf');
        echo $this->Form->control('profiles.0.phone');
        echo $this->Form->control('profiles.0.city');
        echo $this->Form->control('profiles.0.estate');
        echo $this->Form->control('profiles.0.country');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
