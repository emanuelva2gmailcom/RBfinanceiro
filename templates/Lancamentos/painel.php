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
            .teste {
                /* position: absolute; */
                display: flex;
                flex-direction: column;
                justify-content: center;
            }


        }   
    </style>
</head>

<body onload="onload()">
    <div class="container-fluid  p-5">
        <div class="card container bg-info" style="border-radius: 20px;">
            <div class="card-body">
                <?= $this->Form->create([], ['id' => 'form']) ?>
                <div class="teste d-flex flex-row justify-content-center align-items-center content bg-info mb-3 p-3" style="border-radius: 20px;">
                    <div class="col-4 px-4">
                        <?= $this->Form->control('Mês', ['class' => 'form-control mes', 'type' => 'month',]); ?>
                    </div>
                    <div class="col-4 px-4">
                        <label style="color: white;">Tipo</label>
                        <?= $this->Form->select('tipo', ['REALIZADO' => 'Realizado', 'PREVISTO' => 'Previsto'], ['class' => 'form-control tipo mb-3', 'id' => 'card']); ?>
                    </div>
                    <div class="col-2 px-5 mt-3">
                        <?= $this->Form->button(__('Calcular'),) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
                <canvas class="bg-white mb-3 p-2" id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; border-radius: 20px;"></canvas>
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th class="teste"><?= ('Grupo do Fluxo de Caixa') ?></th>
                            <th class="teste"><?= ('Conta do Fluxo de Caixa') ?></th>
                            <th class="teste"><?= ('Valor') ?></th>
                        </tr>
                    </thead>

                    <tbody id="table-body">


                    </tbody>

                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.4.0/dist/chartjs-plugin-datalabels.min.js"></script>
    <script>
        function show(data) {
            let output = ''
            for (let d of data[0]) {
                output += `<tr>
                            <td>${d[0]}</td>
                            <td>${d[1]}</td>
                            <td>${d[2]}</td>
                        </tr>`
            }
            output += `<tr>
                        <th>Total</th>
                        <th> </th>
                        <th>${data[1]}</th>
                    </tr>`

            document.getElementById('table-body').innerHTML = output;
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