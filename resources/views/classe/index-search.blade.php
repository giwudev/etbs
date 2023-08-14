<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@if(count($list) != 0)
	<table class="table table-striped table-bordered table-nowrap">
		<thead><tr>
			<th scope="col" >{!!trans('data.libelle_clas')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.annee_id')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.init_id')!!}</th>
			@if(in_array('update_classe',session('InfosAction')) || in_array('delete_classe',session('InfosAction')) )
				<th class="text-center"> Actions</th>
			@endif
		</tr></thead>
		<tbody>
			@foreach($list as $listgiwu)
				<tr>
					<td>{!! $listgiwu->libelle_clas !!}</td>
					<td>{!! isset($listgiwu->anneesco) ? $listgiwu->anneesco->annee_debut.' - '.$listgiwu->anneesco->annee_fin : trans('data.not_found') !!}</td>
					<td>{!! isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found') !!}</td>
					@if(in_array('update_classe',session('InfosAction')) || in_array('delete_classe',session('InfosAction')) )
						<td class="text-center">
							@if(in_array('update_classe',session('InfosAction')))
								<a href="{{route('classe.edit',$listgiwu->id_clas)}}" title='Modifier' class="btn btn-success btn-sm  waves-effect waves-light"><i class="ri-edit-2-line"></i></a>
							@endif
							@if(in_array('delete_classe',session('InfosAction')))
								<button type="button"  title='Supprimer' data-id="{{$listgiwu->id_clas}}" class="btn btn-danger btn-sm  waves-effect waves-light btn-delete" data-bs-toggle="modal" ><i class="ri-delete-bin-6-line"></i></button>
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
