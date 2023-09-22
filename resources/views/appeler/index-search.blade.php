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
            <?php $appel = \App\Models\Appeler::CheckElevePresence($listgiwu->eleve_id); ?>
                @if($appel)
                <tr>
                    <td>
                        <button id="dochoix{{ $appel->id_appel }}" type="button" data-id="{{$appel->id_appel }}"
                            class="btn {{ $appel->etat_appel == true ? 'btn-secondary' : 'btn-danger' }} btn-sm bg-gradient waves-effect waves-light btn-confirmer">
                            {{ $appel->etat_appel == true ? 'Présent' : 'Absent' }}
                        </button>
                        {!! isset($appel->eleve) ? $appel->eleve->nom_el . ' ' . $appel->eleve->prenom_el : trans('data.not_found') !!}
                    </td>
                    <td class='text-center'>
                        @if ($appel->justifier == 'non')
                            <span class='badge bg-danger'>Non</a>
                            @elseif($appel->justifier == 'oui')
                                <span class='badge bg-secondary'>Oui</a>
                        @endif
                    </td>
                    <td>
                        @if (strlen($appel->motif_just) > 30)
                            {!! substr($appel->motif_just, 0, 30) !!}...
                        @else
                            {!! $appel->motif_just !!}
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($appel->fichier_justif)
                            <span class="badge bg-success">
                                <a style='color:white' href='{{ 'assets/docs/' . $appel->fichier_justif }}'
                                    target="_blank" rel="noopener noreferrer">Fichier</a>
                            </span>
                        @else
                            <span class="badge bg-danger">Aucun</span>
                        @endif
                    </td>
                    <td class="text-center">
                    <button id="boutonMotif{{ $appel->id_appel }}" type="button" title='Actions' data-id="{{ $appel->id_appel }}" class="btn btn-sm btn-secondary waves-effect waves-light btn-action" data-toggle="modal" style="visibility: {{ $appel->etat_appel ? 'hidden' : 'visible' }};">Motif</button>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    {!! $list->appends(['query' => isset($_GET['query']) ? $_GET['query'] : ''])->links() !!}
@else
    <div Class="alert alert-info"><strong>Info! </strong> {!! trans('data.AucunInfosTrouve') !!} </div>
@endif
