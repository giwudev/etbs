<title>{{Config('app.name') }} | Faire un appel</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
{!!trans('data.stylePdf')!!} 
<div class="footer"><i>{!!trans('data.signaturePdf')!!} <span class="pagenum"></span> </i></div>

@if(count($list) != 0)
	<div><h3 style="text-align:center;">Faire un appel<br>
		@if(!empty($_GET['query']))
			Recherche : {{$_GET['query']}}<br>
		@endif
	</h3></div>

	<table class="table" style="font-size:15px; width:100%;">
		<tr>
			<th class="th" >{!!trans('data.id_appel')!!}</th>
			<th class="th" >{!!trans('data.emploi_id')!!}</th>
			<th class="th" >{!!trans('data.eleve_id')!!}</th>
			<th class="th" >{!!trans('data.init_id')!!}</th>
			<th class="th" >{!!trans('data.etat_appel')!!}</th>
		</tr>
		<tbody>{{$i = 1}}
			@foreach($list as $listgiwu)
				<tr style="background-color : <?php if ($i % 2 == 0) {echo '#ffffff';$i++;}else{echo trans("data.styleLignePdf");$i++;} ?>;">
					<td class="td">{{$listgiwu->id_appel}}</td>
					<td class="td">{{isset($listgiwu->emploitemp) ? $listgiwu->emploitemp->heure_debut : trans('data.not_found')}}</td>
					<td class="td">{{isset($listgiwu->eleve) ? $listgiwu->eleve->nom_el : trans('data.not_found')}}</td>
					<td class="td">{{isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found')}}</td>
					<td class="td">{{$listgiwu->etat_appel}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div><strong>Info! </strong> {!! trans('data.AucunInfosTrouve')!!} </div>
@endif
