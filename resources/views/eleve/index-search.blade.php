<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@if (count($list) != 0)
    <table class="table table-striped table-bordered table-nowrap">
        <thead>
            <tr>
                <th scope="col">{!! trans('data.matricule_el') !!}</th>
                <th scope="col">{!! trans('data.nom_el')." ".trans('data.prenom_el') !!}</th>
                <th scope="col" class="text-center">{!! trans('data.date_nais_el') !!}</th>
                <th scope="col">{!! trans('data.sexe_el') !!}</th>
                <th scope="col" class="text-center">{!! trans('data.photo_el') !!}</th>
                <th scope="col">{!! trans('data.tuteur_el') !!}</th>
                <th scope="col">{!! trans('data.email_el') !!}</th>
                <th scope="col">{!! trans('data.tel_el') !!}</th>
                @if (in_array('update_eleve', session('InfosAction')) || in_array('delete_eleve', session('InfosAction')))
                    <th class="text-center"> Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $listgiwu)
                <tr>
                    <td>{!! $listgiwu->matricule_el !!}</td>
                    <td>{!! $listgiwu->nom_el." ".$listgiwu->prenom_el !!}</td>
                    <td class="text-center">{{ date('d/m/Y', strtotime($listgiwu->date_nais_el)) }}</td>
                    <td>{!! $listgiwu->sexe_el === 'f' ? 'Féminin' : 'Masculin' !!}</td>
                    <td class="text-center">
                        @if ($listgiwu->photo_el)
                            <a href='{{ 'assets/docs/' . $listgiwu->photo_el }}' title="{!! $listgiwu->photo_el !!}"
                                target="_blank" class="badge bg-success">Ouvrir</a>
                        @else
                            <span class="badge bg-danger">Aucun</a>
                        @endif
                    </td>
                    <td>{!! $listgiwu->tuteur_el !!}</td>
                    <td>{!! $listgiwu->email_el !!}</td>
                    <td>{!! $listgiwu->tel_el !!}</td>

                    @if (in_array('update_eleve', session('InfosAction')) || in_array('delete_eleve', session('InfosAction')))
                        <td class="text-center">
                            @if (in_array('update_eleve', session('InfosAction')))
                                <a href="{{ route('eleve.edit', $listgiwu->id_el) }}" title='Modifier'
                                    class="btn btn-success btn-sm  waves-effect waves-light"><i
                                        class="ri-edit-2-line"></i></a>
                            @endif
                            @if (in_array('delete_eleve', session('InfosAction')))
                                <button type="button" title='Supprimer' data-id="{{ $listgiwu->id_el }}"
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
