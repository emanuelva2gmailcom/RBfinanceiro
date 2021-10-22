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
   <?= $this->Form->control('descricao', ['class' => 'form-control']); ?>
   <?= $this->Form->control('valor', ['class' => 'form-control']); ?>
   <?= $this->Form->control('data_emissao', ['class' => 'form-control']); ?>
   <?= $this->Form->control('data_baixa', ['class' => 'form-control']); ?>
   <?= $this->Form->control('data_vencimento', ['class' => 'form-control']); ?>
   <?= $this->Form->control('fluxoconta_id', ['options' => $fluxocontas, 'empty' => true], ['class' => 'form-control']); ?>
   <?= $this->Form->control('fornecedor_id', ['options' => $fornecedores, 'empty' => true], ['class' => 'form-control']); ?>
   <?= $this->Form->control('cliente_id', ['options' => $clientes, 'empty' => true], ['class' => 'form-control']); ?>
   <?= $this->Form->control('lancamento_id', ['options' => $lancamentos, 'empty' => true], ['class' => 'form-control']); ?>
   <?= $this->Form->control('dreconta_id', ['options' => $drecontas, 'empty' => true], ['class' => 'form-control']); ?>

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
