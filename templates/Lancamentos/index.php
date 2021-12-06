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
        <table id="example1" class="tableINDEX table table-bordered table-striped">
            <thead class="theINDEX">
                <tr>

                    <th><?= __('Tipo') ?></th>
                    <th><?= __('Valor') ?></th>
                    <th><?= __('Parcela') ?></th>
                    <th><?= __('Descrição') ?></th>
                    <th><?= __('Data de Emissão') ?></th>
                    <th><?= __('Data de Competência') ?></th>
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
                        <td><?= h($lancamento->parcela !== null ? $lancamento->parcela . '° Parcela' : 'Nenhuma') ?></td>
                        <td><?= h($lancamento->descricao) ?></td>
                        <td><?= h($lancamento->data_emissao) ?></td>
                        <td><?= h($lancamento->data_competencia) ?></td>
                        <?php if (empty($lancamento->data_baixa)) { ?>
                            <td><?= h($lancamento->data_baixa) ?></td>
                        <?php } else { ?>
                            <td><?= h($lancamento->data_baixa) ?></td>
                        <?php } ?>
                        <td><?= h($lancamento->data_vencimento) ?></td>
                        <td class="tdINDEX"><?= $lancamento->has('subconta') ? $this->Html->link($lancamento->subconta->subconta, ['controller' => 'Subcontas', 'action' => 'view', $lancamento->subconta->id_subconta]) : '' ?></td>
                        <td class="tdINDEX"><?= $lancamento->has('fornecedore') ? $this->Html->link($lancamento->fornecedore->nome, ['controller' => 'Fornecedores', 'action' => 'view', $lancamento->fornecedore->id_fornecedor]) : '' ?></td>
                        <td class="tdINDEX"><?= $lancamento->has('cliente') ? $this->Html->link($lancamento->cliente->nome, ['controller' => 'Clientes', 'action' => 'view', $lancamento->cliente->id_cliente]) : '' ?></td>
                        <td class="actions">
                            <div class="btn-group">
                                <?php if (($lancamento->tipo == "PREVISTO") && ($lancamento->data_baixa == null)) { ?>
                                    <?= $this->Html->link(__('Dar baixa'), ['controller' => 'Caixaregistros', 'action' => 'darbaixa', $lancamento->id_lancamento], ['class' => 'vis btn btn-xs ']) ?>
                                <?php } ?>
                                <?php if (($lancamento->tipo == "PREVISTO") && ($lancamento->data_vencimento < $now) && ($lancamento->data_baixa == null)) { ?>
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
        var column = this;
        console.log(column)
        var teste = $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "language": {
                "emptyTable": "Nenhum registro disponível na tabela",
                "zeroRecords": "Nenhum registro encontrado",
                "info": "Mostrando _END_ de _MAX_ lançamentos",
                "infoEmpty": "Mostrando 0 de 0 lançamentos",
                "infoFiltered": " ",
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
                    data: 'Valor',
                    width: '75px'
                },
                {
                    data: 'Parcela'
                },
                {
                    data: 'Descricao'
                },
                {
                    data: 'Data de Emissão'
                },
                {
                    data: 'Data de Competência'
                },
                {
                    data: 'Data de Baixa'
                },
                {
                    data: 'Data de Vencimento'
                },
                {
                    data: 'Fluxoconta',
                    width: '150px'
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
                        window.location.href = '/lancamentos/opcao'
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
                        console.log(Trs)
                        var valorRealizado = 0;
                        var valorPrevisto = 0;
                        var valorDRE = 0;
                        var Head = []
                        month = new Array(" ", "janeiro", "fevereiro", "março", "abril", "maio", "junho", "julho", "agosto", "setembro", "outubro", "novembro", "dezembro")

                        for (var i = 0; i < Trs.length; i++) {
                            if (Trs[i]['children'][0]['outerText'] == 'REALIZADO') {
                                valorRealizado += Number(Trs[i]['children'][1]['outerText'].replace('R$', ''))
                            } else if (Trs[i]['children'][0]['outerText'] == 'PREVISTO') {
                                valorPrevisto += Number(Trs[i]['children'][1]['outerText'].replace('R$', ''))
                            } else {
                                valorDRE += Number(Trs[i]['children'][1]['outerText'].replace('R$', ''))
                            }
                            Head.push([month[Trs[i]['children'][7]['outerText'].split('/')[1].replace(/^0+/, '')] + ' / ' + Trs[i]['children'][7]['outerText'].split('/')[2]] + '  ')

                        }

                        var areaChartData = {
                            labels: Head,
                            datasets: [{

                                    label: 'Realizado',
                                    backgroundColor: '#DBEBED',
                                    pointRadius: false,
                                    pointColor: '#3b8bba',
                                    pointStrokeColor: 'rgba(60,141,188,1)',
                                    pointHighlightFill: '#fff',
                                    pointHighlightStroke: 'rgba(60,141,188,1)',
                                    data: [valorRealizado]
                                },
                                {

                                    label: 'Previsto',
                                    backgroundColor: 'rgba(210, 214, 222, 1)',
                                    borderColor: 'rgba(210, 214, 222, 1)',
                                    pointRadius: false,
                                    pointColor: 'rgba(210, 214, 222, 1)',
                                    pointStrokeColor: '#c1c7d1',
                                    pointHighlightFill: '#fff',
                                    pointHighlightStroke: 'rgba(220,220,220,1)',
                                    data: [valorPrevisto]
                                },
                                {

                                    label: 'DRE',
                                    backgroundColor: 'red',
                                    borderColor: 'rgba(210, 214, 222, 1)',
                                    pointRadius: false,
                                    pointColor: 'rgba(210, 214, 222, 1)',
                                    pointStrokeColor: '#c1c7d1',
                                    pointHighlightFill: '#fff',
                                    pointHighlightStroke: 'rgba(220,220,220,1)',
                                    data: [valorDRE]
                                },
                            ],
                        }

                        var areaChartOptions = {
                            maintainAspectRatio: false,
                            responsive: true,
                            legend: {
                                display: false,
                            },
                            scales: {
                                xAxes: [{
                                    gridLines: {
                                        display: false
                                    }
                                }],
                                yAxes: [{
                                    gridLines: {
                                        display: false
                                    }
                                }]
                            },
                        }
                        var barChartCanvas = $('#barChart').get(0).getContext('2d')
                        var barChartData = $.extend(true, {}, areaChartData)

                        var barChartOptions = {
                            responsive: true,
                            maintainAspectRatio: false,
                            datasetFill: false,
                        }

                        new Chart(barChartCanvas, {
                                type: 'bar',
                                data: barChartData,
                                options: {
                                    barChartOptions,
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }]
                                    }
                                },

                            }),
                            $('#myModal').modal('show')

                    }
                },
                {
                    extend: 'collection',
                    text: 'Filtragem de Colunas',
                    buttons: ['columnsVisibility'],
                    visibility: true
                },
                {
                    extend: 'collection',
                    text: 'Filtragem do Tipo',
                    buttons: [{
                            text: 'REALIZADO',
                            action: function() {
                                this
                                    .columns(0)
                                    .search("REALIZADO")
                                    .draw();
                            }
                        },
                        {
                            text: 'PREVISTO',
                            action: function() {
                                this
                                    .columns(0)
                                    .search("PREVISTO")
                                    .draw();
                            }
                        },
                        {
                            text: 'DRE',
                            action: function() {
                                this
                                    .columns(0)
                                    .search("DRE")
                                    .draw();
                            }
                        },
                        {
                            text: 'TODOS',
                            action: function() {
                                this
                                    .columns(0)
                                    .search(" ")
                                    .draw();
                            }
                        },
                    ],
                    visibility: true
                },
            ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');



        // teste
        //     // .columns( '.status' )
        //     .search('REALIZADO')
        //     .draw();
    });
</script>