<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Conta $conta
 */
?>

<div class="container-fluid d-flex align-items-center justify-content-center views">

  <div class="cardVIEW card card-outline container bg-white ">

    <div class="cardheaderVIEW card-header d-sm-flex">
      <h2 class="card-title"><?= h($conta->id_conta) ?></h2>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table theINDEX tboINDEX table-hover text-nowrap">
        <tr>
            <th><?= __('Conta') ?></th>
            <td><?= h($conta->conta) ?></td>
        </tr>
        <tr>
            <th><?= __('Descrição') ?></th>
            <td><?= h($conta->descricao) ?></td>
        </tr>
        <tr>
            <th><?= __('Subgrupo') ?></th>
            <td class="tdINDEX"><?= $conta->has('subgrupo') ? $this->Html->link($conta->subgrupo->id_subgrupo, ['controller' => 'Subgrupos', 'action' => 'view', $conta->subgrupo->id_subgrupo]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Nº da Conta') ?></th>
            <td><?= $this->Number->format($conta->id_conta) ?></td>
        </tr>
        <tr>
            <th><?= __('Criado') ?></th>
            <td><?= h($conta->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modificado') ?></th>
            <td><?= h($conta->modified) ?></td>
        </tr>
    </table>
  </div>
  <div class="cardfooterVIEW card-footer bg-white">
      <div class="cardfooterVIEW2 d-flex bd-highlight mb-3">
        <?= $this->Form->postLink(
          __('Deletar'),
          ['action' => 'delete',  $conta->id_conta],
          ['confirm' => __('você quer mesmo deletar a conta {0}?',  $conta->conta), 'class' => 'del btn btn-sm btn-outline-danger mr-auto p-2 bd-highlight']
        ) ?>
        <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $conta->id_conta], ['class' => 'edi btn btn-sm btn-outline-success p-2 bd-highlight']) ?>
        <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn vis btn-sm btn-outline-info p-2 bd-highlight']) ?>
      </div>
    </div>
  </div>
</div>


<div class="container-fluid d-flex align-items-center justify-content-center views">

  <div class="relacionadosVIEW related related-caixaregistros view card container bg-white">

    <div class="relacionadosheaderVIEW card-header d-sm-flex">
      <h3 class="cardtitleVIEW card-title"><?= __('Relacionados') ?></h3>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table theINDEX tboINDEX table-hover text-nowrap">
      <tr>
      <th><?= __('Nº da Subconta') ?></th>
              <th><?= __('Subconta') ?></th>
              <th><?= __('Descrição') ?></th>
              <th><?= __('Criado') ?></th>
              <th><?= __('Modificado') ?></th>
              <th><?= __('Conta') ?></th>
              <th><?= __('Ações') ?></th>
      </tr>
      <?php if (empty($conta->subcontas)) { ?>
        <tr>
            <td colspan="7">
              Não encontrado!
            </td>
        </tr>
      <?php }else{ ?>
        <?php foreach ($conta->subcontas as $subcontas) : ?>
        <tr>
            <td><?= h($subcontas->id_subconta) ?></td>
            <td><?= h($subcontas->subconta) ?></td>
            <td><?= h($subcontas->descricao) ?></td>
            <td><?= h($subcontas->created) ?></td>
            <td><?= h($subcontas->modified) ?></td>
            <td><?= h($subcontas->conta_id) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('Visualizar'), ['controller' => 'subcontas', 'action' => 'view', $subcontas->id_subconta], ['class' => 'btn vis btn-xs btn-outline-info']) ?>
                <?= $this->Html->link(__('Editar'), ['controller' => 'Lancamentos', 'action' => 'edit', $subcontas->id_subconta], ['class' => 'btn edi btn-xs btn-outline-success']) ?>
                <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Lancamentos', 'action' => 'delete', $subcontas->id_subconta], ['class' => 'btn del btn-xs btn-outline-danger', 'confirm' => __('Você quer mesmo deletar {0}?', $subcontas->id_subconta)]) ?>
              </td>
        </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>
</div>
</div>

