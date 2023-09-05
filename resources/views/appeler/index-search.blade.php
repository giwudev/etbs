<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@if (count($list) != 0)
    <table class="table table-striped table-bordered table-nowrap">
        <thead>
            <tr>
                <!-- <th scope="col" class="text-center">{!! trans('data.emploi_id') !!}</th> -->
                <th scope="col" class="text-center">{!! trans('data.eleve_id') !!}</th>
                <th scope="col" class="text-center">{!! trans('data.justifier') !!}</th>
                <th scope="col">{!! trans('data.motif_just') !!}</th>
                <th scope="col">{!! trans('data.fichier_justif') !!}</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $listgiwu)
                <tr>
                    <?php $appel = \App\Models\Appeler::CheckElevePresence($listgiwu->eleve_id); ?>
                    <td>
                        <button id="dochoix{{$appel->id_appel}}" type="button" data-id="{{$appel->id_appel}}" 
                                class="btn {{$appel->etat_appel== true ? 'btn-secondary' : 'btn-danger' }} btn-sm bg-gradient waves-effect waves-light btn-confirmer">
                                {{$appel->etat_appel==true ? 'Présent' : 'Absent' }}
                        </button>
                        {!! isset($appel->eleve) ? $appel->eleve->nom_el.' '.$appel->eleve->prenom_el : trans('data.not_found') !!}
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-center">
                        <button type="button" title='Actions' data-id="{{$appel->id_appel}}" class="btn btn-sm btn-danger waves-effect waves-light btn-action"  data-toggle="modal">Motif</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $list->appends(['query' => isset($_GET['query']) ? $_GET['query'] : ''])->links() !!}
@else
    <div Class="alert alert-info"><strong>Info! </strong> {!! trans('data.AucunInfosTrouve') !!} </div>
@endif
