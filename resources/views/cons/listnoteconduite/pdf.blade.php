<title>{{Config('app.name') }} | Note de conduite</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
{!!trans('data.stylePdf')!!} 
<div class="footer"><i>{!!trans('data.signaturePdf')!!} <span class="pagenum"></span> </i></div>

@if(count($list) != 0)
	<div><h3 style="text-align:center;">Note de conduite<br>
		@if(!empty($_GET['query']))
			Recherche : {{$_GET['query']}}<br>
		@endif
	</h3></div>

	<table class="table" style="font-size:15px; width:100%;">
		<tr>
			<th class="th" >{!!trans('data.id_freq')!!}</th>
			<th class="th" >{!!trans('data.eleve_id')!!}</th>
			<th class="th" >{!!trans('data.promotion_id')!!}</th>
			<th class="th" >{!!trans('data.created_at')!!}</th>
		</tr>
		<tbody>{{$i = 1}}
			@foreach($list as $listgiwu)
				<tr style="background-color : <?php if ($i % 2 == 0) {echo '#ffffff';$i++;}else{echo trans("data.styleLignePdf");$i++;} ?>;">
					<td class="td">{{$listgiwu->id_freq}}</td>
					<td class="td">{{isset($listgiwu->eleve) ? $listgiwu->eleve->nom_el : trans('data.not_found')}}</td>
					<td class="td">{{isset($listgiwu->promotion) ? $listgiwu->promotion->libelle_pro : trans('data.not_found')}}</td>
					<td class="td">{{$listgiwu->created_at}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div><strong>Info! </strong> {!! trans('data.AucunInfosTrouve')!!} </div>
@endif
