<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@if(count($list) != 0)
	<table class="table table-striped table-bordered table-nowrap">
		<thead><tr>
			<th scope="col" >{!!trans('data.nom_eco')!!}</th>
			<th scope="col" >{!!trans('data.sigle_eco')!!}</th>
			<!-- <th scope="col" >{!!trans('data.adres_eco')!!}</th> -->
			<th scope="col" >{!!trans('data.ville_eco')!!}</th>
			<!-- <th scope="col" >{!!trans('data.CodePos_eco')!!}</th> -->
			<!-- <th scope="col" >{!!trans('data.pays_eco')!!}</th> -->
			<th scope="col" >{!!trans('data.tel_eco')!!}</th>
			<!-- <th scope="col" >{!!trans('data.email_eco')!!}</th> -->
			<th scope="col" >{!!trans('data.directeur_eco')!!}</th>
			<th scope="col" >{!!trans('data.niveau_educ_eco')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.init_id')!!}</th>
			@if(in_array('update_ecole',session('InfosAction')) || in_array('delete_ecole',session('InfosAction')) )
				<th class="text-center"> Actions</th>
			@endif
		</tr></thead>
		<tbody>
			@foreach($list as $listgiwu)
				<tr>
					<td>{!! $listgiwu->nom_eco !!}</td>
					<td>{!! $listgiwu->sigle_eco !!}</td>
					<!-- <td>{!! $listgiwu->adres_eco !!}</td> -->
					<td>{!! $listgiwu->ville_eco !!}</td>
					<!-- <td>{!! $listgiwu->CodePos_eco !!}</td> -->
					<!-- <td>{!! $listgiwu->pays_eco !!}</td> -->
					<td>{!! $listgiwu->tel_eco !!}</td>
					<!-- <td>{!! $listgiwu->email_eco !!}</td> -->
					<td>{!! $listgiwu->directeur_eco !!}</td>
					<td>{!! trans('entite.niveau')[$listgiwu->niveau_educ_eco] !!}</td>
					<td>{!! isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found') !!}</td>
					@if(in_array('update_ecole',session('InfosAction')) || in_array('delete_ecole',session('InfosAction')) )
						<td class="text-center">
							@if(in_array('update_ecole',session('InfosAction')))
								<a href="{{route('ecole.edit',$listgiwu->id_eco)}}" title='Modifier' class="btn btn-success btn-sm  waves-effect waves-light"><i class="ri-edit-2-line"></i></a>
							@endif
							@if(in_array('delete_ecole',session('InfosAction')))
								<button type="button"  title='Supprimer' data-id="{{$listgiwu->id_eco}}" class="btn btn-danger btn-sm  waves-effect waves-light btn-delete" data-bs-toggle="modal" ><i class="ri-delete-bin-6-line"></i></button>
							@endif
					@endif
				</tr>
			@endforeach
		</tbody>
	</table>
	
	{!! $list->appends(['query'=>(isset($_GET['query'])?$_GET['query']:'') ])->links() !!}
@else
	<div Class="alert alert-info"><strong>Info! </strong> {!!trans('data.AucunInfosTrouve')!!} </div>
@endif
