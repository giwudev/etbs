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
		<div class="card">
        <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{ $titre . ' ' . $promotion->libelle_pro }}</h4>
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-success btn-label right btn-action waves-effect waves-light btn-action" data-toggle="modal"  data-id="{{ $promotion->id_pro }}"><i class="ri-file-excel-2-fill label-icon align-middle fs-16 ms-2"></i>Importation Excel</button>
                 </div>
             </div><!-- end card header -->
			<div class="card-body"><p class="text-muted"></p>
				<div class="live-preview"><strong><div class="msgAjouter"></div></strong>
                    <form action="{{ route('frequenter.store') }}" method="post" id="form" class="row g-3 needs-validation" novalidate>
						@csrf()
							<div class="row">
							@if(session()->has('success') || session()->has('error'))<div class="col-md-12 mt-2"><div class="alert {!! session()->has('success') ? 'alert-success' : '' !!} {!! session()->has('error') ? 'alert-danger' : '' !!} alert-border-left alert-dismissible fade show" role="alert"><i title ="{!!session()->has('errorMsg')? session()->get('errorMsg') : '' !!}" class=" {!!session()->has('success') ? 'ri-notification-off-line' : 'ri-error-warning-line'!!} me-3 align-middle"></i> <strong>Infos </strong> - {!! session()->has('success') ? session()->get('success') : session()->get('error') !!}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div>@endif

							<div class="col-md-6">
                                <div class="mb-3">
                                    <label for="eleve_id" class="form-label">{!! trans('data.eleve_id') !!} <strong style='color: red;'> *</strong></label>
                                    {!! Form::select('eleve_id', $listeleve_id, null, [
                                    'id' => 'eleve_id',
                                    'class' => 'form-select allselect',
                                    'required' => 'required',
                                    ]) !!}
                                </div>
                            </div>
							<div class="col-md-12">
                                <div class="my-3">
                                    <label for="eleve_id" class="form-label">Souscription pour l'élève <strong style='color: red;'> *</strong></label>
                                    <div class="form-check form-switch form-switch-danger my-2">
                                        <input class="form-check-input" type="checkbox" name="mail" role="switch" id="SwitchCheck5">
                                        <label class="form-check-label" for="SwitchCheck5">Par Mail</label>
                                    </div>
                                    <div class="form-check form-switch form-switch-info my-2">
                                        <input class="form-check-input" type="checkbox" name="whatsapp" role="switch" id="SwitchCheck6">
                                        <label class="form-check-label" for="SwitchCheck6">Par WhatsApp</label>
                                    </div>
                                    <div class="form-check form-switch form-switch-dark my-2">
                                        <input class="form-check-input" type="checkbox" name="sms" role="switch" id="SwitchCheck7">
                                        <label class="form-check-label" for="SwitchCheck7">Par SMS</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" style="display:none">
                                <div class="mb-3">
                                    <label for="promotion_id" class="form-label">{!! trans('data.promotion_id') !!} <strong style='color: red;'> *</strong></label>
                                    <?php $addUse = ['' => 'S&eacute;lectionnez un &eacute;l&eacute;ment'];
                                    $listpromotion_id = $addUse + $listpromotion_id->toArray(); ?>
                                    {!! Form::select('promotion_id', $listpromotion_id, session('promotion_idSess'), [
                                    'id' => 'promotion_id',
                                    'class' => 'form-select allselect',
                                    'required' => 'required',
                                    ]) !!}
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="text-end">
                                    <a href="{{ route('frequenter.index') }}" class="btn btn-outline-dark waves-effect mr-10">Fermer</a>
                                    @if (in_array('add_frequenter', session('InfosAction')))
                                    <button type="submit" class="btn btn-primary btn-label right"><i class="ri-add-line label-icon align-middle fs-16 ms-2"></i>Ajouter</button>
                                    @endif
                                </div>
                            </div>
						</div><!--end row-->
					</form>
				</div>
                <div class="modal fade bs-example-modal-center" data-bs-backdrop="static" id="kt_action_4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog">
                    <div class="modal-dialog modal-dialog-scrollable"> 

                    </div>
                </div>
			</div>
		</div>
	</div>
      <!--<div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{ $titre . ' ' . $promotion->libelle_pro }}</h4>
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-secondary btn-label right btn-action waves-effect waves-light btn-action"data-toggle="modal"  data-id="{{ $promotion->id_pro }}"><i class="ri-file-excel-2-fill label-icon align-middle fs-16 ms-2"></i>Importation Excel</button>
                 </div>
             </div>
            </div>

            
           <div class="card-body">
                <p class="text-muted"></p>
                <div class="live-preview"><strong>
                        <div class="msgAjouter"></div>
                    </strong>
                    <form action="{{ route('frequenter.store') }}" method="post" id="form" class="row g-3 needs-validation" novalidate>
                        @csrf()
                        <div class="row">
                            @if (session()->has('success') || session()->has('error'))
                            <div class="col-md-12 mt-2">
                                <div class="alert {!! session()->has('success') ? 'alert-success' : '' !!} {!! session()->has('error') ? 'alert-danger' : '' !!} alert-border-left alert-dismissible fade show" role="alert"><i title="{!! session()->has('errorMsg') ? session()->get('errorMsg') : '' !!}" class=" {!! session()->has('success') ? 'ri-notification-off-line' : 'ri-error-warning-line' !!} me-3 align-middle"></i> <strong>Infos </strong>
                                    - {!! session()->has('success') ? session()->get('success') : session()->get('error') !!}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                            </div>
                            @endif

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="eleve_id" class="form-label">{!! trans('data.eleve_id') !!} <strong style='color: red;'> *</strong></label>
                                    {!! Form::select('eleve_id', $listeleve_id, null, [
                                    'id' => 'eleve_id',
                                    'class' => 'form-select allselect',
                                    'required' => 'required',
                                    ]) !!}
                                </div>
                            </div>

                            <div class="col-md-6" style="display:none">
                                <div class="mb-3">
                                    <label for="promotion_id" class="form-label">{!! trans('data.promotion_id') !!} <strong style='color: red;'> *</strong></label>
                                    <?php /*$addUse = ['' => 'S&eacute;lectionnez un &eacute;l&eacute;ment'];
                                    $listpromotion_id = $addUse + $listpromotion_id->toArray(); */?>
                                    {!! Form::select('promotion_id', $listpromotion_id, session('promotion_idSess'), [
                                    'id' => 'promotion_id',
                                    'class' => 'form-select allselect',
                                    'required' => 'required',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="text-end">
                                    <a href="{{ route('frequenter.index') }}" class="btn btn-outline-dark waves-effect mr-10">Fermer</a>
                                    @if (in_array('add_frequenter', session('InfosAction')))
                                    <button type="submit" class="btn btn-primary btn-label right"><i class="ri-add-line label-icon align-middle fs-16 ms-2"></i>Ajouter</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div> 
            <div>
                <div class="modal fade bs-example-modal-center" data-bs-backdrop="static" id="kt_action_4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog">
                    <div class="modal-dialog modal-dialog-scrollable"> 

                    </div>
                </div>
            </div>
        </div>
    </div>
                                    -->
    @endsection


    @section('JS_content')
    <script src="{{ url('assets/js/jquery.min.js') }}" type="text/javascript"></script>
     <script type="text/javascript">
     /*  $(document).on('click', '.btn-action', function() {
            id = $(this).data("id");
            $.ajax({
                url: '{{ url('appeler/AffichePopAction/') }}/' + id,
                type: 'GET',
                dataType: 'html',
                success: function(code_html, statut) {
                    $("#kt_action_4 .modal-dialog").html(code_html);
                    $("#kt_action_4").modal('show');
                }
            });
        }); */

    $(document).on('click', '.btn-action', function() {
    id = $(this).data("id");
    $.ajax({
        url: '{{ url("frequenter/AffichePopAction/") }}/' + id,
        type: 'GET',
        dataType: 'html',
        success: function(code_html, statut) {
            $("#kt_action_4 .modal-dialog").html(code_html);
            $("#kt_action_4").modal('show');
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText); 
        }
    });
});

    </script>
    @endsection