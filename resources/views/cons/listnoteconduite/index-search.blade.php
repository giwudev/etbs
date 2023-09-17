<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@if(count($list) != 0)
	<table class="table table-striped table-bordered table-nowrap">
		<thead><tr>
			<th scope="col" class="text-center">N°</th>
			<th scope="col" class="text-center">{!!trans('data.eleve_id')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.nbre_heure_abs')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.nbre_heure_justifie')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.nbre_heure_non_justifie')!!}</th>
			<th scope="col" class="text-center">{!!trans('data.conduite')!!}</th>
		</tr></thead>
		<tbody>
			<?php $i=1;?>
			@foreach($list as $listgiwu)
				<?php
					$nbreAbs = \App\Models\Appeler::nbre_heure_abs($listgiwu->eleve_id,$listgiwu->promotion_id );
				?>
				<tr>
					<td class="text-center">{{$i++}}</td>
					<td>{!! isset($listgiwu->eleve)
							? $listgiwu->eleve->nom_el . ' ' . $listgiwu->eleve->prenom_el
							: trans('data.not_found') !!}</td>
					<td  class="text-center">{{$nbreAbs." H"}} </td>
					<td  class="text-center">{{\App\Models\Appeler::nbre_heure_abs_justifier($listgiwu->eleve_id,$listgiwu->promotion_id )." H"}} </td>
					<td  class="text-center">{{\App\Models\Appeler::nbre_heure_abs_non_justifier($listgiwu->eleve_id,$listgiwu->promotion_id )." H"}} </td>
					<td  class="text-center">{{\App\Models\Appeler::note_conduite($nbreAbs)}} </td>
				</tr>
			@endforeach
		</tbody>
	</table>
	
	{!! $list->appends(['query'=>(isset($_GET['query'])?$_GET['query']:'') ])->links() !!}
@else
	<div Class="alert alert-info"><strong>Info! </strong> {!!trans('data.AucunInfosTrouve')!!} </div>
@endif
