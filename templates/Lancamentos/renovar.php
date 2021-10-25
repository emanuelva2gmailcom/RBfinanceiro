<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lancamento $lancamento
 */
?>

<?php $this->assign('title', __('Editar Lançamento')); ?>

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


<div class="container d-flex justify-content-center">

<div class="card card-danger m-5" style="border-radius: 20px; width: 80%">
    <div class="card-body bg-info" style="border-radius: 20px 20px 0px 0px ;">
    <?= $this->Form->create($lancamento) ?>

        <?= $this->Form->control('valor', ['class' => 'form-control']); ?>
        <?= $this->Form->control('descricao', ['class' => 'form-control']); ?>
        <?= $this->Form->control('data_vencimento', ['class' => 'form-control']);?>

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
