
<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fornecedore[]|\Cake\Collection\CollectionInterface $fornecedores
 */
?>

<style>
    .tr1 a {
        color: #029BE1;
    }

    .nm a {
        color: green;
    }

    .sorting_disabled {
        color: green;
    }

    .dataTables_info {
        color: green;
    }

    .dataTables_empty {
        color: #17a2b8;
    }

    .dataTables_filter input:focus {
        color: #17a2b8;
        border: green solid 2px;

    }

    .dataTables_filter input {
        color: #17a2b8;
        border: green solid 2px;

    }

    .dataTables_filter label {
        color: #17a2b8;

    }

    .buttons-copy {
        background-color: #17a2b8;
        color: white;
        border: 1px solid #17a2b8;
        opacity: 0.7;
    }

    .buttons-copy:hover {
        background-color: white;
        color: #17a2b8;
        border: 1px solid #17a2b8;
        opacity: 0.7;
    }

    .buttons-print {
        background-color: #0099CC;
        color: white;
        border: 1px solid #0099CC;
        opacity: 0.7;
    }

    .buttons-print:hover {
        background-color: white;
        color: #0099CC;
        border: 1px solid #0099CC;
        opacity: 0.7;
    }

    .buttons-csv {
        background-color: green;
        color: white;
        border: 1px solid green;
        opacity: 0.7;
    }

    .buttons-csv:hover {
        background-color: white;
        color: green;
        border: 1px solid green;
        opacity: 0.7;
    }

    .buttons-excel {
        background-color: #006400;
        color: white;
        border: 1px solid #006400;
        opacity: 0.7;
    }

    .buttons-excel:hover {
        background-color: white;
        color: #006400;
        border: 1px solid #006400;
        opacity: 0.7;
    }

    .buttons-pdf {
        background-color: #4b4b4b;
        color: white;
        border: 1px solid #4b4b4b;
        opacity: 0.7;
    }

    .buttons-pdf:hover {
        background-color: white;
        color: #4b4b4b;
        border: 1px solid #4b4b4b;
        opacity: 0.7;
    }

    .buttons-collection {
        background-color: black;
        color: white;
        border: 1px solid black;
        opacity: 0.7;
    }

    .buttons-collection:hover {
        background-color: white;
        color: black;
        border: 1px solid black;
        opacity: 0.7;
    }
</style>

<div class="card">
    <div class="card-header">
        <?= $this->Form->create([], ['id' => 'form', 'class' => 'row']) ?>
        <div class="col-md-3">
            <label>Período</label>
            <?= $this->Form->select(2, [ 'mes' => 'MÊS','trimestre' => 'TRIMESTRE','ano' => 'ANO'], ['class' => 'periodo form-control select2bs4']); ?>
        </div>

        <div class="col-md-3">
            <label>Enviar</label>
            <?= $this->Form->button(__('Enviar'), ['class' => 'form-control']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
    <div class="card-2 card-body table-responsive">
        <table id="example" class="table table-sm table-bordered table-striped" style="width: 100%;">
        <thead class="text-green">

            </thead>
            <tbody class="text-info">

            </tbody>
        </table>
    </div>
    <div class="card" id="kk">

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })

    $('#reservation').daterangepicker()

    function datase(data) {
        console.log(data)
        response = []
        data.total.receitas.push(data.total.receitas[0])
        data.total.receitas[0] = '1 - Faturamento'
        $($('#example').DataTable().row.add(data.total.receitas).draw()
            .node()).addClass('bg-info');
        // response.push(data.total.entradas)
        data.rows.td.map(function(d) {
            if (data.rows.th['receita'].includes(d[0])) {
                // response.push(d)
                $($('#example').DataTable().row.add(d).draw()
                    .node()).addClass('text-success');
            }
        })
        data.total.variaveis.push(data.total.variaveis[0])
        data.total.variaveis[0] = '2 - Custos Variáveis'
        $($('#example').DataTable().row.add(data.total.variaveis).draw()
            .node()).addClass('bg-info');
        data.rows.td.map(function(d) {
            if (data.rows.th['variaveis'].includes(d[0])) {
                $($('#example').DataTable().row.add(d).draw()
                    .node()).addClass('text-danger');
            }
        })
        data.total.contribuicao.push(data.total.contribuicao[0])
        data.total.contribuicao[0] = '3 - (=) Margem de Contribuição (1 - 2)'
        $($('#example').DataTable().row.add(data.total.contribuicao).draw()
            .node()).addClass('bg-info');

        data.total.fixos.push(data.total.fixos[0])
        data.total.fixos[0] = '4 - Custos Fixos'
        $($('#example').DataTable().row.add(data.total.fixos).draw()
            .node()).addClass('bg-info');
        data.rows.td.map(function(d) {
            if (data.rows.th['fixo'].includes(d[0])) {
                $($('#example').DataTable().row.add(d).draw()
                    .node()).addClass('text-danger');
            }
        })
        data.total.liquido.push(data.total.liquido[0])

        data.total.liquido[0] = '5 - Resultado Liquido (3 - 4)'
        $($('#example').DataTable().row.add(data.total.liquido).draw()
            .node()).addClass('bg-info');

    }


    function formatador(data) {
        data['header'].unshift('DRE')
        data['header'].push('%')
        columns = []
        //    inner = ''
        data['header'].map(function(dat, key) {
            if (key == 0) {
                columns.push({
                    title: dat,
                    data: key,
                    width: "150px"
                })
            } else {
                columns.push({
                    title: dat,
                    data: key,
                    width: "100px"
                })
            }
        })


        $("#example").DataTable({
            "columns": columns,
            "columnDefs": [{
                "defaultContent": "-",
                "targets": "_all",

            }],
            "paging": true,
            "lengthChange": false,
            "pageLength": 100,
            "searching": true,
            "ordering": false,
            "info": true,
            "scrollX": true,
            "language": {
                "emptyTable": "Nenhum registro disponível na tabela",
                "zeroRecords": "Nenhum registro encontrado",
                "info": "Mostrando _START_ de _END_ dos _TOTAL_ caixas gerenciais",
                "infoEmpty": "Mostrando 0 de 0 dos 0 caixas gerenciais",
                "infoFiltered": "(filtrado do total de _MAX_ caixas gerenciais)",
                "search": "Procurar:",
                "paginate": {
                    "first": "Primeiro",
                    "last": "Último",
                    "next": "Próximo",
                    "previous": "Anterior"
                },
            },
            "buttons": [{
              extend: 'copyHtml5',
              text: 'Copiar',

              exportOptions: {
                orthogonal: 'export',
                columns: function(column, data, node) {
                  if (column > 7) {
                    return false;
                  }
                  return true;
                },
              }
            }, "print", "csvHtml5", "excelHtml5", "pdfHtml5",
            {
              extend: 'collection',
              text: 'Mostrar Colunas',
              buttons: [ 'columnsVisibility' ],
              visibility: true
            }, ]
        }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
        datase(data)
    }
    $(function() {
        $("button").click(async function(event) {
            event.preventDefault();
            const csrf = document.querySelector("#form").querySelectorAll('input[name ="_csrfToken"]')[0].value;
            $comeco = $("#0").val()
            $final = $("#1").val()
            $periodo = $(".periodo").val()
            // console.log([$comeco, $final, $periodo])
            try {
                const response = axios.post('/relatorios/getGerencial/', [$comeco, $final, $periodo], {
                    headers: {
                        "X-CSRF-Token": csrf
                    }
                }).then(function(response) { // handle success
                    $("#example").DataTable().destroy();
                    $("#example").empty()
                    formatador(response.data[1])
                })
            } catch (error) {
                console.error(error);
            }
        })
        try {
            const response = axios.get('/relatorios/dreAPI/').then(function(response) { // handle success
                formatador(response.data[1])
            })
        } catch (error) {
            console.error(error);
        }
    });
</script>
