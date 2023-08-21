<title>{{Config('app.name') }} | Liste des eleves</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
{!!trans('data.stylePdf')!!} 
<div class="footer"><i>{!!trans('data.signaturePdf')!!} <span class="pagenum"></span> </i></div>

@if(count($list) != 0)
	<div><h3 style="text-align:center;">Liste des eleves<br>
		@if(!empty($_GET['query']))
			Recherche : {{$_GET['query']}}<br>
		@endif
	</h3></div>

	<table class="table" style="font-size:15px; width:100%;">
		<tr>
			<th class="th" >{!!trans('data.id_el')!!}</th>
			<th class="th" >{!!trans('data.nom_el')!!}</th>
			<th class="th" >{!!trans('data.prenom_el')!!}</th>
			<th class="th" >{!!trans('data.matricule_el')!!}</th>
			<th class="th" >{!!trans('data.date_nais_el')!!}</th>
			<th class="th" >{!!trans('data.sexe_el')!!}</th>
			<th class="th" >{!!trans('data.photo_el')!!}</th>
			<th class="th" >{!!trans('data.tuteur_el')!!}</th>
			<th class="th" >{!!trans('data.email_el')!!}</th>
			<th class="th" >{!!trans('data.tel_el')!!}</th>
			<th class="th" >{!!trans('data.ecole_id')!!}</th>
			<th class="th" >{!!trans('data.init_id')!!}</th>
		</tr>
		<tbody>{{$i = 1}}
			@foreach($list as $listgiwu)
				<tr style="background-color : <?php if ($i % 2 == 0) {echo '#ffffff';$i++;}else{echo trans("data.styleLignePdf");$i++;} ?>;">
					<td class="td">{{$listgiwu->id_el}}</td>
					<td class="td">{{$listgiwu->nom_el}}</td>
					<td class="td">{{$listgiwu->prenom_el}}</td>
					<td class="td">{{$listgiwu->matricule_el}}</td>
					<td class="td">{{date('d/m/Y',strtotime($listgiwu->date_nais_el))}}</td>
					<td class="td">{{$listgiwu->sexe_el}}</td>
					<td class="td">{{$listgiwu->photo_el}}</td>
					<td class="td">{{$listgiwu->tuteur_el}}</td>
					<td class="td">{{$listgiwu->email_el}}</td>
					<td class="td">{{$listgiwu->tel_el}}</td>
					<td class="td">{{isset($listgiwu->ecole) ? $listgiwu->ecole->nom_eco : trans('data.not_found')}}</td>
					<td class="td">{{isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found')}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div><strong>Info! </strong> {!! trans('data.AucunInfosTrouve')!!} </div>
@endif
