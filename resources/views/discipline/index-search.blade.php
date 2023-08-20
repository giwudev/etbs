<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@if(count($list) != 0)
	<table class="table table-striped table-bordered table-nowrap">
		<thead><tr>
			<th scope="col" >{!!trans('data.code_disci')!!}</th>
			<th scope="col" >{!!trans('data.libelle_disci')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.ecole_id')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.init_id')!!}</th>
			@if(in_array('update_discipline',session('InfosAction')) || in_array('delete_discipline',session('InfosAction')) )
				<th class="text-center"> Actions</th>
			@endif
		</tr></thead>
		<tbody>
			@foreach($list as $listgiwu)
				<tr>
					<td>{!! $listgiwu->code_disci !!}</td>
					<td>{!! $listgiwu->libelle_disci !!}</td>
					<td>{!! isset($listgiwu->ecole) ? $listgiwu->ecole->nom_eco : trans('data.not_found') !!}</td>
					<td>{!! isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found') !!}</td>
					@if(in_array('update_discipline',session('InfosAction')) || in_array('delete_discipline',session('InfosAction')) )
						<td class="text-center">
							@if(in_array('update_discipline',session('InfosAction')))
								<a href="{{route('discipline.edit',$listgiwu->id_disci)}}" title='Modifier' class="btn btn-success btn-sm  waves-effect waves-light"><i class="ri-edit-2-line"></i></a>
							@endif
							@if(in_array('delete_discipline',session('InfosAction')))
								<button type="button"  title='Supprimer' data-id="{{$listgiwu->id_disci}}" class="btn btn-danger btn-sm  waves-effect waves-light btn-delete" data-bs-toggle="modal" ><i class="ri-delete-bin-6-line"></i></button>
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
