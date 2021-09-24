<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Notification $notification
 */
?>

<?php $this->assign('title', __('Adicionar Notificação') ); ?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($notification) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('title');
      echo $this->Form->control('message');
      echo $this->Form->control('data');
      echo $this->Form->control('class');
      echo $this->Form->control('modify');
      echo $this->Form->control('lancamento_id', ['options' => $lancamentos, 'empty' => true]);
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="ml-auto">
      <?= $this->Form->button(__('Salvar')) ?>
      <?= $this->Html->link(__('Cancelar'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>
