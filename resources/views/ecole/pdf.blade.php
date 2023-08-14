<title>{{Config('app.name') }} | Liste des ecoles</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
{!!trans('data.stylePdf')!!} 
<div class="footer"><i>{!!trans('data.signaturePdf')!!} <span class="pagenum"></span> </i></div>

@if(count($list) != 0)
	<div><h3 style="text-align:center;">Liste des ecoles<br>
		@if(!empty($_GET['query']))
			Recherche : {{$_GET['query']}}<br>
		@endif
	</h3></div>

	<table class="table" style="font-size:15px; width:100%;">
		<tr>
			<th class="th" >{!!trans('data.nom_eco')!!}</th>
			<th class="th" >{!!trans('data.sigle_eco')!!}</th>
			<th class="th" >{!!trans('data.adres_eco')!!}</th>
			<th class="th" >{!!trans('data.ville_eco')!!}</th>
			<th class="th" >{!!trans('data.CodePos_eco')!!}</th>
			<th class="th" >{!!trans('data.pays_eco')!!}</th>
			<th class="th" >{!!trans('data.tel_eco')!!}</th>
			<th class="th" >{!!trans('data.email_eco')!!}</th>
			<th class="th" >{!!trans('data.directeur_eco')!!}</th>
			<th class="th" >{!!trans('data.niveau_educ_eco')!!}</th>
			<th class="th" >{!!trans('data.init_id')!!}</th>
		</tr>
		<tbody>{{$i = 1}}
			@foreach($list as $listgiwu)
				<tr style="background-color : <?php if ($i % 2 == 0) {echo '#ffffff';$i++;}else{echo trans("data.styleLignePdf");$i++;} ?>;">
					<td class="td">{{$listgiwu->nom_eco}}</td>
					<td class="td">{{$listgiwu->sigle_eco}}</td>
					<td class="td">{{$listgiwu->adres_eco}}</td>
					<td class="td">{{$listgiwu->ville_eco}}</td>
					<td class="td">{{$listgiwu->CodePos_eco}}</td>
					<td class="td">{{$listgiwu->pays_eco}}</td>
					<td class="td">{{$listgiwu->tel_eco}}</td>
					<td class="td">{{$listgiwu->email_eco}}</td>
					<td class="td">{{$listgiwu->directeur_eco}}</td>
					<td class="td">{{$listgiwu->niveau_educ_eco}}</td>
					<td class="td">{{isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found')}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div><strong>Info! </strong> {!! trans('data.AucunInfosTrouve')!!} </div>
@endif
