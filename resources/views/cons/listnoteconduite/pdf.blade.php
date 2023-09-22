<style>
	
</style>
<title>{{Config('app.name') }} | Note de conduite de la promotion {{ $promo }} </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
{!!trans('data.stylePdf')!!} 
<div class="footer"><i>{!!trans('data.signaturePdf')!!} <span class="pagenum"></span> </i></div>

@if(count($list) != 0)
	<div><h3 style="text-align:center;">Note de conduite de la promotion {{ $promo }} <br>
		@if(!empty($_GET['query']))
			Recherche : {{$_GET['query']}}<br>
		@endif
	</h3></div>

	<table class="table" style="font-size:15px; width:100%;">
		<tr>
			<th  class="th">N°</th>
			<th  class="th">{!!trans('data.eleve_id')!!}</th>
			<th  class="th">{!!trans('data.nbre_heure_abs')!!}</th>
			<th  class="th">{!!trans('data.nbre_heure_justifie')!!}</th>
			<th  class="th">{!!trans('data.nbre_heure_non_justifie')!!}</th>
			<th  class="th">{!!trans('data.conduite')!!}</th>
		</tr>
		<tbody>{{$i = 1}}
		<?php $i=1;?>
			@foreach($list as $listgiwu)
				<?php
					$nbreAbs = \App\Models\Appeler::nbre_heure_abs($listgiwu->eleve_id,$listgiwu->promotion_id );
				?>
					<tr style="background-color : <?php if ($i % 2 == 0) {echo '#ffffff';$i++;}else{echo trans("data.styleLignePdf");$i++;} ?>;">
					<td class="td">{{$i++}}</td>
					<td class="td">{!! isset($listgiwu->eleve)
								? $listgiwu->eleve->nom_el . ' ' . $listgiwu->eleve->prenom_el
								: trans('data.not_found') !!}</td>
					<td  class="td ">{{$nbreAbs." H"}} </td>
					<td  class="td">{{\App\Models\Appeler::nbre_heure_abs_justifier($listgiwu->eleve_id,$listgiwu->promotion_id )." H"}} </td>
					<td  class="td">{{\App\Models\Appeler::nbre_heure_abs_non_justifier($listgiwu->eleve_id,$listgiwu->promotion_id )." H"}} </td>
					<td  class="td">{{\App\Models\Appeler::note_conduite($nbreAbs)}} </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div><strong>Info! </strong> {!! trans('data.AucunInfosTrouve')!!} </div>
@endif
