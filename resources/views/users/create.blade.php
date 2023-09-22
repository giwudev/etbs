@extends('layouts.general')

@section('path_content')
@if(sizeof($pathMenu) != 0)
@for($i=0; $i < count($pathMenu); $i++) <li class="breadcrumb-item active"><a href="{{$pathMenu[$i]['lien']}}"
        class="kt-subheader__breadcrumbs-link">{{$pathMenu[$i]['titre']}}</a></li>
    @endfor
    @endif
    @stop

    @section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{$titre}}</h4>
                <div class="flex-shrink-0">
                    <div class="form-check form-switch form-switch-right form-switch-md">
                        <button type="button"
                            class="btn btn-secondary btn-label right btn-action waves-effect waves-light btn-action"
                            data-toggle="modal" data-id="{{ $promotion->id_pro }}"><i
                                class="ri-file-excel-2-fill label-icon align-middle fs-16 ms-2"></i>Importation Excel
                            des Professeurs </button>
                    </div>
                </div>
            </div><!-- end card header -->
            <div class="card-body">
                <p class="text-muted"></p>
                <div class="live-preview">
                    <strong>
                        <div class="msgAjouter"></div>
                    </strong>
                    <form action="{{route('users.store')}}" method="post" id="form" class="row g-3 needs-validation"
                        novalidate>
                        @csrf()
                        <div class="row">
                            @if(session()->has('success') || session()->has('error'))
                            <div class="col-md-12">
                                <div class="alert {{ session()->has('success') ? 'alert-success' : ''}} {{ session()->has('error') ? 'alert-danger' : ''}} alert-border-left alert-dismissible fade show"
                                    role="alert">
                                    <i title="{{session()->has('errorMsg')? session()->get('errorMsg') : '' }}"
                                        class=" {{session()->has('success') ? 'ri-notification-off-line' : 'ri-error-warning-line'}} me-3 align-middle"></i>
                                    <strong>Infos </strong> - {{session()->has('success') ? session()->get('success') :
                                    session()->get('error')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                            @endif
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">{{trans('data.name')}}<strong
                                            style='color: red;'> *</strong></label>
                                    {!!
                                    Form::text('name','',["id"=>"name","class"=>"form-control","required"=>"required",'placeholder'=>"Entrer
                                    votre nom",'autocomplete'=>'off']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="prenom" class="form-label">{{trans('data.prenom')}}<strong
                                            style='color: red;'> *</strong></label>
                                    {!!
                                    Form::text('prenom','',["id"=>"prenom","class"=>"form-control","required"=>"required",'placeholder'=>"Entrer
                                    votre prénom",'autocomplete'=>'off']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tel_user" class="form-label">{{trans('data.tel_user')}}<strong
                                            style='color: red;'> *</strong></label>
                                    {!!
                                    Form::text('tel_user','',["id"=>"tel_user","class"=>"form-control","required"=>"required",'placeholder'=>"Entrer
                                    votre téléphone",'autocomplete'=>'off']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{trans('data.email')}}<strong
                                            style='color: red;'> *</strong></label>
                                    {!!
                                    Form::email('email','',["id"=>"email","class"=>"form-control","required"=>"required",'placeholder'=>"example@gamil.com",'autocomplete'=>'off'])
                                    !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_role" class="form-label">{{trans('data.libelle_role')}}<strong
                                            style='color: red;'> *</strong></label>
                                    <?php $addUse = array(''=>'Sélectionner un élément'); $sltRole = $addUse + $sltRole->toArray();?>
                                    {!! Form::select('id_role',$sltRole ,null,["id"=>"id_role","class"=>"form-select
                                    select2",'required'=>'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="id_role" class="form-label">{{trans('data.etablis_id')}}<strong
                                            style='color: red;'> *</strong></label>
                                    <?php $addUse = array(''=>'Sélectionner un élément'); $listEcole_id = $addUse + $listEcole_id->toArray(); ?>
                                    {!! Form::select('etablis_id',$listEcole_id
                                    ,session('etablis_idSess'),["id"=>"etablis_id","class"=>"form-select
                                    allselect",'required'=>'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="is_active" class="form-label">{{trans('data.is_active')}}<strong
                                            style='color: red;'> *</strong></label>
                                    <?php $addUse = array(''=>'Sélectionner un élément','1'=>'Activé','0'=>'Désactivé');?>
                                    {!! Form::select('is_active',$addUse ,null,["id"=>"is_active","class"=>"form-select
                                    select2",'required'=>'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="other_infos_user"
                                        class="form-label">{{trans('data.other_infos_user')}}</label>
                                    {!!
                                    Form::text('other_infos_user','',["id"=>"other_infos_user","class"=>"form-control",'placeholder'=>"Entrer
                                    votre d'autre informations",'autocomplete'=>'off']) !!}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="text-end">
                                    <a href="{{route('users.index')}}"
                                        class="btn btn-outline-dark waves-effect mr-10">Fermer</a>
                                    @if(in_array('add_user',session('InfosAction')))
                                    <button type="submit" class="btn btn-primary btn-label right"><i
                                            class="ri-add-line label-icon align-middle fs-16 ms-2"></i>Ajouter</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
            <div>
                <div class="modal fade bs-example-modal-center" data-bs-backdrop="static" id="kt_action_4" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <!-- modal-dialog-scrollable -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('JS_content')
    <script src="{{url('assets/js/jquery.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).on('click', '.btn-action', function() {
            id = $(this).data("id");
            $.ajax({
                url: '{{ url('users/AffichePopAction/') }}/' + id,
                type: 'GET',
                dataType: 'html',
                success: function(code_html, statut) {
                  
                    $("#kt_action_4 .modal-dialog").html(code_html);
                    $("#kt_action_4").modal('show');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); 
                }
            });
        });
        
       
    </script>
    @endsection