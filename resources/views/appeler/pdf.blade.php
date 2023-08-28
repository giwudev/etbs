<title>{{ Config('app.name') }} | Faire un appel</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
{!! trans('data.stylePdf') !!}
<div class="footer"><i>{!! trans('data.signaturePdf') !!} <span class="pagenum"></span> </i></div>

@if (count($list) != 0)
    <div>
        <h3 style="text-align:center ; text-decoration: ">Point d'appel de ce <?= $title ?> <br>
            @if (!empty($_GET['query']))
                Recherche : {{ $_GET['query'] }}<br>
            @endif
        </h3>
    </div>

    <table class="table" style="font-size:15px; width:100%;">
        <tr>
            {{--   <th class="th">{!! trans('data.id_appel') !!}</th>
           <th class="th">{!! trans('data.emploi_id') !!}</th> --}}
            <th class="th">{!! ' N°' !!}</th>
            <th class="th">{!! trans('data.eleve_id') !!}</th>
            {{-- <th class="th">{!! trans('data.init_id') !!}</th> --}}
            <th class="th">{!! trans('data.etat_appel') !!}</th>
        </tr>
        <tbody>{{ $i = 1 }}
            @foreach ($list as $listgiwu)
                <tr style="background-color : <?php if ($i % 2 == 0) {
                    echo '#ffffff';
                    $i++;
                } else {
                    echo trans('data.styleLignePdf');
                    $i++;
                } ?>;">
                    <td class="td">{{ $i - 1 }}</td>

                    <td class="td">
                        {{ isset($listgiwu->eleve) ? $listgiwu->eleve->nom_el . ' ' . $listgiwu->eleve->prenom_el : trans('data.not_found') }}
                    </td>
                    {{-- <td class="td">{{isset($listgiwu->users_g) ? $listgiwu->users_g->name." ".$listgiwu->users_g->prenom : trans('data.not_found')}}</td> --}}
                    <td class="td">{{ $listgiwu->etat_appel == 1 ? 'Present' : 'Absent' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div><strong>Info! </strong> {!! trans('data.AucunInfosTrouve') !!} </div>
@endif
