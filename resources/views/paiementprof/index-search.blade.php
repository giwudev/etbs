<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@if(count($list) != 0)
	<table class="table table-striped table-bordered table-nowrap">
		<thead><tr>
			<th scope="col" class="text-center">{!!trans('data.datedebut')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.datefin')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.montant_total')!!}</th>
			<th scope="col" class="text-center" >{!!trans('data.payer_bool')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.init_id')!!}</th>
			@if(in_array('update_paiementprof',session('InfosAction')) || in_array('delete_paiementprof',session('InfosAction')) )
				<th class="text-center"> Actions</th>
			@endif
		</tr></thead>
		<tbody>
			@foreach($list as $listgiwu)
				<tr>
					<td class="text-center">{{date('d/m/Y',strtotime($listgiwu->datedebut))}}</td>
					<td class="text-center">{{date('d/m/Y',strtotime($listgiwu->datefin))}}</td>
					<td style ='text-align:right' >{{strrev(wordwrap(strrev(intval($listgiwu->montant_total)), 3, ' ', true))}}</td>
					<td class="text-center">
						@if($listgiwu->payer_bool == 1) <span class="badge bg-success">Payer</span> 
						@else <span class="badge bg-danger">Non payé</span> 
						@endif
					</td>
					<td>{!! isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found') !!}</td>
					@if(in_array('update_paiementprof',session('InfosAction')) || in_array('delete_paiementprof',session('InfosAction')) )
						<td class="text-center">
							@if(in_array('update_paiementprof',session('InfosAction')))
								<a href="{{route('paiementprof.edit',$listgiwu->id_paie)}}" title='Modifier' class="btn btn-success btn-sm  waves-effect waves-light"><i class="ri-edit-2-line"></i></a>
							@endif
							@if(in_array('delete_paiementprof',session('InfosAction')))
								<button type="button"  title='Supprimer' data-id="{{$listgiwu->id_paie}}" class="btn btn-danger btn-sm  waves-effect waves-light btn-delete" data-bs-toggle="modal" ><i class="ri-delete-bin-6-line"></i></button>
							@endif
							@if(in_array('update_paiementprof', session('InfosAction')))
                            <form action="{{ route('paiementprof.togglePayment', $listgiwu->id_paie) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-warning btn-sm waves-effect waves-light" title="Changer l'état de paiement">
                                    <i class="ri-check-line"></i> Payer
                                </button>
                            </form>
                        @endif
						</td>
					@endif
				</tr>
			@endforeach
		</tbody>
	</table>
	
	{!! $list->appends(['query'=>(isset($_GET['query'])?$_GET['query']:'') ])->links() !!}
@else
	<div Class="alert alert-info"><strong>Info! </strong> {!!trans('data.AucunInfosTrouve')!!} </div>
@endif
