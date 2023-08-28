<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@if (count($list) != 0)
    <table class="table table-striped table-bordered table-nowrap">
        <thead>
            <tr>
                <th scope="col">{!! trans('data.libelle_trimSem') !!}</th>
                <th scope="col">{!! trans('data.statut_trimSem') !!}</th>
                <th scope="col" class="text-center">{!! 'Date Début' !!}</th>
                <th scope="col" class="text-center">{!! 'Date Fin' !!}</th>
                <th scope="col" class="text-center">{!! trans('data.annee_id') !!}</th>
                <th scope="col" class="text-center">{!! trans('data.init_id') !!}</th>
                @if (in_array('update_trimsem', session('InfosAction')) || in_array('delete_trimsem', session('InfosAction')))
                    <th class="text-center"> Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $listgiwu)
                <tr>
                    <td>{!! $listgiwu->libelle_trimSem !!}</td>
                    <td>
                        @if ($listgiwu->statut_trimSem == 'a')
                            <span
                                class="badge bg-success">{{ trans('entite.statutanne')[$listgiwu->statut_trimSem] }}</span>
                        @else
                            <span
                                class="badge bg-danger">{{ trans('entite.statutanne')[$listgiwu->statut_trimSem] }}</span>
                        @endif
                    </td>
                    <td>{!! $listgiwu->date_debut ? $listgiwu->date_debut->format('d M Y') : ' ' !!} </td>
                    <td>{!! $listgiwu->date_fin ? $listgiwu->date_fin->format('d M Y') : ' ' !!} </td>

                    <td>{!! isset($listgiwu->anneesco)
                        ? $listgiwu->anneesco->annee_debut . ' - ' . $listgiwu->anneesco->annee_fin
                        : trans('data.not_found') !!}</td>
                    <td>{!! isset($listgiwu->users_g)
                        ? $listgiwu->users_g->name . ' ' . $listgiwu->users_g->prenom
                        : trans('data.not_found') !!}</td>
                    @if (in_array('update_trimsem', session('InfosAction')) || in_array('delete_trimsem', session('InfosAction')))
                        <td class="text-center">
                            @if (in_array('update_trimsem', session('InfosAction')))
                                <a href="{{ route('trimsem.edit', $listgiwu->id_trimSem) }}" title='Modifier'
                                    class="btn btn-success btn-sm  waves-effect waves-light"><i
                                        class="ri-edit-2-line"></i></a>
                            @endif
                            @if (in_array('delete_trimsem', session('InfosAction')))
                                <button type="button" title='Supprimer' data-id="{{ $listgiwu->id_trimSem }}"
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
