<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cliente $cliente
 */
?>

<?php
$this->assign('title', __('Cliente'));
?>

<style>
  .del {
    margin-right: 78%;
  }

  .edi {
    margin-right: 2%;
  }

  .views {
    padding: 50px 50px 50px 50px;
  }

  @media (max-width: 620px) {
    .views {
      padding: 0px;
      padding-top: 50px;
    }


  }
</style>


<div class="container-fluid d-flex align-items-center justify-content-center views">

  <div style="border: green solid 2px; border-radius: 20px;" class="card card-outline container bg-white ">

    <div class="card-header d-sm-flex" style="padding-top: 50px; color: green;">
      <h2 class="card-title"><?= h($cliente->nome) ?></h2>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
        <tr>
          <th style="color: green;"><?= __('Nome') ?></th>
          <td class="text-info"><?= h($cliente->nome) ?></td>
        </tr>
        <tr>
          <th style="color: green;"><?= __('Cpf') ?></th>
          <td class="text-info"> <?= h($cliente->cpf) ?></td>
        </tr>
        <tr>
          <th style="color: green;"> <?= __('Endereço') ?></th>
          <td class="text-info"><?= h($cliente->endereco) ?></td>
        </tr>
        <tr>
          <th style="color: green;"><?= __('E-mail') ?></th>
          <td class="text-info"><?= h($cliente->email) ?></td>
        </tr>
        <tr>
          <th style="color: green;"><?= __('Telefone') ?></th>
          <td class="text-info"><?= h($cliente->telefone) ?></td>
        </tr>
        <tr>
          <th style="color: green;"><?= __('N° do Cliente') ?></th>
          <td class="text-info"><?= $this->Number->format($cliente->id_cliente) ?></td>
        </tr>
        <tr>
          <th style="color: green;"><?= __('Criado') ?></th>
          <td class="text-info"><?= h($cliente->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
        <tr>
          <th style="color: green;"><?= __('Modificado') ?></th>
          <td class="text-info"><?= h($cliente->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
        <tr>
          <th style="color: green;"><?= __('Pendente') ?></th>
          <td class="text-info"><?= $cliente->is_pendente ? __('Sim') : __('Não'); ?></td>
        </tr>
      </table>
    </div>
    <div class="card-footer bg-white" style="border-radius: 20px;">
      <div style="padding-top: 20px;" class="d-flex bd-highlight mb-3">
        <?= $this->Form->postLink(
          __('Deletar'),
          ['action' => 'delete',  $cliente->id_cliente],
          ['confirm' => __('você quer mesmo deletar o cliente {0}?',  $cliente->nome), 'class' => 'del btn btn-sm btn-outline-danger mr-auto p-2 bd-highlight']
        ) ?>
        <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $cliente->id_cliente], ['class' => 'edi btn btn-sm btn-outline-success p-2 bd-highlight']) ?>
        <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-sm btn-outline-info p-2 bd-highlight']) ?>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid d-flex align-items-center justify-content-center views">

  <div style="border: green solid 2px; border-radius: 20px;" class="related related-caixaregistros view card container bg-white">

    <div class="card-header d-sm-flex" style="padding-top: 50px;">
      <h3 class="card-title" style="color: green;"><?= __('Relacionados') ?></h3>
      <!-- <div class="card-toolbox">
      <?= $this->Html->link(__('Novo'), ['controller' => 'Lancamentos', 'action' => 'add'], ['class' => 'btn btn-info btn-sm']) ?>
      <?= $this->Html->link(__('Todos '), ['controller' => 'Lancamentos', 'action' => 'index'], ['class' => 'btn btn-info btn-sm']) ?>
    </div> -->
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
        <tr style="color: green;">
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
            <td colspan="15" class="text-info">
              Não Encontrado!
            </td>
          </tr>
        <?php } else { ?>
          <?php foreach ($lancamento->lancamentos as $lancamentos) : ?>
            <tr>
              <td class="text-info"><?= h($lancamentos->id_lancamento) ?></td>
              <td class="text-info"><?= h($lancamentos->tipo) ?></td>
              <td class="text-info"><?= h($lancamentos->descricao) ?></td>
              <td class="text-info"><?= h($lancamentos->valor) ?></td>
              <td class="text-info"><?= h($lancamentos->data_emissao->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
              <?php if (empty($lancamento->data_baixa)) { ?>
                <td class="text-info"><?= h($lancamento->data_baixa) ?></td>
              <?php } else { ?>
                <td class="text-info"><?= h($lancamento->data_baixa->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
              <?php } ?>
              <td class="text-info"><?= h($lancamentos->data_vencimento->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
              <td class="text-info"><?= h($lancamentos->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
              <td class="text-info"><?= h($lancamentos->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
              <td class="text-info"><?= h($lancamentos->fluxoconta_id) ?></td>
              <td class="text-info"><?= h($lancamentos->fornecedor_id) ?></td>
              <td class="text-info"><?= h($lancamentos->cliente_id) ?></td>
              <td class="text-info"><?= h($lancamentos->lancamento_id) ?></td>
              <td class="text-info"><?= h($lancamentos->dreconta_id) ?></td>
              <td class="actions">
                <?= $this->Html->link(__('Visualizar'), ['controller' => 'Lancamentos', 'action' => 'view', $lancamentos->id_lancamento], ['class' => 'btn btn-xs btn-outline-info']) ?>
                <?= $this->Html->link(__('Editar'), ['controller' => 'Lancamentos', 'action' => 'edit', $lancamentos->id_lancamento], ['class' => 'btn btn-xs btn-outline-success']) ?>
                <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Lancamentos', 'action' => 'delete', $lancamentos->id_lancamento], ['class' => 'btn btn-xs btn-outline-danger', 'confirm' => __('Você quer mesmo deletar {0}?', $lancamentos->id_lancamento)]) ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php } ?>
      </table>
    </div>
  </div>
</div>