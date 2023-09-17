@extends('layouts.general')

@section('path_content')
    @if (sizeof($pathMenu) != 0)
        @for ($i = 0; $i < count($pathMenu); $i++)
            <li class="breadcrumb-item active"><a href="{{ $pathMenu[$i]['lien'] }}"
                    class="kt-subheader__breadcrumbs-link">{{ $pathMenu[$i]['titre'] }}</a></li>
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
                        @if (in_array('exporter_appeler', session('InfosAction')))
                            <div class="btn-group"><button type="button" class="btn btn-primary">Exporter</button>
                                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                    id="dropdownMenuReference" data-bs-toggle="dropdown" aria-expanded="false"
                                    data-bs-reference="parent"><span class="visually-hidden">Toggle Dropdown</span></button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                    <li><a class="dropdown-item exporterXls" target="_blank" href="#">Excel</a></li>
                                    <li><a class="dropdown-item exporterPdf" target="_blank" href="#">PDF</a></li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body border border-dashed border-end-0 border-start-0">
                {!! Form::open(['id' => 'formSearch', 'class' => '', 'method' => 'GET']) !!}
                <div class="row gy-4">
                    <!--end col-->
                    <div class="col-xxl-3 col-md-3" <?php echo !in_array('combo_ecole', session('InfosAction')) ? "style='display:none;'" : ''; ?>>
                        <div><label for="labelInput" class="form-label">Liste des écoles</label>
                            <?php $addUse = ['-1' => 'Sélectionnez un élément'];
                            $listetablis_id = $addUse + $listetablis_id->toArray(); ?>
                            {!! Form::select('etablis_id', $listetablis_id, session('etablis_idSess'), ['id' => 'etablis_id',
                                'onchange' => 'refreshEcole()','class' => 'form-select allselect']) !!}
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-3 col-md-3">
                        <div><label for="labelInput" class="form-label">Liste vos programmes</label>
                            <?php $addUse = ['' => 'Sélectionnez un élément'];
                            $listemploi_id = $addUse + $listemploi_id->toArray(); ?>
                            {!! Form::select('emploi_id', $listemploi_id, session('emploi_idSess'), ['id' => 'emploi_id','onchange' => 'funcRecher()','class' => 'form-select allselect']) !!}
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-3">
                        <div>
                            <label for="date_presence" class="form-label">Date de présence</label>
                            <input type="date" id="date_presence" onchange='funcRecher()' name="date_presence" class="form-control"
                                value="{{session('date_presenceSess')}}">
                        </div>
                    </div>
                    <!--end Recherche par defaut col-->
                    <div class="col-xxl-3 col-md-3">
                        <div><label for="placeholderInput" class="form-label">Rechercher </label>
                            {!! Form::text('query', '', [
                                'id' => 'SearchUSer','class' => 'form-control search ',
                                'onkeyup' => 'funcRecher()','autocomplete' => 'off',
                                'placeholder' => 'Rechercher...']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                @if (session()->has('success') || session()->has('error'))
                    <div class="col-md-12 mt-2">
                        <div class="alert {!! session()->has('success') ? 'alert-success' : '' !!} {!! session()->has('error') ? 'alert-danger' : '' !!} alert-border-left alert-dismissible fade show"
                            role="alert"><i title="{!! session()->has('errorMsg') ? session()->get('errorMsg') : '' !!}"
                                class=" {!! session()->has('success') ? 'ri-notification-off-line' : 'ri-error-warning-line' !!} me-3 align-middle"></i> <strong>Infos </strong> -
                            {!! session()->has('success') ? session()->get('success') : session()->get('error') !!}<button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button></div>
                    </div>
                @endif

            </div>

            <div class="card-body">
                <div id='dataRefresh' class="table-responsive table-card mb-4 m-2 giwuRefresh">@include('appeler.index-search')
                </div>
            </div>
        </div><!--end card-->
    </div><!--end col-->
    <!-- action -->
    <div>
        <div class="modal fade bs-example-modal-center" data-bs-backdrop="static" id="kt_action_4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog" >
            <div class="modal-dialog modal-dialog-scrollable"> <!-- modal-dialog-scrollable -->
                
            </div>
        </div>
    </div>
    <!-- action data-bs-backdrop="static" -->
@endsection

@section('JS_content')
    <script src="{{ url('assets/js/jquery.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".exporterXls").attr('href', '{{ url('appeler/exporterExcel') }}');
            $(".exporterPdf").attr('href', '{{ url('appeler/exporterPdf') }}');
            // Pagination
            $(document).on("click", ".pagination a", function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_page(page);
            });

            function fetch_page(page) {
                var dr = $("#formSearch").serialize();
                $.ajax({
                    url: "appeler?page=" + page,
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
            // var selectedDate = new Date(input.value);
            // if (selectedDate.getDay() === 6 || selectedDate.getDay() === 0) {
            // alert("Vous avez choisi un week-end !");
            //     }
            $(".exporterXls").attr('href', '{{ url('appeler/exporterExcel') }}?' + filtreData);
            $(".exporterPdf").attr('href', '{{ url('appeler/exporterPdf') }}?' + filtreData);
            $("div#dataRefresh").html('<h3 class="col-xs-12 text-center kt-subheader__title" style="padding-top: 3em;">' +
                '<span class="spinner-border flex-shrink-0" role="status"> <span class="visually-hidden"></span></span></h3>'
            );
            return $.ajax({
                url: '{{ url('/appeler/') }}',
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

        $(document).on('click', '.btn-confirmer', function() {
            id = $(this).data("id");
            let url_ = "{{ url('appeler/confirmer') }}/" + id;
            $.ajax({
                url: url_,
                type: 'GET',
                dataType: 'json',
                success: function(code_html, statut) {
                    if (code_html.response == '1') { // Ok
                        if (code_html.etat == true) {
                            $('#dochoix' + id).removeClass('btn-danger');
                            $('#dochoix' + id).addClass('btn-secondary');
                            $('#dochoix' + id).html('Présent');
                        } else if (code_html.etat == false) {
                            $('#dochoix' + id).removeClass('btn-secondary');
                            $('#dochoix' + id).addClass('btn-danger');
                            $('#dochoix' + id).html('Absent');
                        }
                        // alert(code_html.etat);
                    }
                }
            });
        });
        $(document).on('click', '.btn-action', function () {
			id = $(this).data("id");
			$.ajax({url : '{{ url("appeler/AffichePopAction/") }}/'+id,type : 'GET',dataType : 'html',
				success : function(code_html, statut){$("#kt_action_4 .modal-dialog").html(code_html);$("#kt_action_4").modal('show');}
			});
		});
    </script>

@endsection
