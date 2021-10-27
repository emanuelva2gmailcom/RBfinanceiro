<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lancamento $lancamento
 */
?>

<style>

    .btn{

        background-color: green;

        color: white;

        border: 1px solid green;

    }

    .btn:hover{

        background-color: white;

        color: green;

        border: 1px solid green;

    }

    .btn:focus{

        background-color: green;

        color: white;

        border: 1px solid green;

    }

</style>

<?php $this->assign('title', __('Editar Lançamento')); ?>




<div class="container d-flex justify-content-center">

<div class="card card-danger m-5" style="border-radius: 20px; width: 80%">
    <div class="card-body bg-info" style="border-radius: 20px 20px 0px 0px ;">
  <?= $this->Form->create($lancamento) ?>

   <?= $this->Form->label('Tipo'); ?>
   <?= $this->Form->select('tipo', ['PREVISTO' => 'PREVISTO', 'REALIZADO' => 'REALIZADO'], ['class' => 'form-control']); ?>
   <?= $this->Form->control('descricao', ['label' => 'Descrição'], ['class' => 'form-control']); ?>
   <?= $this->Form->control('valor', ['label' => 'Valor'], ['class' => 'form-control']); ?>
   <?= $this->Form->control('data_emissao', ['label' => 'Data de Emissão'], ['class' => 'form-control']); ?>
   <?= $this->Form->control('data_baixa', ['label' => 'Data de Baixa'], ['class' => 'form-control']); ?>
   <?= $this->Form->control('data_vencimento', ['label' => 'Data de Vencimento'], ['class' => 'form-control']); ?>
   <?= $this->Form->control('fluxoconta_id', ['label' => 'Conta'], ['options' => $fluxocontas, 'empty' => true], ['class' => 'form-control']); ?>
   <?= $this->Form->control('fornecedor_id', ['label' => 'Fornecedor'], ['options' => $fornecedores, 'empty' => true], ['class' => 'form-control']); ?>
   <?= $this->Form->control('cliente_id', ['label' => 'Cliente'], ['options' => $clientes, 'empty' => true], ['class' => 'form-control']); ?>
   <?= $this->Form->control('lancamento_id', ['label' => 'Lançamento'], ['options' => $lancamentos, 'empty' => true], ['class' => 'form-control']); ?>

   <!-- <?= $this->Form->control('dreconta_id', ['options' => $drecontas, 'empty' => true], ['class' => 'form-control']); ?> -->

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
