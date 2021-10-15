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




<div class="container p-5" style="width: 60%;min-width:80%;border-radius: 20px;">

<div class="card bg-info" style="border-radius: 20px;">
  <?= $this->Form->create($lancamento) ?>
  <div class="card-body text-white">
    <?php
    echo $this->Form->label('Tipo');
    echo $this->Form->select('tipo', ['PREVISTO' => 'PREVISTO', 'REALIZADO' => 'REALIZADO'], ['class' => 'form-control']);
    echo $this->Form->control('descricao');
    echo $this->Form->control('valor');
    echo $this->Form->control('data_emissao');
    echo $this->Form->control('data_baixa');
    echo $this->Form->control('data_vencimento');
    echo $this->Form->control('fluxoconta_id', ['options' => $fluxocontas, 'empty' => true]);
    echo $this->Form->control('fornecedor_id', ['options' => $fornecedores, 'empty' => true]);
    echo $this->Form->control('cliente_id', ['options' => $clientes, 'empty' => true]);
    echo $this->Form->control('lancamento_id', ['options' => $lancamentos, 'empty' => true]);
    echo $this->Form->control('dreconta_id', ['options' => $drecontas, 'empty' => true]);
    ?>
  </div>

  <div class="card-footer bg-white d-flex"  style="border-radius: 0px 0px 20px 20px;">

<div class="mr-auto p-2">

    <?= $this->Html->link(__('Cancelar'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>

</div>

<div class="p-2" >

    <?= $this->Form->button(__('Salvar')) ?>

</div>

</div>

  <?= $this->Form->end() ?>
</div>
