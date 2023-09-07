<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="modal-content">
    <div class="modal-header card-header">
        <h5 class="modal-title" id="varyingcontentModalLabel">Motif</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <strong>
            <div class="msgAction"></div>
        </strong>
        <form id="formAction" class="needs-validation"  method="post" novalidate enctype='multipart/form-data'>
			@csrf()
            {!! Form::hidden('id_appel',$item->id_appel,['id'=>'id_appel']) !!}
			<div class="col-md-12">
				<div class="mb-3">
					<label for="justifier" class="form-label">{!!trans('data.justifier')!!} </label>
					{!! Form::select('justifier',trans('entite.boolean'),null,["id"=>"justifier","class"=>"form-select allselect"]) !!}
					<span class="text-danger" id="justifierError"></span>
				</div>
			</div>
			<div class="col-md-12">
				<div class="mb-3">
					<label for="fichier_justif" class="form-label">{!!trans('data.fichier_justif')!!} <strong style='color: red;'> *</strong></label>
					<input class="form-control" type="file" id="fichier_justif" name="fichier_justif" required>
					<span class="text-danger" id="fichier_justifError"></span>
				</div>
			</div>
			<div class="col-md-12">
				<div class="mb-3">
                    <label for="motif_just" class="form-label">{!!trans('data.motif_just')!!} <strong style='color: red;'> *</strong></label>
                    {!! Form::textarea('motif_just', null, ['class' => 'form-control','rows' => '3','placeholder' => "Entrer la  raison de l'absence",'autocomplete' => 'off']) !!}
                    <span class="text-danger" id="motif_justError"></span>
				</div>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Femer</button>
                <button id="valider" type="button" class="btn btn-secondary btn-load" onclick="addAction();">
                    <span class="d-flex align-items-center">
                        <span class="flex-grow-1 me-2">Ajouter</span>
                        <span class="flex-shrink-0" role="status"></span>
                    </span>
                </button>

            </div>
        </form>
    </div>


</div>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script type="text/javascript">
    function addAction() {

        $('#valider').attr("disabled", !0);
        $('#valider .flex-shrink-0').addClass("spinner-border");
        $("div.msgAction").html('').hide(200);
		$('#justifierError').addClass('d-none');
		$('#fichier_justifError').addClass('d-none');
		$('#motif_justError').addClass('d-none');
        $('#libelle_actionError').addClass('d-none');
		var form = $('#formAction')[0];
		var data = new FormData(form);
        $.ajax({
            type: 'POST',
            url: "{{ url('/appeler/actionAddJust/') }}",
			enctype:'multipart/form-data',data: data,processData: false,contentType: false,
            success: function(data) {
                $('#valider').attr("disabled", !1);
                $('#valider .flex-shrink-0').removeClass("spinner-border");
                if (data.response != 1) {
                    $.each(data.response, function(Key, value) {
                        var ErrorID = '#' + Key + 'Error';
                        $(ErrorID).removeClass('d-none');
                        $(ErrorID).text(value);
                    })
                } else {
                    $("div.msgAction").html(
                        '<div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert"><i class="ri-notification-off-line me-3 align-middle"></i> <strong>Infos </strong> Enregistrement réussi. </div>'
                    ).show(200);
                    window.location.reload();
                }
            },
            error: function(data) {}
        });
    }
</script>
