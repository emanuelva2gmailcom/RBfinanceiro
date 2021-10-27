<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fornecedore $fornecedore
 */
?>

<?php
$this->assign('title', __('Fornecedor') );
?>

<style>

.del{
        margin-right: 78%;
    }

    .edi{
        margin-right: 2%;
    }

</style>

<div  class="container-fluid d-flex align-items-center justify-content-center p-5">

 <div style="border: green solid 2px; border-radius: 20px;" class="card card-outline container bg-white ">

  <div class="card-header d-sm-flex" style="padding-top: 50px; color: green;">
    <h2 class="card-title"><?= h($fornecedore->nome) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th style="color: green;"><?= __('Nome') ?></th>
            <td class="text-info"><?= h($fornecedore->nome) ?></td>
        </tr>
        <tr>
            <th style="color: green;"><?= __('Cnpj') ?></th>
            <td class="text-info"><?= h($fornecedore->cnpj) ?></td>
        </tr>
        <tr>
            <th style="color: green;"><?= __('Responsavel') ?></th>
            <td class="text-info"><?= h($fornecedore->responsavel) ?></td>
        </tr>
        <tr>
            <th style="color: green;"><?= __('Endereco') ?></th>
            <td class="text-info"><?= h($fornecedore->endereco) ?></td>
        </tr>
        <tr>
            <th style="color: green;"><?= __('Email') ?></th>
            <td class="text-info"><?= h($fornecedore->email) ?></td>
        </tr>
        <tr>
            <th style="color: green;"><?= __('Telefone') ?></th>
            <td class="text-info"><?= h($fornecedore->telefone) ?></td>
        </tr>
        <tr>
            <th style="color: green;"><?= __('Id Fornecedor') ?></th>
            <td class="text-info"><?= $this->Number->format($fornecedore->id_fornecedor) ?></td>
        </tr>
        <tr>
            <th style="color: green;"><?= __('Created') ?></th>
            <td class="text-info"><?= h($fornecedore->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
        <tr>
            <th style="color: green;"><?= __('Modified') ?></th>
            <td class="text-info"><?= h($fornecedore->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
        <tr>
            <th style="color: green;"><?= __('Is Pendente') ?></th>
            <td class="text-info"><?= $fornecedore->is_pendente ? __('Sim') : __('Não'); ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer bg-white" style="border-radius: 20px;">
    <div style="padding-top: 20px;" class="d-flex justify-content-end">
      <?= $this->Form->postLink(
          __('Deletar'),
          ['action' => 'delete',  $fornecedore->id_fornecedor],
          ['confirm' => __('Você quer mesmo deletar o fornecedor {0}?',  $fornecedore->nome), 'class' => 'del btn btn-sm btn-outline-danger']
      ) ?>
      <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $fornecedore->id_fornecedor], ['class' => 'edi btn btn-sm btn-outline-success']) ?>
      <?= $this->Html->link(__('Cancelar'), ['action'=>'index'], ['class'=>'btn btn-sm btn-outline-info']) ?>
    </div>
  </div>
</div>
</div>


