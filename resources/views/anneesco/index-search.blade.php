<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@if(count($list) != 0)
	<table class="table table-striped table-bordered table-nowrap">
		<thead><tr>
			<!-- <th scope="col" class="text-center">{!!trans('data.annee_debut')!!}</th> -->
			<th scope="col" class="text-center">{!!trans('data.libelle_annee')!!}</th>
			<th scope="col" >{!!trans('data.statut_annee')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.init_id')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.etablis_id')!!}</th>
			@if(in_array('update_anneesco',session('InfosAction')) || in_array('delete_anneesco',session('InfosAction')) )
				<th class="text-center"> Actions</th>
			@endif
		</tr></thead>
		<tbody>
			@foreach($list as $listgiwu)
				<tr>
					<!-- <td style ='text-align:right' >{{strrev(wordwrap(strrev(intval($listgiwu->annee_debut)), 3, ' ', true))}}</td> -->
					<td class="text-center" >{{$listgiwu->annee_debut.' - '.$listgiwu->annee_fin}}</td>
					<td class="text-center">
						@if($listgiwu->statut_annee == 'a')<span class="badge bg-success">{{trans('entite.statutanne')[$listgiwu->statut_annee]}}</span> @else <span class="badge bg-danger">{{trans('entite.statutanne')[$listgiwu->statut_annee]}}</span> @endif
					</td>
					<td>{!! isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found') !!}</td>
					<td>{!! isset($listgiwu->ecole) ? $listgiwu->ecole->sigle_eco : trans('data.not_found') !!}</td>
					@if(in_array('update_anneesco',session('InfosAction')) || in_array('delete_anneesco',session('InfosAction')) )
						<td class="text-center">
							@if(in_array('update_anneesco',session('InfosAction')))
								<a href="{{route('anneesco.edit',$listgiwu->id_annee)}}" title='Modifier' class="btn btn-success btn-sm  waves-effect waves-light"><i class="ri-edit-2-line"></i></a>
							@endif
							@if(in_array('delete_anneesco',session('InfosAction')))
								<button type="button"  title='Supprimer' data-id="{{$listgiwu->id_annee}}" class="btn btn-danger btn-sm  waves-effect waves-light btn-delete" data-bs-toggle="modal" ><i class="ri-delete-bin-6-line"></i></button>
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
