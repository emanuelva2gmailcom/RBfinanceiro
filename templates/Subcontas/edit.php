<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subconta $subconta
 */
?>

<?php $this->assign('title', __('Edit Subconta') ); ?>

<div class="container d-flex justify-content-center">

  <div class="cardADD card card-danger m-5">
    <div class="cardbodyADD card-body">
  <?= $this->Form->create($subconta) ?>

     <?= $this->Form->control('subconta', ['label' => 'Subconta'], ['class' => 'form-control']); ?>
     <?= $this->Form->control('descricao', ['label' => 'Descrição'], ['class' => 'form-control']); ?>
     <?= $this->Form->control('conta_id', ['label' => 'Conta'], ['class' => 'form-control'], ['options' => $contas, 'empty' => true]); ?>

  </div>

  <div class="cardfooterADD card-footer d-flex">
      <div class="mr-auto p-2">
        <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btnADD btn btn-default']) ?>
      </div>
      <div class="p-2">
        <?= $this->Form->button(__('Salvar')) ?>
      </div>
    </div>

    <?= $this->Form->end() ?>
  </div>
</div>
