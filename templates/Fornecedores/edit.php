<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fornecedore $fornecedore
 */
?>

<?php $this->assign('title', __('Edit Fornecedore') ); ?>

<?php
$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Fornecedores' => ['action'=>'index'],
      'View' => ['action'=>'view', $fornecedore->id_fornecedor],
      'Edit',
    ]
  ])
);
?>


<div class="card card-primary card-outline">
  <?= $this->Form->create($fornecedore) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('nome');
      echo $this->Form->control('cnpj');
      echo $this->Form->control('responsavel');
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
          ['action' => 'delete', $fornecedore->id_fornecedor],
          ['confirm' => __('Are you sure you want to delete # {0}?', $fornecedore->id_fornecedor), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>
