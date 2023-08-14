<title>{{Config('app.name') }} | Annee scolaire</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
{!!trans('data.stylePdf')!!} 
<div class="footer"><i>{!!trans('data.signaturePdf')!!} <span class="pagenum"></span> </i></div>

@if(count($list) != 0)
	<div><h3 style="text-align:center;">Année scolaire<br>
		@if(!empty($_GET['query']))
			Recherche : {{$_GET['query']}}<br>
		@endif
	</h3></div>

	<table class="table" style="font-size:15px; width:100%;">
		<tr>
			<!-- <th class="th" >{!!trans('data.id_annee')!!}</th> -->
			<!-- <th class="th" >{!!trans('data.annee_debut')!!}</th> -->
			<th class="th" >{!!trans('data.libelle_annee')!!}</th>
			<th class="th" >{!!trans('data.statut_annee')!!}</th>
			<th class="th" >{!!trans('data.init_id')!!}</th>
			<th class="th" >{!!trans('data.etablis_id')!!}</th>
		</tr>
		<tbody>{{$i = 1}}
			@foreach($list as $listgiwu)
				<tr style="background-color : <?php if ($i % 2 == 0) {echo '#ffffff';$i++;}else{echo trans("data.styleLignePdf");$i++;} ?>;">
					<!-- <td class="td">{{$listgiwu->id_annee}}</td> -->
					<!-- <td class="td" >{{strrev(wordwrap(strrev(intval($listgiwu->annee_fin)), 3, ' ', true))}}</td> -->
					<td class="td" >{{$listgiwu->annee_debut.' - '.$listgiwu->annee_fin}}</td>
					<td class="td">{{trans('entite.statutanne')[$listgiwu->statut_annee]}}</td>
					<td class="td">{{isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found')}}</td>
					<td class="td">{{isset($listgiwu->ecole) ? $listgiwu->ecole->nom_eco : trans('data.not_found')}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div><strong>Info! </strong> {!! trans('data.AucunInfosTrouve')!!} </div>
@endif
