<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fornecedore $fornecedore
 */
?>

<style>
  .btn {
    background-color: green;
    color: white;
    border: 1px solid green;
  }

  .btn:hover {
    background-color: white;
    color: green;
    border: 1px solid green;
  }

  .btn:focus {
    background-color: green;
    color: white;
    border: 1px solid green;
  }

  @media (max-width: 620px) {
    .card {
      position: absolute;
      margin-left: -77px;
      min-width: 90%;
    }

  }
</style>


<?php $this->assign('title', __('Adicionar Fornecedor')); ?>


<div class="container d-flex justify-content-center">

  <div class="card card-danger m-5" style="border-radius: 20px; width: 80%">
    <div class="card-body bg-info" style="border-radius: 20px 20px 0px 0px ;">
      <?= $this->Form->create($fornecedore) ?>

      <?= $this->Form->control('nome', ['label' => 'Nome'], ['class' => 'form-control']); ?>
      <?= $this->Form->control('cnpj', ['label' => 'CNPJ'], ['class' => 'form-control']); ?>
      <?= $this->Form->control('responsavel', ['label' => 'Responsável'], ['class' => 'form-control']); ?>
      <?= $this->Form->control('endereco', ['label' => 'Endereço'], ['class' => 'form-control']); ?>
      <?= $this->Form->control('email', ['label' => 'E-mail'], ['class' => 'form-control']); ?>
      <?= $this->Form->control('telefone', ['label' => 'Telefone'], ['class' => 'form-control']); ?>
      <?= $this->Form->control('is_pendente', ['label' => 'Pendente?'], ['custom' => true], ['class' => 'form-control']); ?>

    </div>

    <div class="card-footer bg-white d-flex" style="border-radius: 0px 0px 20px 20px;">
      <div class="mr-auto p-2">
        <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
      </div>
      <div class="p-2">
        <?= $this->Form->button(__('Salvar')) ?>
      </div>
    </div>
    <?= $this->Form->end() ?>
  </div>
</div>
