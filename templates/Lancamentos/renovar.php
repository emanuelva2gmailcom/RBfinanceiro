<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lancamento $lancamento
 */
?>

<?php $this->assign('title', __('Editar Lançamento')); ?>




<div class="card card-primary card-outline">
    <?= $this->Form->create($lancamento) ?>
    <div class="card-body">
        <?php
        echo $this->Form->control('valor');
        echo $this->Form->control('descricao');
        echo $this->Form->control('data_vencimento');
        ?>
    </div>

    <div class="card-footer d-flex">
        <div class="ml-auto">
            <?= $this->Form->button(__('Salvar')) ?>
            <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?= $this->Form->end() ?>
</div>