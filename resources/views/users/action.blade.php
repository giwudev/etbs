<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="modal-content">
    <div class="modal-header card-header">
        <h5 class="modal-title d-flex justify-content-center" id="varyingcontentModalLabel"> Importer les professeurs
            via un ficher excel:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <strong>
            <div class="msgAction"></div>
        </strong>
        <form id="formSearch" action="{{ route('users.importProf') }}" class="needs-validation" method="post"
            novalidate enctype='multipart/form-data'>
            @csrf()

            <div class="col-md-12">
            <div class="mb-3">
                <label for="id_role" class="form-label">{{trans('data.etablis_id')}}<strong style='color: red;'> *</strong></label>

                <select name="etablis" id="etablis" class="form-select allselect" required="required">
                    <option value="">Sélectionner un établissement</option>
                    @foreach ($listEcole_id as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                  </select>
            </div>
            </div>



            <div class="col-md-12">
                <div class="mb-3">
                <select name="promo" id="promo" class="form-select allselect" onchange="f()" required="required">
                    <option value="">Sélectionner une promotion</option>
        
                  </select>
                </div>
            </div>te
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="justifier" class="form-label">Sélectionnez un fichier Excel :</label>
                    <input type="file" class="form-control" id="fichier_excel" name="fichier_excel" accept=".xls, .xlsx"
                        required>
                    <span class="text-danger" id="justifierError"></span>
                </div>
                <b class="text-danger"> <u>NB </u>: Ce fichier doit contenir exclusivement la listes des professeus de
                  la promotion <span id="selectedPromo"></span> .</b>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <div>
                    <a target="_blank" href="{{ asset('document/testimportProf.xlsx') }}"
                        class="btn btn-warning">Telecharger un exemplaire &nbsp; <i
                            class="ri-download-2-fill"></i></span> </a>
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

    $(document).on('change', '#etablis', function() {
        etablisId = $('#etablis').val();
        console.log('Etablissement sélectionné :', etablisId);
        $.ajax({
            type: 'GET',
            url: '{{ url('users/findPromo/')}}/'+etablisId, // Utilisez la route avec l'ID
            dataType: 'json',
            success: function(data) {
            console.log(data);
            promotionsDropdown = $('#promo'); // Utilisez le bon ID
            promotionsDropdown.empty();
            promotionsDropdown.append($('<option>').text('Sélectionner une promotion').attr('value', ''));
            $.each(data.promotions, function(id, name) {
                promotionsDropdown.append($('<option>').text(name).attr('value', id));
            });
         
        },
            error: function(xhr, textStatus, errorThrown) {
                console.log(xhr.responseText); 
            }
        });
    });


        function f() {
            var selectedPromotion = promotionsDropdown.find(':selected').text();
            console.log('promo', selectedPromotion)
            $('#selectedPromo').text(selectedPromotion);
            }
</script>
