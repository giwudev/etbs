@extends('layouts.general')

@section('path_content')
    @if (sizeof($pathMenu) != 0)
        @for ($i = 0; $i < count($pathMenu); $i++) 
            <li class="breadcrumb-item active"><a href="{{ $pathMenu[$i]['lien'] }}" class="kt-subheader__breadcrumbs-link">{{ $pathMenu[$i]['titre'] }}</a></li>
        @endfor
    @endif
@stop

@section('content')

    <div class="col-lg-12">
        <div class="card" id="ticketsList">
            <div class="card-header border-0">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1"><i class="{{ $icone }} m-2"></i>{{ $titre }}</h5>
                    <div class="flex-shrink-0">
                        @if (in_array('add_frequenter', session('InfosAction')))
                        <a href="{{ route('frequenter.create') }}" class="btn btn-primary btn-label right"
                            onclick="f(event)"><i class="ri-add-line label-icon align-middle fs-16 ms-2"></i>Ajouter</a>
                        @endif
                        @if (in_array('exporter_frequenter', session('InfosAction')))
                        <div class="btn-group"><button type="button" class="btn btn-primary">Exporter</button>
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        id="dropdownMenuReference" data-bs-toggle="dropdown" aria-expanded="false"
                                data-bs-reference="parent"><span class="visually-hidden">Toggle Dropdown</span></button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                <li><a class="dropdown-item exporterXls" target="_blank" href="#">Excel</a></li>
                                <!-- <li><a class="dropdown-item exporterPdf" target="_blank" href="#">PDF</a></li> -->
                            </ul>
                        </div>
                        @endif
                        @if(in_array('deletepromo_frequenter', session('InfosAction')))
                            <button type="button" title='Supprimer la promotion choisie' class="btn btn-danger waves-effect waves-light btn-delete-promotion"
                                    data-bs-toggle="modal">Supprimer <i class="ri-delete-bin-6-line"></i></button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body border border-dashed border-end-0 border-start-0">
                {!! Form::open(['id' => 'formSearch', 'class' => '', 'method' => 'GET']) !!}
                <div class="row gy-4">
                    <!--end col-->

                    <div class="col-xxl-3 col-md-3" <?php echo !in_array('combo_ecole',
                        session('InfosAction'))? "style='display:none;'" : '' ; ?>>
                        <div><label for="labelInput" class="form-label">Liste des écoles</label>
                            <?php $addUse = ['-1' => 'Sélectionnez un élément'];
                            $listetablis_id = $addUse + $listetablis_id->toArray(); ?>
                            {!! Form::select('etablis_id', $listetablis_id, session('etablis_idSess'), [
                            'id' => 'etablis_id',
                            'onchange' => 'refreshEcole()',
                            'class' => 'form-select allselect',
                            ]) !!}
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-3 col-md-3">
                        <div><label for="labelInput" class="form-label">Liste des Années</label>
                            <?php $addUse = ['' => 'Selectionnez un element'];
                            $listannee_id = $addUse + $listannee_id->toArray(); ?>
                            {!! Form::select('annee_id', $listannee_id, session('annee_idSess'), [
                            'id' => 'annee_id',
                            'onchange' => 'funcRecher()',
                            'class' => 'form-select allselect',
                            ]) !!}
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-3 col-md-3">
                        <div><label for="labelInput" class="form-label">Liste des Promotions</label>
                            <?php $addUse = ['' => 'Selectionnez un element'];
                            $listpromotion_id = $addUse + $listpromotion_id->toArray(); ?>
                            {!! Form::select('promotion_id', $listpromotion_id, session('promotion_idSess'), [
                            'id' => 'promotion_id',
                            'onchange' => 'funcRecher()',
                            'class' => 'form-select allselect',
                            ]) !!}
                        </div>
                    </div>
                    <!--end Recherche par defaut col-->
                    <div class="col-xxl-3 col-md-3">
                        <div><label for="placeholderInput" class="form-label">Rechercher </label>
                            {!! Form::text('query', '', [
                            'id' => 'SearchUSer',
                            'class' => 'form-control search ',
                            'onkeyup' => 'funcRecher()',
                            'autocomplete' => 'off',
                            'placeholder' => 'Rechercher...',
                            ]) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                @if (session()->has('success') || session()->has('error'))
                <div class="col-md-12 mt-2">
                    <div class="alert {!! session()->has('success') ? 'alert-success' : '' !!} {!! session()->has('error') ? 'alert-danger' : '' !!} alert-border-left alert-dismissible fade show"
                        role="alert"><i title="{!! session()->has('errorMsg') ? session()->get('errorMsg') : '' !!}"
                            class=" {!! session()->has('success') ? 'ri-notification-off-line' : 'ri-error-warning-line' !!} me-3 align-middle"></i>
                        <strong>Infos </strong> -
                        {!! session()->has('success') ? session()->get('success') : session()->get('error') !!}<button
                            type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif

            </div>

            <div class="card-body">
                <div id='dataRefresh' class="table-responsive table-card mb-4 m-2 giwuRefresh">
                    @include('frequenter.index-search')
                </div>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->

    <!--begin::delete-->
    <div>
        <div class="modal fade bs-example-modal-center" id="kt_delete_4" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered"></div>
        </div>
    </div>
    <div>
        <div class="modal fade bs-example-modal-center" id="confirmationModal" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered"></div>
        </div>
    </div>

@endsection

@section('JS_content')
    <script src="{{ url('assets/js/jquery.min.js') }}" type="text/javascript"></script>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.checkbox input[type="checkbox"]').change(function() {
                var id = $(this).data('id');
                var service = $(this).data('service');
                var isChecked = $(this).prop('checked');
                console.log('service name',service);
                console.log('id',id);
                console.log('isChecked',isChecked);
                $.ajax({
                    type: 'POST', 
                    url: '',
                    data: {
                        id: id,
                        service: service,
                        isChecked: isChecked
                    },
                    success: function(response) {
                    },
                    error: function(xhr, textStatus, errorThrown) {
                    }
                });
            });
        });

        $(document).ready(function() {
            $(".exporterXls").attr('href', '{{ url('frequenter/exporterExcel') }}');
            $(".exporterPdf").attr('href', '{{ url('frequenter/exporterPdf') }}');
            // Pagination
            $(document).on("click", ".pagination a", function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_page(page);
            });

            function fetch_page(page) {
                var dr = $("#formSearch").serialize();
                $.ajax({
                    url: "frequenter?page=" + page,
                    data: dr,
                    type: 'GET',
                    success: function(data) {
                        $('#dataRefresh').html(data);
                        $("html, body").animate({
                            scrollTop: 0
                        }, "fast");
                    }
                });
            }
        });

        //Fonction sur la recherche
        function funcRecher() {
            var filtreData = $("#formSearch").serialize();
            $(".exporterXls").attr('href', '{{ url('frequenter/exporterExcel') }}?' + filtreData);
            $(".exporterPdf").attr('href', '{{ url('frequenter/exporterPdf') }}?' + filtreData);
            $("div#dataRefresh").html('<h3 class="col-xs-12 text-center kt-subheader__title" style="padding-top: 3em;">' +
                '<span class="spinner-border flex-shrink-0" role="status"> <span class="visually-hidden"></span></span></h3>'
                );
            return $.ajax({
                url: '{{ url('/frequenter/') }}',
                data: filtreData,
                type: 'GET',
                success: function(e) {
                    $('#dataRefresh').html(e);
                },
                error: function(data) {
                    $('#dataRefresh').html(
                        '<div class="alert alert-danger" role="alert">Erreur dans la recherche!</div>');
                },
            });
        };
        
        $(document).on('click', '.btn-delete', function() {
            id = $(this).data("id");
            $.ajax({
                url: '{{ url('frequenter/AffichePopDelete/') }}/' + id,
                type: 'GET',
                dataType: 'html',
                success: function(code_html, statut) {
                    $("#kt_delete_4 .modal-dialog").html(code_html);
                    $("#kt_delete_4").modal('show');
                }
            });
        });

        $(document).on('click', '.btn-delete-promotion', function() {
            $.ajax({
                url: '{{ url('frequenter/AffichePopDeletePromo/') }}',
                type: 'GET',
                dataType: 'html',
                success: function(code_html, statut) {
                    $("#kt_delete_4 .modal-dialog").html(code_html);
                    $("#kt_delete_4").modal('show');
                }
            });
        });


       function f(e){
            var ecoleSelected = $('#etablis_id').val();
            var anneeSelected = $('#annee_id').val();
            var promotionSelected = $('#promotion_id').val();
            if (ecoleSelected==-1 || !anneeSelected || !promotionSelected) {
                e.preventDefault(); 
             //   window.location.href = "{{ url('frequenter/pop-up') }}";
             console.log('annee',anneeSelected) ;
                return    $.ajax({
                            url: "{{ url('frequenter/pop-up') }}", 
                            type: 'GET',
                            dataType: 'html',
                            success: function(code_html, statut) {
                                console.log("Succès AJAX", code_html  );
                                $("#confirmationModal .modal-dialog").html(code_html);
                                $("#confirmationModal").modal('show');
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                    console.error("Erreur AJAX : " + textStatus, errorThrown);
                                }

                        });
                        }
                    }
    </script>
@endsection