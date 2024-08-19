<title>{{Config('app.name') }} | Paiement prof</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
{!!trans('data.stylePdf')!!} 
<div class="footer"><i>{!!trans('data.signaturePdf')!!} <span class="pagenum"></span> </i></div>

@if(count($list) != 0)
	<div><h3 style="text-align:center;">Paiement prof<br>
		@if(!empty($_GET['query']))
			Recherche : {{$_GET['query']}}<br>
		@endif
	</h3></div>

	<table class="table" style="font-size:15px; width:100%;">
		<tr>
			<th class="th" >{!!trans('data.id_paie')!!}</th>
			<th class="th" >{!!trans('data.id_prof')!!}</th>
			<th class="th" >{!!trans('data.datedebut')!!}</th>
			<th class="th" >{!!trans('data.datefin')!!}</th>
			<th class="th" >{!!trans('data.montant_total')!!}</th>
			<th class="th" >{!!trans('data.payer_bool')!!}</th>
			<th class="th" >{!!trans('data.init_id')!!}</th>
		</tr>
		<tbody>{{$i = 1}}
			@foreach($list as $listgiwu)
				<tr style="background-color : <?php if ($i % 2 == 0) {echo '#ffffff';$i++;}else{echo trans("data.styleLignePdf");$i++;} ?>;">
					<td class="td">{{$listgiwu->id_paie}}</td>
					<td class="td">{{isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found')}}</td>
					<td class="td">{{date('d/m/Y',strtotime($listgiwu->datedebut))}}</td>
					<td class="td">{{date('d/m/Y',strtotime($listgiwu->datefin))}}</td>
					<td class="td" >{{strrev(wordwrap(strrev(intval($listgiwu->montant_total)), 3, ' ', true))}}</td>
					<td class="td">{{$listgiwu->payer_bool}}</td>
					<td class="td">{{isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found')}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div><strong>Info! </strong> {!! trans('data.AucunInfosTrouve')!!} </div>
@endif
