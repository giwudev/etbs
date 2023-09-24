<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@if (count($list) != 0)
    <table class="table table-striped table-bordered table-nowrap">
        <thead>
            <tr>
                <th scope="col" class="text-center">{!! trans('data.eleve_id') !!}</th>
                <th scope="col" class="text-center">{!! trans('data.promotion_id') !!}</th>
                <th scope="col" class="text-center">Type Souscription :</th>
                <th scope="col" class="text-center">Souscription Mail:</th>
                <th scope="col" class="text-center">Souscription SMS :</th>
                <th scope="col" class="text-center">Souscription whatsApp :</th>
                @if (in_array('update_frequenter', session('InfosAction')) || in_array('delete_frequenter', session('InfosAction')))
                    <th class="text-center"> Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $listgiwu)
                <tr>
                    <td>{!! isset($listgiwu->eleve)
                        ? $listgiwu->eleve->nom_el . ' ' . $listgiwu->eleve->prenom_el
                        : trans('data.not_found') !!}</td>
                    <td>{!! isset($listgiwu->promotion) ? $listgiwu->promotion->libelle_pro : trans('data.not_found') !!}</td>
                     <td class="text-center" > 
                    {{ $listgiwu->send_sms ? 'SMS' : '' }}
                    {{ $listgiwu->send_whatsapp ? ($listgiwu->send_sms ? ', ' : '') . 'WhatsApp' : '' }}
                    {{ $listgiwu->send_mail ? ($listgiwu->send_sms || $listgiwu->send_whatsapp ? ', ' : '') . 'Mail' : '' }}
                    </td>                
                    <td class="text-center">
                        <div class="checkbox">
                        <input type="checkbox" id="{{ $listgiwu->id_freq}}" data-id="{{ $listgiwu->id_freq}}" data-toggle="toggle" data-on="Abonner" data-onstyle="success" data-offstyle="danger" data-off="Désabonner" data-service="mail">
                        </div>
                    </td>  
                    <td class="text-center">
                        <div class="checkbox">
                        <input type="checkbox" id="{{ $listgiwu->id_freq}}" data-id="{{ $listgiwu->id_freq}}" data-toggle="toggle" data-on="Abonner" data-onstyle="success" data-offstyle="danger" data-off="Désabonner" data-service="sms">
                        </div>
                    </td>  
                    <td class="text-center">
                        <div class="checkbox">
                        <input type="checkbox" id="{{ $listgiwu->id_freq}}" data-id="{{ $listgiwu->id_freq}}" data-toggle="toggle" data-on="Abonner" data-onstyle="success" data-offstyle="danger" data-off="Désabonner" data-service="whatsapp">
                        </div>
                    </td>   
                      @if (in_array('update_frequenter', session('InfosAction')) || in_array('delete_frequenter', session('InfosAction')))
                        <td class="text-center">
                            @if (in_array('update_frequenter', session('InfosAction')))
                                <a href="{{ route('frequenter.edit', $listgiwu->id_freq) }}" title='Modifier'
                                    class="btn btn-success btn-sm  waves-effect waves-light"><i
                                        class="ri-edit-2-line"></i></a>
                            @endif
                            @if (in_array('delete_frequenter', session('InfosAction')))
                                <button type="button" title='Supprimer' data-id="{{ $listgiwu->id_freq }}"
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
