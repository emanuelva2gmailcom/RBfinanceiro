<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fornecedore $fornecedore
 */
?>

<?php
$this->assign('title', __('Fornecedor'));
?>

<div class="container-fluid d-flex align-items-center justify-content-center views">

    <div class="carVIEW card card-outline container bg-white ">

        <div class="carhVIEW card-header d-sm-flex">
            <h2 class="carttVIEW card-title"><?= h($fornecedore->nome) ?></h2>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="tabl theINDEX tboINDEX table-hover text-nowrap">
                <tr>
                    <th><?= __('Nome') ?></th>
                    <td><?= h($fornecedore->nome) ?></td>
                </tr>
                <tr>
                    <th><?= __('CNPJ') ?></th>
                    <td><?= h($fornecedore->cnpj) ?></td>
                </tr>
                <tr>
                    <th><?= __('Responsável') ?></th>
                    <td><?= h($fornecedore->responsavel) ?></td>
                </tr>
                <tr>
                    <th><?= __('Endereço') ?></th>
                    <td><?= h($fornecedore->endereco) ?></td>
                </tr>
                <tr>
                    <th><?= __('E-mail') ?></th>
                    <td><?= h($fornecedore->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Telefone') ?></th>
                    <td><?= h($fornecedore->telefone) ?></td>
                </tr>
                <tr>
                    <th><?= __('N° do Fornecedor') ?></th>
                    <td><?= $this->Number->format($fornecedore->id_fornecedor) ?></td>
                </tr>
                <tr>
                    <th><?= __('Criado') ?></th>
                    <td><?= h($fornecedore->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modificado') ?></th>
                    <td><?= h($fornecedore->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pendente') ?></th>
                    <td><?= $fornecedore->is_pendente ? __('Sim') : __('Não'); ?></td>
                </tr>
            </table>
        </div>
        <div class="carfVIEW card-footer bg-white">
            <div class="carfVIEW2 d-flex bd-highlight mb-3">
                <?= $this->Form->postLink(
                    __('Deletar'),
                    ['action' => 'delete',  $fornecedore->id_fornecedor],
                    ['confirm' => __('Você quer mesmo deletar o fornecedor {0}?',  $fornecedore->nome), 'class' => 'del btn btn-sm btn-outline-danger mr-auto p-2 bd-highlight']
                ) ?>
                <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $fornecedore->id_fornecedor], ['class' => 'edi btn btn-sm btn-outline-success p-2 bd-highlight']) ?>
                <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn vis btn-sm btn-outline-info p-2 bd-highlight']) ?>
            </div>
        </div>
    </div>
</div>
