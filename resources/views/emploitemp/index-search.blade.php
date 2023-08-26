<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@if (count($list) != 0)
    <table class="table table-striped table-bordered table-nowrap">
        <thead>
            <tr>
                <th scope="col">{!! trans('data.heure_debut').' - '.trans('data.heure_fin') !!}</th>
                <!-- <th scope="col">{!! trans('data.heure_fin') !!}</th> -->
                <th scope="col" class="text-center">{!! trans('data.jour_semaine') !!}</th>
                <th scope="col" class="text-center">{!! trans('data.discipline_id') !!}</th>
                <th scope="col" class="text-center">{!! trans('data.promotion_id') !!}</th>
                <th scope="col" class="text-center">{!! trans('data.annee_id') !!}</th>
                <th scope="col" class="text-center">{!! trans('data.prof_id') !!}</th>
                <!-- <th scope="col" class="text-center">{!! trans('data.init_id') !!}</th> -->
                @if (in_array('update_emploitemp', session('InfosAction')) || in_array('delete_emploitemp', session('InfosAction')))
                    <th class="text-center"> Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $listgiwu)
                <tr>
                    <td>{!! $listgiwu->heure_debut.' - '.$listgiwu->heure_fin !!}</td>
                    <!-- <td>{!! $listgiwu->heure_fin !!}</td> -->
                    <td style='text-align:right'>
                        {{ trans('entite.semaine')[$listgiwu->jour_semaine] }}</td>
                    <td>{!! isset($listgiwu->discipline) ? $listgiwu->discipline->code_disci : trans('data.not_found') !!}</td>
                    <td>{!! isset($listgiwu->promotion) ? $listgiwu->promotion->libelle_pro : trans('data.not_found') !!}</td>
                    <td>{!! isset($listgiwu->anneesco) ? $listgiwu->anneesco->annee_debut.' '.$listgiwu->anneesco->annee_fin : trans('data.not_found') !!}</td>
                    <td>{!! isset($listgiwu->users_g)? $listgiwu->users_g->name . ' ' . $listgiwu->users_g->prenom: trans('data.not_found') !!}</td>
                    <!-- <td>{!! isset($listgiwu->users_g)? $listgiwu->users_g->name . ' ' . $listgiwu->users_g->prenom: trans('data.not_found') !!}</td> -->
                    @if (in_array('update_emploitemp', session('InfosAction')) || in_array('delete_emploitemp', session('InfosAction')))
                        <td class="text-center">
                            @if (in_array('update_emploitemp', session('InfosAction')))
                                <a href="{{ route('emploitemp.edit', $listgiwu->id_empl) }}" title='Modifier'
                                    class="btn btn-success btn-sm  waves-effect waves-light"><i
                                        class="ri-edit-2-line"></i></a>
                            @endif
                            @if (in_array('delete_emploitemp', session('InfosAction')))
                                <button type="button" title='Supprimer' data-id="{{ $listgiwu->id_empl }}"
                                    class="btn btn-danger btn-sm  waves-effect waves-light btn-delete"
                                    data-bs-toggle="modal"><i class="ri-delete-bin-6-line"></i></button>
                            @endif
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $list->appends(['query' => isset($_GET['query']) ? $_GET['query'] : ''])->links() !!}
@else
    <div Class="alert alert-info"><strong>Info! </strong> {!! trans('data.AucunInfosTrouve') !!} </div>
@endif
