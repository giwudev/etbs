<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="modal-content">
    <div class="modal-header card-header">
        <h5 class="modal-title d-flex justify-content-center" id="varyingcontentModalLabel"> Importer les élèves via un ficher excel:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <strong>
            <div class="msgAction"></div>
        </strong>
        <form id="formAction" action="{{ route('frequenter.importEleve') }}" class="needs-validation" method="post"  novalidate enctype='multipart/form-data'>
            @csrf()
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="justifier" class="form-label">Sélectionnez un fichier Excel :</label>
                    <input type="file" class="form-control" id="fichier_excel" name="fichier_excel" accept=".xls, .xlsx">
                    <span class="text-danger" id="justifierError"></span>
                </div>

                <b class="text-danger"> <u>NB </u>: Ce fichier doit contenir exclusivement la listes des élèves à ajouter à la promotion {{$promotion->libelle_pro}} .</b>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <div>
                    <a target="_blank" href="{{ asset('document/testimport.xlsx') }}"  class="btn btn-warning">Telecharger un exemplaire &nbsp; <i class="ri-download-2-fill"></i></span> </a>
                </div>
                <div>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Femer</button>
                    <button type="submit" id="valider" type="button" class="btn btn-secondary btn-load">
                        <span class="d-flex align-items-center">
                            <span class="flex-grow-1 me-2">Ajouter</span>
                            <span class="flex-shrink-0" role="status"></span>
                        </span>
                    </button>
             </div>
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
    /*function addAction() {
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
            url: "{{ url('/frequenter/importEleve/') }}",
            enctype: 'multipart/form-data',
            data: data,
            processData: false,
            contentType: false,
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
    }*/

    
    
function addAction() {

    console.log()
    $('#valider').attr("disabled", true);
    $('#valider .flex-shrink-0').addClass("spinner-border");
    $("div.msgAction").html('').hide(200);
    $('#justifierError').addClass('d-none');
    $('#fichier_excelError').addClass('d-none');
    $('#motif_justError').addClass('d-none');
    $('#libelle_actionError').addClass('d-none');
    var form = $('#formAction')[0];
    var data = new FormData(form);
    $.ajax({
        type: 'POST',
        url: "{{ url('/frequenter/importEleve/') }}",
        data: data,
        processData: false,
        contentType: false,
        dataType: 'json', 
        success: function (data) {
            $('#valider').attr("disabled", false);
            $('#valider .flex-shrink-0').removeClass("spinner-border");
            console.log(data);
            if (data.error) {
                console.error(data.error); 
            } else if (data.success) {
                $("div.msgAction").html(
                    '<div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert"><i class="ri-notification-off-line me-3 align-middle"></i> <strong>Infos </strong> Enregistrement réussi. </div>'
                ).show(200);
                window.location.reload();
            }
        },
        error: function (data) {
            console.log(data);        }
    });
}


</script>
