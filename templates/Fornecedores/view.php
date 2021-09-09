<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fornecedore $fornecedore
 */
?>

<?php
$this->assign('title', __('Fornecedore') );

$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Fornecedores' => ['action'=>'index'],
      'View',
    ]
  ])
);
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($fornecedore->id_fornecedor) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Nome') ?></th>
            <td><?= h($fornecedore->nome) ?></td>
        </tr>
        <tr>
            <th><?= __('Cnpj') ?></th>
            <td><?= h($fornecedore->cnpj) ?></td>
        </tr>
        <tr>
            <th><?= __('Responsavel') ?></th>
            <td><?= h($fornecedore->responsavel) ?></td>
        </tr>
        <tr>
            <th><?= __('Endereco') ?></th>
            <td><?= h($fornecedore->endereco) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($fornecedore->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Telefone') ?></th>
            <td><?= h($fornecedore->telefone) ?></td>
        </tr>
        <tr>
            <th><?= __('Id Fornecedor') ?></th>
            <td><?= $this->Number->format($fornecedore->id_fornecedor) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($fornecedore->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($fornecedore->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Is Pendente') ?></th>
            <td><?= $fornecedore->is_pendente ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete',  $fornecedore->id_fornecedor],
          ['confirm' => __('Are you sure you want to delete # {0}?',  $fornecedore->id_fornecedor), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Edit'), ['action' => 'edit',  $fornecedore->id_fornecedor], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancel'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>
</div>


