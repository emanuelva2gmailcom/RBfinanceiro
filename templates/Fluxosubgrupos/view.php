<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fluxosubgrupo $fluxosubgrupo
 */
?>

<div class="container-fluid d-flex align-items-center justify-content-center views">

  <div class="cardVIEW card card-outline container bg-white ">

    <div class="cardheaderVIEW card-header d-sm-flex">
      <h2 class="cardtitleVIEW card-title"><?= h($fluxosubgrupo->subgrupo) ?></h2>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table tboINDEX theINDEX table-hover text-nowrap">
        <tr>
          <th><?= __('Subgrupo') ?></th>
          <td><?= h($fluxosubgrupo->subgrupo) ?></td>
        </tr>
        <tr>
          <th><?= __('Descrição') ?></th>
          <td><?= h($fluxosubgrupo->descricao) ?></td>
        </tr>
        <tr>
          <th><?= __('Grupo') ?></th>
          <td class="tdINDEX"><?= $fluxosubgrupo->has('fluxogrupo') ? $this->Html->link($fluxosubgrupo->fluxogrupo->grupo, ['controller' => 'Fluxogrupos', 'action' => 'view', $fluxosubgrupo->fluxogrupo->grupo]) : '' ?></td>
        </tr>
        <tr>
          <th><?= __('N° do Subgrupo') ?></th>
          <td><?= $this->Number->format($fluxosubgrupo->id_fluxosubgrupo) ?></td>
        </tr>
        <tr>
          <th><?= __('Criado') ?></th>
          <td><?= h($fluxosubgrupo->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
        <tr>
          <th><?= __('Modificado') ?></th>
          <td><?= h($fluxosubgrupo->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
      </table>
    </div>
    <div class="cardfooterVIEW card-footer bg-white">

      <div class="cardfooterVIEW2 d-flex bd-highlight mb-3">
        <?= $this->Form->postLink(
          __('Deletar'),
          ['action' => 'delete',  $fluxosubgrupo->id_fluxosubgrupo],
          ['confirm' => __('Você quer mesmo deletar {0}?',  $fluxosubgrupo->subgrupo), 'class' => 'del btn btn-sm btn-outline-danger mr-auto p-2 bd-highlight']
        ) ?>

        <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $fluxosubgrupo->id_fluxosubgrupo], ['class' => 'edi btn btn-sm btn-outline-success p-2 bd-highlight']) ?>
        <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn vis btn-sm btn-outline-info p-2 bd-highlight']) ?>
      </div>
    </div>
  </div>
</div>



<div class="container-fluid d-flex align-items-center justify-content-center views">

  <div class="relacionadosVIEW related related-caixaregistros view card container bg-white">

    <div class="relacionadosVIEW2 card-header d-sm-flex">
      <h3 class="cardtitleVIEW card-title"><?= __('Relacionados') ?></h3>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table theINDEX tboINDEX table-hover text-nowrap">
        <tr>
          <th><?= __('N° da Conta') ?></th>
          <th><?= __('Conta') ?></th>
          <th><?= __('Descrição') ?></th>
          <th><?= __('Criado') ?></th>
          <th><?= __('Modificado') ?></th>
          <th><?= __('Subgrupo') ?></th>
          <th class="actions"><?= __('Ações') ?></th>
        </tr>
        <?php if (empty($fluxosubgrupo->fluxocontas)) { ?>
          <tr>
            <td colspan="7">
              Não Encontrado!
            </td>
          </tr>
        <?php } else { ?>
          <?php foreach ($fluxosubgrupo->fluxocontas as $fluxocontas) : ?>
            <tr>
              <td><?= h($fluxocontas->id_fluxoconta) ?></td>
              <td><?= h($fluxocontas->conta) ?></td>
              <td><?= h($fluxocontas->descricao) ?></td>
              <td><?= h($fluxocontas->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
              <td><?= h($fluxocontas->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
              <td><?= h($fluxocontas->fluxosubgrupo_id) ?></td>
              <td class="actions">
                <?= $this->Html->link(__('Visualizar'), ['controller' => 'Fluxocontas', 'action' => 'view', $fluxocontas->id_fluxoconta], ['class' => 'btn vis btn-xs btn-outline-info']) ?>
                <?= $this->Html->link(__('Editar'), ['controller' => 'Fluxocontas', 'action' => 'edit', $fluxocontas->id_fluxoconta], ['class' => 'btn edi btn-xs btn-outline-success']) ?>
                <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Fluxocontas', 'action' => 'delete', $fluxocontas->id_fluxoconta], ['class' => 'btn del btn-xs btn-outline-danger', 'confirm' => __('Você quer mesmo deletar {0}?', $fluxocontas->conta)]) ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php } ?>
      </table>
    </div>
  </div>
</div>
