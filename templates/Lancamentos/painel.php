<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    <style>
        .btn {
            background-color: white;
            color: #17a2b8;
            border: 1px solid white;
        }

        .btn:hover {
            background-color: #17a2b8;
            color: white;
            border: 1px solid white;
        }

        .btn:focus {
            background-color: white;
            color: #17a2b8;
            border: 1px solid white;
        }

        .month label {
            color: white;
        }

        @media (max-width: 620px) {
            .card {
                position: absolute;
                margin-top: 970px;
                min-width: 90%;
            }

        }
    </style>
</head>

<body>
    <div class="container-fluid d-flex align-items-center justify-content-center p-5">
        <div class="card container bg-info" style="border-radius: 20px;">
            <div class="card-body">
                <?= $this->Form->create([], ['id' => 'form', 'class' => 'row']) ?>
                <div class="col-md-6">
                    <?= $this->Form->control('Mês', ['class' => 'form-control mes', 'type' => 'month',]); ?>
                    <!-- /.form-group -->
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label style="color: white;">Tipo</label>
                        <?= $this->Form->select('tipo', ['REALIZADO' => 'Realizado', 'PREVISTO' => 'Previsto'], ['class' => 'form-control tipo mb-3', 'id' => 'card']); ?>
                    </div>

                </div>
                <!-- /.col -->
                <div class="col-md-2">
                    <div class="form-group">
                        <label style="color: white;">Enviar</label>
                        <?= $this->Form->button(__('Calcular'), ['class' => 'form-control']) ?>
                    </div>
                </div>
                <!-- /.col -->
                <?= $this->Form->end() ?>
                <canvas class="bg-white mb-3 p-2" id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; border-radius: 20px;"></canvas>
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
            console.log(data[0])
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
                backgroundColor: ['#00a65a', '#DC4731', '#79A9F5']

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