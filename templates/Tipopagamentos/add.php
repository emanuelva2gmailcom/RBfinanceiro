<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tipopagamento $tipopagamento
 */
?>

<?php $this->assign('title', __('Adicionar Tipo de Pagamento')); ?>

<div class="container d-flex justify-content-center">

  <div class="carADD card card-danger m-5">
    <div class="carbADD card-body bg-info">
      <?= $this->Form->create($tipopagamento) ?>
      <?= $this->Form->control('nome', ['label' => 'Nome'], ['class' => 'form-control']); ?>
      <?= $this->Form->control('descricao', ['label' => 'Descrição'], ['class' => 'form-control']); ?>

    </div>

    <div class="carfADD card-footer bg-white d-flex">
      <div class="mr-auto p-2">
        <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btnADD btn-default']) ?>
      </div>
      <div class="p-2">
        <?= $this->Form->button(__('Salvar')) ?>
      </div>
    </div>
    <?= $this->Form->end() ?>
  </div>
</div>
