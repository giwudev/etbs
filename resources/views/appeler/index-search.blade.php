<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@if (count($list) != 0)
    <table class="table table-striped table-bordered table-nowrap">
        <thead>
            <tr>
                <!-- <th scope="col" class="text-center">{!! trans('data.emploi_id') !!}</th> -->
                <!-- <th scope="col">{!! trans('data.etat_appel') !!}</th> -->
                <th scope="col" class="text-center">{!! trans('data.eleve_id') !!}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $listgiwu)
                <tr>
                    <!-- <td>{!! isset($listgiwu->emploitemp) ? $listgiwu->emploitemp->heure_debut : trans('data.not_found') !!}</td> -->
                    <td >
                        <button id="dochoix{{$listgiwu->id_appel}}" type="button" data-id="{{$listgiwu->id_appel}}" class="btn {{$listgiwu->etat_appel== true ? 'btn-secondary' : 'btn-danger' }} btn-sm bg-gradient waves-effect waves-light btn-confirmer">{{$listgiwu->etat_appel==true ? 'Présent' : 'Absent' }}</button>
                        {!! isset($listgiwu->eleve) ? $listgiwu->eleve->nom_el.' '.$listgiwu->eleve->prenom_el : trans('data.not_found') !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $list->appends(['query' => isset($_GET['query']) ? $_GET['query'] : ''])->links() !!}
@else
    <div Class="alert alert-info"><strong>Info! </strong> {!! trans('data.AucunInfosTrouve') !!} </div>
@endif
