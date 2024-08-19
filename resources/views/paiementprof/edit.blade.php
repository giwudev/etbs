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
					<form action="{{route('paiementprof.update',$item->id_paie)}}" method="post" id="form" class="row g-3 needs-validation" novalidate >
						@csrf()
						@method('PATCH')
							<div class="row">
							@if(session()->has('success') || session()->has('error'))<div class="col-md-12 mt-2"><div class="alert {!! session()->has('success') ? 'alert-success' : '' !!} {!! session()->has('error') ? 'alert-danger' : '' !!} alert-border-left alert-dismissible fade show" role="alert"><i title ="{!!session()->has('errorMsg')? session()->get('errorMsg') : '' !!}" class=" {!!session()->has('success') ? 'ri-notification-off-line' : 'ri-error-warning-line'!!} me-3 align-middle"></i> <strong>Infos </strong> - {!! session()->has('success') ? session()->get('success') : session()->get('error') !!}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div>@endif

							<div class="col-md-6">
								<div class="mb-3">
									<label for="id_prof" class="form-label">{!!trans('data.id_prof')!!} <strong style='color: red;'> *</strong></label>
									<?php $addUse = array(''=>'S&eacute;lectionnez un &eacute;l&eacute;ment'); $listid_prof = $addUse + $listid_prof->toArray();?>
									{!! Form::select('id_prof',$listid_prof ,$item->id_prof,["id"=>"id_prof","class"=>"form-select allselect" ,"required"=>"required"]) !!}
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label for="datedebut" class="form-label">{!!trans('data.datedebut')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::date('datedebut',$item->datedebut,["id"=>"datedebut","class"=>"form-control" ,"required"=>"required" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Date debut" ]) !!}
								</div>
							</div>
							<div class="col-md-3">
								<div class="mb-3">
									<label for="datefin" class="form-label">{!!trans('data.datefin')!!} <strong style='color: red;'> *</strong></label>
									{!! Form::date('datefin',$item->datefin,["id"=>"datefin","class"=>"form-control" ,"required"=>"required" ,'autocomplete'=>'off' ,'placeholder'=>"Entrer Date fin" ]) !!}
								</div>
							</div>
							
						</div><!--end row-->
						<div class="row">
							<div class="col-12">
								<table class="table table-bordered" id="paiementTable">
									<thead>
										<tr>
											<th>N°</th>
											<th>Description</th>
											<th class="text-center">Quantité</th>
											<th class="text-center">Prix</th>
											<th class="text-center">Montant</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										<!-- Ligne vide pour l'ajout -->
										@foreach($paiements as $index => $paiement)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><input type="text" name="description[]" class="form-control" value="{{ $paiement->description }}" required></td>
                                            <td><input type="number" name="qte[]" class="form-control" value="{{ $paiement->qte }}" required oninput="calculateAmount(this)"></td>
                                            <td><input type="number" name="PrixUnitaire[]" class="form-control" value="{{ $paiement->PrixUnitaire }}" required oninput="calculateAmount(this)"></td>
                                            <td><input type="number" name="montant[]" class="form-control" value="{{ $paiement->montant }}" readonly></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-danger btn-sm waves-effect waves-light" onclick="removeRow(this)"><i class="ri-delete-bin-6-line"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
									</tbody>
								</table>
							</div>
						</div>
						<!-- end tableau des paiements -->
						<!-- Bouton pour valider toutes les lignes -->
						<div class="text-end mt-3">
							</div>
							<div class="align-items-center d-flex">
								<h4 class="mb-0 flex-grow-1">
								<button type="button" class="btn btn-secondary" onclick="addRow()">Ajouter une ligne</button>
							</h4>
							<div class="flex-shrink-0">
								<a href="{{route('paiementprof.index')}}" class="btn btn-outline-dark waves-effect mr-10">Fermer</a>
								<button type="submit" class="btn btn-success">Modifier</button>
							</div>
						</div><!-- end card header -->
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection


@section('JS_content')
    <script src="{{ url('assets/js/jquery.min.js') }}" type="text/javascript"></script>
	<script>
		function addRow() {
			let table = document.getElementById('paiementTable').getElementsByTagName('tbody')[0];
			let rowCount = table.rows.length;
			let row = table.insertRow(rowCount);
			row.innerHTML = `
				<tr class="text-center">
					<td>${rowCount + 1}</td>
					<td><input type="text" name="description[]" class="form-control" required></td>
					<td><input type="number" name="qte[]" class="form-control" required oninput="calculateAmount(this)"></td>
					<td><input type="number" name="PrixUnitaire[]" class="form-control" required oninput="calculateAmount(this)"></td>
					<td><input type="number" name="montant[]" class="form-control" readonly></td>
					<td class="text-center"><button type="button" class="btn btn-danger btn-sm  waves-effect waves-light" onclick="removeRow(this)"><i class="ri-delete-bin-6-line"></i></button></td>
				</tr>
			`;
		}

		function removeRow(button) {
			let row = button.parentNode.parentNode;
			row.parentNode.removeChild(row);
			updateRowNumbers();
		}

		function updateRowNumbers() {
			let table = document.getElementById('paiementTable').getElementsByTagName('tbody')[0];
			for (let i = 0; i < table.rows.length; i++) {
				table.rows[i].cells[0].innerHTML = i + 1;
			}
		}

		function calculateAmount(input) {
			let row = input.parentNode.parentNode;
			let qty = row.cells[2].getElementsByTagName('input')[0].value;
			let price = row.cells[3].getElementsByTagName('input')[0].value;
			row.cells[4].getElementsByTagName('input')[0].value = qty * price;
		}
		
	</script>
@endsection