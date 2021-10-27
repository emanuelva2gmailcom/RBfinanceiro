        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-sm table-bordered table-striped table-responsive">
                </table>
            </div>
        </div>
        <div class="container-sm d-flex justify-content-center p-5">
            <div style="border: green 2px solid;border-radius: 20px;" class="card-sm bg-white shadow" style="width: 32rem;">
                <div class="card-body">
                    <h2 style="font-size: 30px; color: green;" class="card-subtitle text-center">Pesquisa de Fluxo de Caixa Avançado</h2>
                    <hr class="border-info">
                    <div class="form-group">
                        <?= $this->Form->create([], ['id' => 'form']) ?>
                        <?= $this->Form->control(0, ['label' => 'Começo', 'type' => 'date'], ['class' => 'comeco form-control text-white']); ?>
                        <?= $this->Form->control(1, ['label' => 'Final', 'type' => 'date'], ['class' => 'final la form-control']); ?>
                        <label>Período</label><br>
                        <?= $this->Form->select(2, ['mes' => 'MÊS', 'ano' => 'ANO', 'dia' => 'DIA'], ['class' => 'periodo form-control select2bs4']); ?>
                    </div>
                </div>
                <div class="d-flex justify-content-end card-footer">
                    <?= $this->Form->button(__('Submit', ['class' => 'btn btn-dark pull-right'])) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
            <script>
                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })
                $(async function() {
                    const csrf = document.querySelector("#form").querySelectorAll('input[name ="_csrfToken"]')[0].value;
                    $("button").click(async function(event) {
                        event.preventDefault();
                        $comeco = $(".comeco").val()
                        $final = $(".final").val()
                        $periodo = $(".periodo").val()

                        try {
                            const response = await axios.post('/relatorios/getFluxoDeCaixa/', [$comeco, $final, $periodo], {
                                headers: {
                                    "X-CSRF-Token": csrf
                                }
                            }).then(function(response) { // handle success
                                console.log(response.data)
                                $(".table").DataTable({
                                    "data": response.data,
                                    "paging": true,
                                    "lengthChange": false,
                                    "searching": true,
                                    "ordering": false,
                                    "info": true,
                                    "autoWidth": false,
                                    "responsive": true,
                                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');;
                            })
                        } catch (error) {
                            console.error(error);
                        }
                    })
                    try {
                        const response = await axios.get('/relatorios/getFluxoDeCaixa/').then(function(response) { // handle success
                            console.log(response.data[1]['header'])
                            $('#example1').DataTable({
                                data: response.data[1]['rows'],
                                columns: ['a', 'ba']
                            });
                        })
                    } catch (error) {
                        console.error(error);
                    }
                    // $(".table").DataTable({
                    //     "paging": true,
                    //     "lengthChange": false,
                    //     "searching": true,
                    //     "ordering": false,
                    //     "info": true,
                    //     "autoWidth": false,
                    //     "responsive": true,
                    //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');;
                    // $("").DataTable({
                    //     "ordering": false,
                    //     "autoWidth": false,
                    //     "responsive": true,
                    //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    // }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');;
                });
            </script>
            <style>
                @media (max-width: 620px) {
                    .card-sm {
                        position: absolute;
                        /* margin-left: 0px; */
                        min-width: 90%;
                    }


                }
            </style>