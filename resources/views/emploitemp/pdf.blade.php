<title>{{Config('app.name') }} | Emploi du temps</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
{!!trans('data.stylePdf')!!} 
<div class="footer"><i>{!!trans('data.signaturePdf')!!} <span class="pagenum"></span> </i></div>

@if(count($list) != 0)
	<div><h3 style="text-align:center;">Emploi du temps {{$type}}<br>
		@if(!empty($_GET['query']))
			Recherche : {{$_GET['query']}}<br>
		@endif
	</h3></div>

	<table class="table" style="font-size:15px; width:100%;">
		<tr>
			<th class="th" >{!!trans('data.id_empl')!!}</th>
			<th class="th" >{!!trans('data.heure_debut')!!}</th>
			<th class="th" >{!!trans('data.heure_fin')!!}</th>
			<th class="th" >{!!trans('data.jour_semaine')!!}</th>
			<th class="th" >{!!trans('data.discipline_id')!!}</th>
			<th class="th" >{!!trans('data.promotion_id')!!}</th>
			<th class="th" >{!!trans('data.annee_id')!!}</th>
			<th class="th" >{!!trans('data.prof_id')!!}</th>
			<th class="th" >{!!trans('data.init_id')!!}</th>
		</tr>
		<tbody>{{$i = 1}}
			@foreach($list as $listgiwu)
				<tr style="background-color : <?php if ($i % 2 == 0) {echo '#ffffff';$i++;}else{echo trans("data.styleLignePdf");$i++;} ?>;">
					<td class="td">{{$listgiwu->id_empl}}</td>
					<td class="td">{{$listgiwu->heure_debut}}</td>
					<td class="td">{{$listgiwu->heure_fin}}</td>
					<td class="td" >{{strrev(wordwrap(strrev(intval($listgiwu->jour_semaine)), 3, ' ', true))}}</td>
					<td class="td">{{isset($listgiwu->discipline) ? $listgiwu->discipline->code_disci : trans('data.not_found')}}</td>
					<td class="td">{{isset($listgiwu->promotion) ? $listgiwu->promotion->libelle_pro : trans('data.not_found')}}</td>
					<td class="td">{{isset($listgiwu->anneesco) ? $listgiwu->anneesco->annee_debut : trans('data.not_found')}}</td>
					<td class="td">{{isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found')}}</td>
					<td class="td">{{isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found')}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div><strong>Info! </strong> {!! trans('data.AucunInfosTrouve')!!} </div>
@endif
