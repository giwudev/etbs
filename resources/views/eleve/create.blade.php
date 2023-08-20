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
					<form action="{{route('eleve.store')}}" method="post" id="form" class="row g-3 needs-validation" novalidate enctype='multipart/form-data'>
						@csrf()
							<div class="row">
							@if(session()->has('success') || session()->has('error'))<div class="col-md-12 mt-2"><div class="alert {!! session()->has('success') ? 'alert-success' : '' !!} {!! session()->has('error') ? 'alert-danger' : '' !!} alert-border-left alert-dismissible fade show" role="alert"><i title ="{!!session()->has('errorMsg')? session()->get('errorMsg') : '' !!}" class=" {!!session()->has('success') ? 'ri-notification-off-line' : 'ri-error-warning-line'!!} me-3 align-middle"></i> <strong>Infos </strong> - {!! session()->has('success') ? session()->get('success') : session()->get('error') !!}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div>@endif

							<div class="col-md-6">
								<div class="mb-3">
									<label for="nom_el" class="form-label">{!!trans('data.nom_el')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::text('nom_el','',["id"=>"nom_el","class"=>"form-control" ,"required"=>"required" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Nom" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="prenom_el" class="form-label">{!!trans('data.prenom_el')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::text('prenom_el','',["id"=>"prenom_el","class"=>"form-control" ,"required"=>"required" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Prenom" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="matricule_el" class="form-label">{!!trans('data.matricule_el')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::text('matricule_el','',["id"=>"matricule_el","class"=>"form-control" ,"required"=>"required" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Matricule" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="date_nais_el" class="form-label">{!!trans('data.date_nais_el')!!} </label>
									{!! Form::date('date_nais_el','',["id"=>"date_nais_el","class"=>"form-control"  ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Date naissance" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="sexe_el" class="form-label">{!!trans('data.sexe_el')!!} <strong style='color: red;'> *</strong></label>
									<?php $addsexe_el = array('' => 'Choisir', 'M' => 'Masculin', 'F' => 'Femnini');?>
									{!! Form::select('sexe_el',$addsexe_el ,null,["id"=>"sexe_el","class"=>"form-select allselect" ,"required"=>"required"]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="photo_el" class="form-label">{!!trans('data.photo_el')!!} </label>
									<input class="form-control" type="file" id="photo_el" name="photo_el" >
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="tuteur_el" class="form-label">{!!trans('data.tuteur_el')!!} </label>
									{!! Form::text('tuteur_el','',["id"=>"tuteur_el","class"=>"form-control"  ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Tuteur" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="email_el" class="form-label">{!!trans('data.email_el')!!} </label>
									{!! Form::text('email_el','',["id"=>"email_el","class"=>"form-control"  ,'autocomplete'=>'off' ,'placeholder'=>"Entrer E-mail" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="tel_el" class="form-label">{!!trans('data.tel_el')!!} </label>
									{!! Form::text('tel_el','',["id"=>"tel_el","class"=>"form-control"  ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Contact" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="ecole_id" class="form-label">{!!trans('data.ecole_id')!!} <strong style='color: red;'> *</strong></label>
									<?php $addUse = array(''=>'S&eacute;lectionnez un &eacute;l&eacute;ment'); $listecole_id = $addUse + $listecole_id->toArray();?>
									{!! Form::select('ecole_id',$listecole_id ,session('ecole_idSess'),["id"=>"ecole_id","class"=>"form-select allselect" ,"required"=>"required"]) !!}
								</div>
							</div>
							<div class="col-12">
								<div class="text-end">
									<a href="{{route('eleve.index')}}" class="btn btn-outline-dark waves-effect mr-10">Fermer</a>
									@if(in_array('add_eleve',session('InfosAction')))
										<button type="submit" class="btn btn-primary btn-label right"><i class="ri-add-line label-icon align-middle fs-16 ms-2"></i>Ajouter</button>
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
