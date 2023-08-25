<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@if (count($list) != 0)
    <table class="table table-striped table-bordered table-nowrap">
        <thead>
            <tr>
                <th scope="col" class="text-center">{!! trans('data.emploi_id') !!}</th>
                <th scope="col" class="text-center">{!! trans('data.eleve_id') !!}</th>
                <th scope="col">{!! trans('data.etat_appel') !!}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $listgiwu)
                <tr>
                    <td>{!! isset($listgiwu->emploitemp) ? $listgiwu->emploitemp->heure_debut : trans('data.not_found') !!}</td>
                    <td>{!! isset($listgiwu->eleve) ? $listgiwu->eleve->nom_el : trans('data.not_found') !!}</td>
                    <td>{!! $listgiwu->etat_appel !!}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $list->appends(['query' => isset($_GET['query']) ? $_GET['query'] : ''])->links() !!}
@else
    <div Class="alert alert-info"><strong>Info! </strong> {!! trans('data.AucunInfosTrouve') !!} </div>
@endif
