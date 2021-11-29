<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subconta $subconta
 */
?>

<div class="container-fluid d-flex align-items-center justify-content-center views">

  <div class="cardVIEW card card-outline container bg-white ">

    <div class="cardheaderVIEW card-header d-sm-flex">
      <h2 class="card-title"><?= h($subconta->id_subconta) ?></h2>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table theINDEX tboINDEX table-hover text-nowrap">
        <tr>
            <th><?= __('Subconta') ?></th>
            <td><?= h($subconta->subconta) ?></td>
        </tr>
        <tr>
            <th><?= __('Descrição') ?></th>
            <td><?= h($subconta->descricao) ?></td>
        </tr>
        <tr>
            <th><?= __('Conta') ?></th>
            <td class="tdINDEX"><?= $subconta->has('conta') ? $this->Html->link($subconta->conta->id_conta, ['controller' => 'Contas', 'action' => 'view', $subconta->conta->id_conta]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Nº da Subconta') ?></th>
            <td><?= $this->Number->format($subconta->id_subconta) ?></td>
        </tr>
        <tr>
            <th><?= __('Criado') ?></th>
            <td><?= h($subconta->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modificado') ?></th>
            <td><?= h($subconta->modified) ?></td>
        </tr>
    </table>
  </div>
  <div class="cardfooterVIEW card-footer bg-white">
      <div class="cardfooterVIEW2 d-flex bd-highlight mb-3">
        <?= $this->Form->postLink(
          __('Deletar'),
          ['action' => 'delete',  $subconta->id_subconta],
          ['confirm' => __('você quer mesmo deletar a subconta {0}?',  $subconta->subconta), 'class' => 'del btn btn-sm btn-outline-danger mr-auto p-2 bd-highlight']
        ) ?>
        <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $subconta->id_subconta], ['class' => 'edi btn btn-sm btn-outline-success p-2 bd-highlight']) ?>
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
          <th><?= __('Nº do Lancamento') ?></th>
          <th><?= __('Tipo') ?></th>
          <th><?= __('Valor') ?></th>
          <th><?= __('Parcela') ?></th>
          <th><?= __('Descrição') ?></th>
          <th><?= __('Data de Emissão') ?></th>
          <th><?= __('Data de Competência') ?></th>
          <th><?= __('Data de Baixa') ?></th>
          <th><?= __('Data de Vencimento') ?></th>
          <th><?= __('Criado') ?></th>
          <th><?= __('Modificado') ?></th>
          <th><?= __('Subconta') ?></th>
          <th><?= __('Fornecedor') ?></th>
          <th><?= __('Cliente') ?></th>
          <th><?= __('Lançamento') ?></th>
          <th><?= __('Ações') ?></th>
      </tr>
      <?php if (empty($subconta->lancamentos)) { ?>
        <tr>
            <td colspan="15">
              Não encontrado!
            </td>
        </tr>
      <?php }else{ ?>
        <?php foreach ($subconta->lancamentos as $lancamentos) : ?>
        <tr>
            <td><?= h($lancamentos->id_lancamento) ?></td>
            <td><?= h($lancamentos->tipo) ?></td>
            <td><?= h('R$ ' . $lancamentos->valor) ?></td>
            <td><?= h($lancamentos->parcela. 'x') ?></td>
            <td><?= h($lancamentos->descricao) ?></td>
            <?php if (empty($lancamentos->data_emissao)) { ?>
                <td><?= h($lancamentos->data_emissao) ?></td>
            <?php } else { ?>
                <td><?= h($lancamentos->data_emissao->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
            <?php } ?>
            <?php if (empty($lancamentos->data_competencia)) { ?>
                <td><?= h($lancamentos->data_competencia) ?></td>
            <?php } else { ?>
                <td><?= h($lancamentos->data_competencia->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
            <?php } ?>
            <?php if (empty($lancamentos->data_baixa)) { ?>
                <td><?= h($lancamentos->data_baixa) ?></td>
            <?php } else { ?>
                <td><?= h($lancamentos->data_baixa->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
            <?php } ?>
            <?php if (empty($lancamentos->data_vencimento)) { ?>
                <td><?= h($lancamentos->data_vencimento) ?></td>
            <?php } else { ?>
                <td><?= h($lancamentos->data_vencimento->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
            <?php } ?>
            <td><?= h($lancamentos->created) ?></td>
            <td><?= h($lancamentos->modified) ?></td>
            <td class="tdINDEX"><?= $lancamentos->has('subconta') ? $this->Html->link($lancamento->subconta->subconta, ['controller' => 'Lancamentos', 'action' => 'index', $lancamento->subconta->subconta]) : '' ?></td>
            <td class="tdINDEX"><?= $lancamentos->has('fornecedore') ? $this->Html->link($lancamento->fornecedore->nome, ['controller' => 'Lancamentos', 'action' => 'index', $lancamento->fornecedore->nome]) : '' ?></td>
            <td class="tdINDEX"><?= $lancamentos->has('cliente') ? $this->Html->link($lancamento->cliente->nome, ['controller' => 'Lancamentos', 'action' => 'index', $lancamento->cliente->nome]) : '' ?></td>
            <td><?= h($lancamentos->lancamento_id) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('Visualizar'), ['controller' => 'Lancamentos', 'action' => 'view', $lancamentos->id_lancamento], ['class'=>'btn vis btn-xs btn-outline-primary']) ?>
              <?= $this->Html->link(__('Editar'), ['controller' => 'Lancamentos', 'action' => 'edit', $lancamentos->id_lancamento], ['class'=>'btn edi btn-xs btn-outline-primary']) ?>
              <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Lancamentos', 'action' => 'delete', $lancamentos->id_lancamento], ['class'=>'btn del btn-xs btn-outline-danger', 'confirm' => __('Você deseja mesmo deletar # {0}?', $lancamentos->id_lancamento)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>
</div>
<
