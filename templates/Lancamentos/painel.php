<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
</head>

<body>
    <div class="container-fluid d-flex align-items-center justify-content-center p-3">
        <div class="cardPAINEL card container ">
            <div class="card-body">
                <?= $this->Form->create([], ['id' => 'form', 'class' => 'row']) ?>
                <div class="col-md-6">
                    <?= $this->Form->control('Mês', ['class' => 'form-control mes', 'type' => 'month',]); ?>
                    <!-- /.form-group -->
                </div>
                <div class="col-md-4">
                    <div class="formgroupPAINEL form-group">
                        <label>Tipo</label>
                        <?= $this->Form->select('tipo', ['REALIZADO' => 'Realizado', 'PREVISTO' => 'Previsto'], ['class' => 'form-control tipo mb-3', 'id' => 'card']); ?>
                    </div>

                </div>
                <!-- /.col -->
                <div class="col-md-2">
                    <div class="formgroupPAINEL form-group">
                        <label>Enviar</label>
                        <?= $this->Form->button(__('Calcular'), ['class' => 'btnADD form-control']) ?>
                    </div>
                </div>
                <!-- /.col -->
                <?= $this->Form->end() ?>
                <canvas class="bg-white mb-3 p-2" id="donutChart" ></canvas>
                <div class="table table-responsive">

                    <table class="table text-nowrap" id="example">
                        <thead>
                            <!-- <tr>
                                <th><?= ('Grupo do Fluxo de Caixa') ?></th>
                                <th><?= ('Conta do Fluxo de Caixa') ?></th>
                                <th><?= ('Valor') ?></th>
                            </tr> -->
                        </thead>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.4.0/dist/chartjs-plugin-datalabels.min.js"></script>
    <script>
        function show(data) {

            $('#example').DataTable({
                "columns": [{
                        title: 'Grupo do Fluxo de Caixa'
                    },
                    {
                        title: 'Conta do Fluxo de Caixa'
                    },
                    {
                        title: 'Valor'
                    },
                ],
                "columnDefs": [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "destroy": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "emptyTable": "Nenhum registro disponível na tabela",
                    "zeroRecords": "Nenhum registro encontrado",
                    "info": "Mostrando _START_ de _END_ das _TOTAL_ contas",
                    "infoEmpty": "Mostrando 0 de 0 dos 0 fornecedores",
                    "infoFiltered": "(filtrado do total de _MAX_ fornecedores)",
                    "search": "Procurar:",
                    "paginate": {
                        "first": "Primeiro",
                        "last": "Último",
                        "next": "Próximo",
                        "previous": "Depois"
                    },
                }
            });
            var t = $('#example').DataTable()
            t.clear()
            t.rows.add(data[0])
            t.draw()
            t.row.add(['Total', '', data[1]])
            t.draw()
        }

        let donutChartCanvas = $('#donutChart').get(0).getContext('2d')

        let donutData = {
            labels: [
                'Entradas',
                'Saidas',
                'Total',
            ],
            datasets: [{
                data: [],
                backgroundColor: ['#047076', '#10564F', '#DBEBED']

            }]
        }
        let donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
            tooltips: {
                enabled: true,
                mode: 'label',
                callbacks: {
                    label: function(tooltipItem, data) {
                        var indice = tooltipItem.index;
                        return data.datasets[0].data[indice];
                    }
                }
            },
            plugins: {
                datalabels: {
                    formatter: (value, ctx) => {
                        let sum = ctx.dataset._meta[0].total;
                        let percentage = (value * 100 / sum).toFixed(2) + "%";
                        return percentage;
                    },
                    color: '#fff',
                }
            }

        }
        let donutChart = new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })

        function chart(data) {
            donutChart.data.datasets[0].data = [data.entrada, data.saida, data.total]
            donutChart.update()
        }

        const csrf = document.querySelector("#form").querySelectorAll('input[name ="_csrfToken"]')[0].value;
        $("button").click(function(event) {
            event.preventDefault();
            $tipo = $(".tipo").val()
            $mes = $(".mes").val()

            try {
                const response = axios.post('/lancamentos/getTablePainel/', [$tipo, $mes], {
                    headers: {
                        "X-CSRF-Token": csrf
                    }
                }).then(function(response) { // handle success
                    chart(response.data[2])
                    show(response.data)
                })
            } catch (error) {
                console.error(error);
            }
        })
        try {
            const response = axios.get('/lancamentos/getTablePainel/').then(function(response) { // handle success
                show(response.data)
                chart(response.data[2])
            })
        } catch (error) {
            console.error(error);
        }
    </script>
</body>

</html>
