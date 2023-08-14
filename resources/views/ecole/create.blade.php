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
					<form action="{{route('ecole.store')}}" method="post" id="form" class="row g-3 needs-validation" novalidate >
						@csrf()
							<div class="row">
							@if(session()->has('success') || session()->has('error'))<div class="col-md-12 mt-2"><div class="alert {!! session()->has('success') ? 'alert-success' : '' !!} {!! session()->has('error') ? 'alert-danger' : '' !!} alert-border-left alert-dismissible fade show" role="alert"><i title ="{!!session()->has('errorMsg')? session()->get('errorMsg') : '' !!}" class=" {!!session()->has('success') ? 'ri-notification-off-line' : 'ri-error-warning-line'!!} me-3 align-middle"></i> <strong>Infos </strong> - {!! session()->has('success') ? session()->get('success') : session()->get('error') !!}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div>@endif

							<div class="col-md-6">
								<div class="mb-3">
									<label for="nom_eco" class="form-label">{!!trans('data.nom_eco')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::text('nom_eco','',["id"=>"nom_eco","class"=>"form-control" ,"required"=>"required" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Nom" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="sigle_eco" class="form-label">{!!trans('data.sigle_eco')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::text('sigle_eco','',["id"=>"sigle_eco","class"=>"form-control" ,"required"=>"required" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Sigle" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="adres_eco" class="form-label">{!!trans('data.adres_eco')!!} </label>
									{!! Form::text('adres_eco','',["id"=>"adres_eco","class"=>"form-control"  ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Adresse" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="ville_eco" class="form-label">{!!trans('data.ville_eco')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::text('ville_eco','',["id"=>"ville_eco","class"=>"form-control" ,"required"=>"required" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Ville" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="CodePos_eco" class="form-label">{!!trans('data.CodePos_eco')!!} </label>
									{!! Form::text('CodePos_eco','',["id"=>"CodePos_eco","class"=>"form-control"  ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Code postal" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="pays_eco" class="form-label">{!!trans('data.pays_eco')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::text('pays_eco','',["id"=>"pays_eco","class"=>"form-control" ,"required"=>"required" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Pays" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="tel_eco" class="form-label">{!!trans('data.tel_eco')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::text('tel_eco','',["id"=>"tel_eco","class"=>"form-control" ,"required"=>"required" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Contact" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="email_eco" class="form-label">{!!trans('data.email_eco')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::text('email_eco','',["id"=>"email_eco","class"=>"form-control" ,"required"=>"required" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer E-mail" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="directeur_eco" class="form-label">{!!trans('data.directeur_eco')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::text('directeur_eco','',["id"=>"directeur_eco","class"=>"form-control" ,"required"=>"required" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Directeur" ]) !!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="niveau_educ_eco" class="form-label">{!!trans('data.niveau_educ_eco')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::select('niveau_educ_eco',trans('entite.niveau'),null,["id"=>"niveau_educ_eco","class"=>"form-select allselect" ,"required"=>"required"]) !!}
								</div>
							</div>
							<div class="col-12">
								<div class="text-end">
									<a href="{{route('ecole.index')}}" class="btn btn-outline-dark waves-effect mr-10">Fermer</a>
									@if(in_array('add_ecole',session('InfosAction')))
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
