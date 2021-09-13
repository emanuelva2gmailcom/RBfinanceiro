<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Caixaregistro $caixaregistro
 */
?>

<?php
$this->assign('title', __('Caixa Registro') );
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($caixaregistro->id_caixaregistro) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Caixa') ?></th>
            <td><?= $caixaregistro->has('caixa') ? $this->Html->link($caixaregistro->caixa->id_caixa, ['controller' => 'Caixas', 'action' => 'view', $caixaregistro->caixa->id_caixa]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Tipopagamento') ?></th>
            <td><?= $caixaregistro->has('tipopagamento') ? $this->Html->link($caixaregistro->tipopagamento->nome, ['controller' => 'Tipopagamentos', 'action' => 'view', $caixaregistro->tipopagamento->nome]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Lancamento') ?></th>
            <td><?= $caixaregistro->has('lancamento') ? $this->Html->link($caixaregistro->lancamento->id_lancamento, ['controller' => 'Lancamentos', 'action' => 'view', $caixaregistro->lancamento->id_lancamento]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id Caixaregistro') ?></th>
            <td><?= $this->Number->format($caixaregistro->id_caixaregistro) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Deletar'),
          ['action' => 'delete',  $caixaregistro->id_caixaregistro],
          ['confirm' => __('Você quer mesmo deletar?',  $caixaregistro->id_caixaregistro), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $caixaregistro->id_caixaregistro], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancelar'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>
</div>


