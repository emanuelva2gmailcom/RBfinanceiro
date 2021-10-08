<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fornecedore[]|\Cake\Collection\CollectionInterface $fornecedores
 */
?>

<?php $this->assign('title', __('Fornecedores') ); ?>



<div class="container-fluid d-flex align-items-center justify-content-center p-5">
    <div class="card container card-outline bg-white" style="border: green solid 2px; border-radius: 20px;">
        <div class="card-header d-sm-flex" style="padding-top: 50px;">
    <div class="card-toolbox">
      <?= $this->Paginator->limitControl([], null, [
            'label'=>false,
            'class' => 'form-control-sm',
            'style' => 'color: #029BE1; border: 2px solid green;',
          ]); ?>
      <?= $this->Html->link(__('Novo Fornecedor'), ['action' => 'add'], ['class' => 'btn btn-info btn-sm']) ?>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
    <table class="table text-nowrap">
        <thead>
        <tr style="color: green;">

              <th class="teste"><?= ('Nome') ?></th>
              <th class="teste"><?= ('CNPJ') ?></th>
              <th class="teste"><?= ('Responsável') ?></th>
              <th class="teste"><?= ('Endereço') ?></th>
              <th class="teste"><?= ('E-mail') ?></th>
              <th class="teste"><?= ('Telefone') ?></th>

              <th class="teste"><?= ('Is_Pendente') ?></th>
              <th class="actions teste"><?= __('Ações') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($fornecedores as $fornecedore): ?>
            <tr style="color: #029BE1;">

            <td><?= h($fornecedore->nome) ?></td>
            <td><?= h($fornecedore->cnpj) ?></td>
            <td><?= h($fornecedore->responsavel) ?></td>
            <td><?= h($fornecedore->endereco) ?></td>
            <td><?= h($fornecedore->email) ?></td>
            <td><?= h($fornecedore->telefone) ?></td>

            <td><?= ($fornecedore->is_pendente) ? __('Sim') : __('Não') ?></td>
            <td class="actions">
              <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $fornecedore->id_fornecedor], ['class'=>'btn btn-xs btn-outline-info', 'escape'=>false]) ?>
              <?= $this->Html->link(__('Editar'), ['action' => 'edit', $fornecedore->id_fornecedor], ['class'=>'btn btn-xs btn-outline-success', 'escape'=>false]) ?>
              <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $fornecedore->id_fornecedor], ['class'=>'btn btn-xs btn-outline-danger', 'escape'=>false, 'confirm' => __('Você quer mesmo deletar o fonecedor {0}?', $fornecedore->nome)]) ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
  </div>
  <!-- /.card-body -->

  <div class="card-footer d-md-flex paginator" style="color: green;">
    <div class="mr-auto" style="font-size:.8rem">
      <?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} Fornecedores de {{count}} no total')) ?>
    </div>
    <ul class="pagination pagination-sm">
      <?= $this->Paginator->first('<i class="fas fa-angle-double-left"></i>', ['escape'=>false]) ?>
      <?= $this->Paginator->prev('<i class="fas fa-angle-left"></i>', ['escape'=>false]) ?>
      <?= $this->Paginator->numbers() ?>
      <?= $this->Paginator->next('<i class="fas fa-angle-right"></i>', ['escape'=>false]) ?>
      <?= $this->Paginator->last('<i class="fas fa-angle-double-right"></i>', ['escape'=>false]) ?>
    </ul>

  </div>
  <!-- /.card-footer -->
</div>
          </div>
