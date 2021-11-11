<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fornecedore $fornecedore
 */
?>

<?php $this->assign('title', __('Adicionar Fornecedor')); ?>


<div class="container d-flex justify-content-center">

<div class="cardADD card card-danger m-5">
    <div class="cardbodyADD card-body">
    <?= $this->Form->create($fornecedore) ?>

      <?= $this->Form->control('nome', ['label' => 'Nome'], ['class' => 'form-control']); ?>
      <?= $this->Form->control('cnpj', ['label' => 'CNPJ'], ['class' => 'form-control']); ?>
      <?= $this->Form->control('responsavel', ['label' => 'Responsável'], ['class' => 'form-control']); ?>
      <?= $this->Form->control('endereco', ['label' => 'Endereço'], ['class' => 'form-control']); ?>
      <?= $this->Form->control('email', ['label' => 'E-mail'], ['class' => 'form-control']); ?>
      <?= $this->Form->control('telefone', ['label' => 'Telefone'], ['class' => 'form-control']); ?>
      <?= $this->Form->control('is_pendente', ['label' => 'Pendente?'], ['custom' => true], ['class' => 'form-control']); ?>

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
