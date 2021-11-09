<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fluxoconta $fluxoconta
 */
?>

<?php
$this->assign('title', __('Fluxoconta'));
?>

<div class="container-fluid d-flex align-items-center justify-content-center views">

  <div class="carVIEW card card-outline container bg-white ">

    <div class="carhVIEW card-header d-sm-flex">
      <h2 class="card-title"><?= h($fluxoconta->conta) ?></h2>
    </div>
    <div class="card-body table-responsive p-0">

      <table class="table theINDEX tboINDEX text-nowrap">
        <tr>
          <th><?= __('Conta') ?></th>
          <td><?= h($fluxoconta->conta) ?></td>
        </tr>
        <tr>
          <th><?= __('Descrição') ?></th>
          <td><?= h($fluxoconta->descricao) ?></td>
        </tr>
        <tr>
          <th><?= __('Subgrupo') ?></th>
          <td class="tdINDEX"><?= $fluxoconta->has('fluxosubgrupo') ? $this->Html->link($fluxoconta->fluxosubgrupo->subgrupo, ['controller' => 'Fluxosubgrupos', 'action' => 'view', $fluxoconta->fluxosubgrupo->subgrupo]) : '' ?></td>
        </tr>
        <tr>
          <th><?= __('N° da Conta') ?></th>
          <td><?= $this->Number->format($fluxoconta->id_fluxoconta) ?></td>
        </tr>
        <tr>
          <th><?= __('Criado') ?></th>
          <td><?= h($fluxoconta->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
        <tr>
          <th><?= __('Modificado') ?></th>
          <td><?= h($fluxoconta->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>

      </table>
    </div>
    <div class="carfVIEW card-footer bg-white">
      <div class="carfVIEW2 d-flex mr-auto justify-content-around">
        <?= $this->Form->postLink(

          __('Deletar'),
          ['action' => 'delete',  $fluxoconta->id_fluxoconta],
          ['confirm' => __('Vocề quer mesmo deletar {0}?',  $fluxoconta->conta), 'class' => 'del btn btn-sm btn-outline-danger mr-auto p-2 bd-highlight']
        ) ?>
        <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $fluxoconta->id_fluxoconta], ['class' => 'edi btn btn-sm btn-outline-success p-2 bd-highlight']) ?>
        <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn vis btn-sm btn-outline-info p-2 bd-highlight']) ?>

      </div>
    </div>
  </div>
</div>


<div class="container-fluid d-flex align-items-center justify-content-center views">

  <div class="relVIEW related related-caixaregistros view card container bg-white">

    <div class="relhVIEW card-header d-sm-flex">
      <h3 class="carttVIEW card-title"><?= __('Relacionados') ?></h3>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table theINDEX tboINDEX table-hover text-nowrap">

        <tr>

          <th><?= __('N° do Lançamento') ?></th>
          <th><?= __('Tipo') ?></th>
          <th><?= __('Descrição') ?></th>
          <th><?= __('Valor') ?></th>
          <th><?= __('Data de Emissão') ?></th>
          <th><?= __('Data de Baixa') ?></th>
          <th><?= __('Data de Vencimento') ?></th>
          <th><?= __('Criado') ?></th>
          <th><?= __('Modificado') ?></th>
          <th><?= __('Conta') ?></th>
          <th><?= __('Fornecedor') ?></th>
          <th><?= __('Cliente') ?></th>
          <th><?= __('Lançamento') ?></th>
          <!-- <th><?= __('Dreconta Id') ?></th> -->
          <th class="actions"><?= __('Ações') ?></th>
        </tr>
        <?php if (empty($lancamento->lancamentos)) { ?>
          <tr>

            <td colspan="15">

              Não Encontrado!
            </td>
          </tr>
        <?php } else { ?>
          <?php foreach ($lancamento->lancamentos as $lancamentos) : ?>
            <tr>
              <td><?= h($lancamentos->id_lancamento) ?></td>
              <td><?= h($lancamentos->tipo) ?></td>
              <td><?= h($lancamentos->descricao) ?></td>
              <td><?= h($lancamentos->valor) ?></td>
              <td><?= h($lancamentos->data_emissao->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
              <?php if (empty($lancamento->data_baixa)) { ?>
                <td><?= h($lancamento->data_baixa) ?></td>
              <?php } else { ?>
                <td><?= h($lancamento->data_baixa->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
              <?php } ?>
              <td><?= h($lancamentos->data_vencimento->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
              <td><?= h($lancamentos->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
              <td><?= h($lancamentos->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
              <td><?= h($lancamentos->fluxoconta_id) ?></td>
              <td><?= h($lancamentos->fornecedor_id) ?></td>
              <td><?= h($lancamentos->cliente_id) ?></td>
              <td><?= h($lancamentos->lancamento_id) ?></td>
              <td><?= h($lancamentos->dreconta_id) ?></td>
              <td class="actions">
                <?= $this->Html->link(__('Visualizar'), ['controller' => 'Lancamentos', 'action' => 'view', $lancamentos->id_lancamento], ['class' => 'btn vis btn-xs btn-outline-info']) ?>
                <?= $this->Html->link(__('Editar'), ['controller' => 'Lancamentos', 'action' => 'edit', $lancamentos->id_lancamento], ['class' => 'btn  edi btn-xs btn-outline-success']) ?>

                <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Lancamentos', 'action' => 'delete', $lancamentos->id_lancamento], ['class' => 'btn del btn-xs btn-outline-danger', 'confirm' => __('Você quer mesmo deletar {0}?', $lancamentos->id_lancamento)]) ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php } ?>
      </table>
    </div>
  </div>
</div>
