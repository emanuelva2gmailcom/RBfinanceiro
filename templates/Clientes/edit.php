<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cliente $cliente
 */
?>

<?php $this->assign('title', __('Edit Cliente') ); ?>

<?php
$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Clientes' => ['action'=>'index'],
      'View' => ['action'=>'view', $cliente->id_cliente],
      'Edit',
    ]
  ])
);
?>


<div class="card card-primary card-outline">
  <?= $this->Form->create($cliente) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('nome');
      echo $this->Form->control('cpf');
      echo $this->Form->control('endereco');
      echo $this->Form->control('email');
      echo $this->Form->control('telefone');
      echo $this->Form->control('is_pendente', ['custom' => true]);
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $cliente->id_cliente],
          ['confirm' => __('Are you sure you want to delete # {0}?', $cliente->id_cliente), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>
