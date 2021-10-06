<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Comprovante $comprovante
 */
?>

<?php
$this->assign('title', __('Comprovante') );?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($comprovante->nome_arquivo) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Nome Arquivo') ?></th>
            <td><?= h($comprovante->nome_arquivo) ?></td>
        </tr>
        <tr>
            <th><?= __('Tipo') ?></th>
            <td><?= h($comprovante->tipo) ?></td>
        </tr>
        <tr>
            <th><?= __('Lancamento') ?></th>
            <td><?= $comprovante->has('lancamento') ? $this->Html->link($comprovante->lancamento->tipo, ['controller' => 'Lancamentos', 'action' => 'view', $comprovante->lancamento->id_lancamento]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Img') ?></th>
            <td><?= h($comprovante->img) ?></td>
        </tr>
        <tr>
            <th><?= __('Id Comprovante') ?></th>
            <td><?= $this->Number->format($comprovante->id_comprovante) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($comprovante->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($comprovante->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Deletar'),
          ['action' => 'delete',  $comprovante->id_comprovante],
          ['confirm' => __('Você quer mesmo deletar {0}?',  $comprovante->nome_arquivo), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $comprovante->id_comprovante], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancelar'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>
</div>


