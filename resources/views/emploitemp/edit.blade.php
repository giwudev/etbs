@extends('layouts.general')

@section('path_content')
    @if (sizeof($pathMenu) != 0)
        @for ($i = 0; $i < count($pathMenu); $i++)
            <li class="breadcrumb-item active"><a href="{{ $pathMenu[$i]['lien'] }}"
                    class="kt-subheader__breadcrumbs-link">{{ $pathMenu[$i]['titre'] }}</a></li>
        @endfor
    @endif
@stop

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">{{ $titre }}</h4>
                <div class="flex-shrink-0">
                    <div class="form-check form-switch form-switch-right form-switch-md"><i class="{{ $icone }}"></i>
                    </div>
                </div>
            </div><!-- end card header -->
            <div class="card-body">
                <p class="text-muted"></p>
                <div class="live-preview"><strong>
                        <div class="msgAjouter"></div>
                    </strong>
                    <form action="{{ route('emploitemp.update', $item->id_empl) }}" method="post" id="form"
                        class="row g-3 needs-validation" novalidate>
                        @csrf()
                        @method('PATCH')
                        <div class="row">
                            @if (session()->has('success') || session()->has('error'))
                                <div class="col-md-12 mt-2">
                                    <div class="alert {!! session()->has('success') ? 'alert-success' : '' !!} {!! session()->has('error') ? 'alert-danger' : '' !!} alert-border-left alert-dismissible fade show"
                                        role="alert"><i title="{!! session()->has('errorMsg') ? session()->get('errorMsg') : '' !!}"
                                            class=" {!! session()->has('success') ? 'ri-notification-off-line' : 'ri-error-warning-line' !!} me-3 align-middle"></i> <strong>Infos </strong>
                                        - {!! session()->has('success') ? session()->get('success') : session()->get('error') !!}<button type="button" class="btn-close"
                                            data-bs-dismiss="alert" aria-label="Close"></button></div>
                                </div>
                            @endif

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="heure_debut" class="form-label">{!! trans('data.heure_debut') !!} <strong
                                            style='color: red;'> *</strong></label>
                                    {!! Form::time('heure_debut', $item->heure_debut, [
                                        'id' => 'heure_debut',
                                        'class' => 'form-control',
                                        'required' => 'required',
                                        'autocomplete' => 'off',
                                        'placeholder' => 'Entrer Heure debut',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="heure_fin" class="form-label">{!! trans('data.heure_fin') !!} <strong
                                            style='color: red;'> *</strong></label>
                                    {!! Form::time('heure_fin', $item->heure_fin, [
                                        'id' => 'heure_fin',
                                        'class' => 'form-control',
                                        'required' => 'required',
                                        'autocomplete' => 'off',
                                        'placeholder' => 'Entrer Heure fin',
                                    ]) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jour_semaine" class="form-label">{!! trans('data.jour_semaine') !!} <strong
                                            style='color: red;'> *</strong></label>
                                    {!! Form::select('jour_semaine', trans('entite.semaine'), $item->jour_semaine, [
                                        'id' => 'jour_semaine',
                                        'class' => 'form-select allselect',
                                        'required' => 'required',
                                    ]) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="discipline_id" class="form-label">{!! trans('data.discipline_id') !!} <strong
                                            style='color: red;'> *</strong></label>
                                    <?php $addUse = ['' => 'S&eacute;lectionnez un &eacute;l&eacute;ment'];
                                    $listdiscipline_id = $addUse + $listdiscipline_id->toArray(); ?>
                                    {!! Form::select('discipline_id', $listdiscipline_id, $item->discipline_id, [
                                        'id' => 'discipline_id',
                                        'class' => 'form-select allselect',
                                        'required' => 'required',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="prof_id" class="form-label">{!! trans('data.prof_id') !!} <strong
                                            style='color: red;'> *</strong></label>
                                    <?php $addUse = ['' => 'S&eacute;lectionnez un &eacute;l&eacute;ment'];
                                    $listprof_id = $addUse + $listprof_id->toArray(); ?>
                                    {!! Form::select('prof_id', $listprof_id, $item->prof_id, [
                                        'id' => 'prof_id',
                                        'class' => 'form-select allselect',
                                        'required' => 'required',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="promotion_id" class="form-label">{!! trans('data.promotion_id') !!} <strong
                                            style='color: red;'> *</strong></label>
                                    <?php $addUse = ['' => 'S&eacute;lectionnez un &eacute;l&eacute;ment'];
                                    $listpromotion_id = $addUse + $listpromotion_id->toArray(); ?>
                                    {!! Form::select('promotion_id', $listpromotion_id, $item->promotion_id, [
                                        'id' => 'promotion_id',
                                        'class' => 'form-select allselect',
                                        'required' => 'required',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="annee_id" class="form-label">{!! trans('data.annee_id') !!} <strong
                                            style='color: red;'> *</strong></label>
                                    <?php $addUse = ['' => 'S&eacute;lectionnez un &eacute;l&eacute;ment'];
                                    $listannee_id = $addUse + $listannee_id->toArray(); ?>
                                    {!! Form::select('annee_id', $listannee_id, $item->annee_id, [
                                        'id' => 'annee_id',
                                        'class' => 'form-select allselect',
                                        'required' => 'required',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="text-end">
                                    <a href="{{ route('emploitemp.index') }}"
                                        class="btn btn-outline-dark waves-effect mr-10">Fermer</a>
                                    @if (in_array('update_emploitemp', session('InfosAction')))
                                        <button type="submit" class="btn btn-success btn-label right"><i
                                                class="ri-edit-2-line label-icon align-middle fs-16 ms-2"></i>Modifier</button>
                                    @endif
                                </div>
                            </div>
                        </div><!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('JS_content')
    <script src="{{ url('assets/js/jquery.min.js') }}" type="text/javascript"></script>
@endsection
