<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lancamento $lancamento
 */
?>

<?php $this->assign('title', __('Editar Lançamento')); ?>

<div class="container d-flex justify-content-center">

  <div class="cardADD card card-danger m-5">
    <div class="cardbodyADD card-body">
    <?= $this->Form->create($renovado) ?>

        <?= $this->Form->control('valor', ['label' => 'Valor', 'value' => $lancamento->valor], ['class' => 'form-control']); ?>
        <?= $this->Form->control('descricao', ['label' => 'Descrição', 'value' => $lancamento->descricao], ['class' => 'form-control']); ?>
        <?= $this->Form->control('data_vencimento', ['label' => 'Data de Vencimento', 'value' => $lancamento->data_vencimento->i18nFormat('dd-MM-yyyy')], ['class' => 'form-control']); ?>

    </div>

    <div class="cardfooterADD card-footer d-flex">
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
