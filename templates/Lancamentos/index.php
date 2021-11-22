<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lancamento[]|\Cake\Collection\CollectionInterface $lancamentos
 */
?>
<?php $this->assign('title', __('Lancamentos')); ?>


<script>
    function realizado() {
        document.getElementById('real').style.display = 'block';
        document.getElementById('prev').style.display = 'none';
    }

    function previsto() {
        document.getElementById('real').style.display = 'none';
        document.getElementById('prev').style.display = 'block';
    }
</script>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
</head>
<div class="card">
    <div class="calcularINDEX card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead class="theINDEX">
                <tr>

                    <th><?= __('Tipo') ?></th>
                    <th><?= __('Valor') ?></th>
                    <th><?= __('Descrição') ?></th>
                    <th><?= __('Data de Emissão') ?></th>
                    <th><?= __('Data de Baixa') ?></th>
                    <th><?= __('Data de Vencimento') ?></th>
                    <th><?= __('Conta') ?></th>
                    <th><?= __('Fornecedor') ?></th>
                    <th><?= __('Cliente') ?></th>
                    <th><?= __('Ações') ?></th>
                </tr>
            </thead>

            <tbody class="tboINDEX">
                <?php foreach ($lancamentos as $lancamento) :

                ?>
                    <tr class="ops">
                        <td><?= h($lancamento->tipo) ?></td>
                        <td><?= h('R$ ' . $lancamento->valor) ?></td>
                        <td><?= h($lancamento->descricao) ?></td>
                        <td><?= h($lancamento->data_emissao->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
                        <?php if (empty($lancamento->data_baixa)) { ?>
                            <td><?= h($lancamento->data_baixa) ?></td>
                        <?php } else { ?>
                            <td><?= h($lancamento->data_baixa->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
                        <?php } ?>
                        <td><?= h($lancamento->data_vencimento->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
                        <td class="tdINDEX"><?= $lancamento->has('fluxoconta') ? $this->Html->link($lancamento->fluxoconta->conta, ['controller' => 'Lancamentos', 'action' => 'index', $lancamento->fluxoconta->conta]) : '' ?></td>
                        <td class="tdINDEX"><?= $lancamento->has('fornecedore') ? $this->Html->link($lancamento->fornecedore->nome, ['controller' => 'Lancamentos', 'action' => 'index', $lancamento->fornecedore->nome]) : '' ?></td>
                        <td class="tdINDEX"><?= $lancamento->has('cliente') ? $this->Html->link($lancamento->cliente->nome, ['controller' => 'Lancamentos', 'action' => 'index', $lancamento->cliente->nome]) : '' ?></td>
                        <td class="actions">
                            <div class="btn-group">
                                <?php if (($lancamento->tipo == "PREVISTO") && ($lancamento->data_baixa == null)) { ?>
                                    <?= $this->Html->link(__('Dar baixa'), ['controller' => 'Caixaregistros', 'action' => 'darbaixa', $lancamento->id_lancamento], ['class' => 'vis btn btn-xs ']) ?>
                                <?php } ?>
                                <?php if (($lancamento->tipo == "PREVISTO") && ($lancamento->data_vencimento->i18nFormat('yyyy-MM-dd', 'UTC') < $now) && ($lancamento->data_baixa == null)) { ?>
                                    <?= $this->Html->link(__('Renovar'), ['controller' => 'Lancamentos', 'action' => 'renovar', $lancamento->id_lancamento], ['class' => 'edi btn btn-xs ']) ?>
                                <?php } ?>
                                <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $lancamento->id_lancamento], ['class' => 'vis btn btn-xs', 'escape' => false]) ?>
                                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $lancamento->id_lancamento], ['class' => 'edi btn btn-xs', 'escape' => false]) ?>
                                <?= $this->Html->link(__('Deletar'), ['action' => 'delete', $lancamento->id_lancamento], ['class' => 'del btn btn-xs', 'escape' => false, 'confirm' => __('Você quer mesmo deletar {0}?', $lancamento->tipo)]) ?>
                            </div>

                        </td>

                    <?php endforeach; ?>
                    </tr>
            </tbody>

            <tfoot class="theINDEX">
                <tr>
                    <th class="thTotal"></th>
                    <td class="tboINDEX" id="total"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>

        </table>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <!-- <h4 class="modal-title" id="myModalLabel">Modal title</h4> -->
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;pointer-events: none;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.4.0/dist/chartjs-plugin-datalabels.min.js"></script>
<script>
    $(function() {
        var printCounter = 0;
        $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "language": {
                    "emptyTable": "Nenhum registro disponível na tabela",
                    "zeroRecords": "Nenhum registro encontrado",
                    "info": "Mostrando _START_ de _END_ dos _TOTAL_ lançamentos",
                    "infoEmpty": "Mostrando 0 de 0 dos 0 lançamentos",
                    "infoFiltered": "(filtrado do total de _MAX_ lançamentos)",
                    "search": "Procurar:",
                    "paginate": {
                        "first": "Primeiro",
                        "last": "Último",
                        "next": "Próximo",
                        "previous": "Anterior"
                    },
                },

                columns: [{
                        data: 'Tipo'
                    },
                    {
                        data: 'Descricao'
                    },
                    {
                        data: 'Valor'
                    },
                    {
                        data: 'Data de Emissão'
                    },
                    {
                        data: 'Data de Baixa'
                    },
                    {
                        data: 'Data de Vencimento'
                    },
                    {
                        data: 'Fluxoconta'
                    },
                    {
                        data: 'Fornecedor'
                    },
                    {
                        data: 'Cliente'
                    },

                    {
                        data: 'Ações',
                        render: function(data, type, row) {
                            return type === 'export' ?
                                null :
                                data;
                        }
                    },



                ],
               
            dom: 'Bfrtip',
            buttons: [{

                    text: 'Adicionar',
                    className: 'addINDEX',
                    action: function() {
                        window.location.href = '/lancamentos/add'
                    }
                },
                {
                    extend: 'copyHtml5',
                    text: 'Copiar',
                    title: " ",
                    exportOptions: {
                        orthogonal: 'export',

                        columns: function(column, data, node) {

                            if (column > 7) {
                                return false;
                            }
                            return true;
                        },
                    },
                    footer: true
                },
                {
                    extend: "print",
                    title: "Lançamentos",
                    footer: true,
                },
                {
                    extend: "csvHtml5",
                    title: "Lançamentos",
                    footer: true
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        orthogonal: 'teste',
                        columns: function(column, data, node) {
                            if (column > 7) {
                                return false;
                            }
                            return true;
                        },
                    },
                    title: "Lançamento",
                    footer: true
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        orthogonal: 'export',
                        columns: function(column, data, node) {
                            if (column > 7) {
                                return false;
                            }
                            return true;
                        },
                    },
                    title: "Lançamento",
                    footer: true,

                },
                {
                    extend: 'collection',
                    text: 'Mostrar Colunas',
                    buttons: ['columnsVisibility'],
                    visibility: true
                },
                {
                    text: 'Calcular',
                    action: function() {
                        var Tabela = document.getElementById("example1");
                        var Trs = Tabela.getElementsByClassName("ops");

                        var valor = 0;
                        var valorTotal = 0;
                        for (var i = 0; i < Trs.length; i++) {
                            valor = Trs[i]['children'][1]['outerText'].replace('R$', '')
                            // valor = valor.replace('.', '')
                            // valor = valor.replace(',', '.')
                            // valor = Trs[i]['children'][2]['outerText']
                            valorTotal += Number(valor)

                        }
                        document.getElementsByClassName('thTotal')[0].innerHTML = 'Total'
                        document.getElementById('total').innerHTML = valorTotal.toLocaleString('pt-br', {
                            style: 'currency',
                            currency: 'BRL'
                        });


                    }

                },
                {
                    text: 'Gráfico',
                    action: function(e, node, config) {
                        var Tabela = document.getElementById("example1");
                        var Trs = Tabela.getElementsByClassName("ops");
                        var valor = [];
                        var Head = []
                        month = new Array("janeiro", "fevereiro", "março", "abril", "maio", "junho", "julho", "agosto", "setembro", "outubro", "novembro", "dezembro")

                        for (var i = 0; i < Trs.length; i++) {
                            valor.push(Trs[i]['children'][1]['outerText'].replace('R$', ''))
                            Head.push(month[Trs[i]['children'][5]['outerText'].split('-')[1].replace(/^0+/, '')])

                        }

                        var areaChartData = {
                            labels: Head,
                            datasets: [{
                                label: 'Saidas',
                                backgroundColor: 'rgba(60,141,188,0.9)',
                                borderColor: 'rgba(60,141,188,0.8)',
                                pointRadius: false,
                                pointColor: '#3b8bba',
                                pointStrokeColor: 'rgba(60,141,188,1)',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(60,141,188,1)',
                                data: valor
                            }, ]
                        }

                        var areaChartOptions = {
                            maintainAspectRatio: false,
                            responsive: true,
                            legend: {
                                display: false
                            },
                            scales: {
                                xAxes: [{
                                    gridLines: {
                                        display: false,
                                    }
                                }],
                                yAxes: [{
                                    gridLines: {
                                        display: false,
                                    }
                                }]
                            }
                        }
                        var barChartCanvas = $('#barChart').get(0).getContext('2d')
                        var barChartData = $.extend(true, {}, areaChartData)

                        var barChartOptions = {
                            responsive: true,
                            maintainAspectRatio: false,
                            datasetFill: false
                        }

                        new Chart(barChartCanvas, {
                                type: 'bar',
                                data: barChartData,
                                options: barChartOptions
                            }),
                            $('#myModal').modal('show')

                    }
                },
            ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


        

    });
</script>
