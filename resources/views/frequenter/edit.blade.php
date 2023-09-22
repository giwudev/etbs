@extends('layouts.general')

@section('path_content')
	@if(sizeof($pathMenu) != 0)
		@for($i=0; $i < count($pathMenu); $i++)
			<li class="breadcrumb-item active"><a href="{{$pathMenu[$i]['lien']}}" class="kt-subheader__breadcrumbs-link">{{$pathMenu[$i]['titre']}}</a></li>
		@endfor
	@endif
@stop

@section('content')

	<div class="col-lg-12">
		<div class="card">
			<div class="card-header align-items-center d-flex">
				<h4 class="card-title mb-0 flex-grow-1">{{$titre}}</h4>
				<div class="flex-shrink-0"><div class="form-check form-switch form-switch-right form-switch-md"><i class="{{$icone}}"></i></div></div>
			</div><!-- end card header -->
			<div class="card-body"><p class="text-muted"></p>
				<div class="live-preview"><strong><div class="msgAjouter"></div></strong>
					<form action="{{route('frequenter.update',$item->id_freq)}}" method="post" id="form" class="row g-3 needs-validation" novalidate >
						@csrf()
						@method('PATCH')
							<div class="row">
							@if(session()->has('success') || session()->has('error'))<div class="col-md-12 mt-2"><div class="alert {!! session()->has('success') ? 'alert-success' : '' !!} {!! session()->has('error') ? 'alert-danger' : '' !!} alert-border-left alert-dismissible fade show" role="alert"><i title ="{!!session()->has('errorMsg')? session()->get('errorMsg') : '' !!}" class=" {!!session()->has('success') ? 'ri-notification-off-line' : 'ri-error-warning-line'!!} me-3 align-middle"></i> <strong>Infos </strong> - {!! session()->has('success') ? session()->get('success') : session()->get('error') !!}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div>@endif
							<div class="col-md-6">
								<div class="mb-3">
									<label for="eleve_id" class="form-label">{!!trans('data.eleve_id')!!} <strong style='color: red;'> *</strong></label>
									<select name="eleve_id" id="eleve_id" class="form-select allselect" required="required">
										<option value="">Sélectionnez un élément</option>
											<option selected value="{{ $item->eleve_id}}">{{ $item->eleve->nom_el.' '.$item->eleve->prenom_el}}</option>
									</select>
								</div>
							</div>
							<div class="col-md-6" style="display:none">
								<div class="mb-3">
									<label for="promotion_id" class="form-label">{!!trans('data.promotion_id')!!} <strong style='color: red;'> *</strong></label>
									<?php $addUse = array(''=>'S&eacute;lectionnez un &eacute;l&eacute;ment'); $listpromotion_id = $addUse + $listpromotion_id->toArray();?>
									{!! Form::select('promotion_id',$listpromotion_id ,$item->promotion_id,["id"=>"promotion_id","class"=>"form-select allselect" ,"required"=>"required"]) !!}
								</div>
							</div>
							<div class="col-md-12">
								<div class="my-3">
									<label for="eleve_id" class="form-label">Souscription pour l'élève <strong style='color: red;'> *</strong></label>
									<div class="form-check form-switch form-switch-danger my-2">
										<input class="form-check-input" type="checkbox" name="mail" role="switch" id="SwitchCheck5" {{ $item->send_mail ? 'checked' : '' }}>
										<label class="form-check-label" for="SwitchCheck5">Par Mail</label>
									</div>
									<div class="form-check form-switch form-switch-info my-2">
										<input class="form-check-input" type="checkbox" name="whatsapp" role="switch" id="SwitchCheck6" {{ $item->send_whatsapp ? 'checked' : '' }}>
										<label class="form-check-label" for="SwitchCheck6">Par WhatsApp</label>
									</div>
									<div class="form-check form-switch form-switch-dark my-2">
										<input class="form-check-input" type="checkbox" name="sms" role="switch" id="SwitchCheck7" {{ $item->send_sms ? 'checked' : '' }}>
										<label class="form-check-label" for="SwitchCheck7">Par SMS</label>
									</div>
								</div>
							</div>

							<div class="col-12">
								<div class="text-end">
									<a href="{{route('frequenter.index')}}" class="btn btn-outline-dark waves-effect mr-10">Fermer</a>
									@if(in_array('update_frequenter',session('InfosAction')))
										<button type="submit" class="btn btn-success btn-label right"><i class="ri-edit-2-line label-icon align-middle fs-16 ms-2"></i>Modifier</button>
									@endif
								</div>
							</div>
						</div><!--end row-->
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('JS_content')
    <script src="{{ url('assets/js/jquery.min.js') }}" type="text/javascript"></script>
@endsection