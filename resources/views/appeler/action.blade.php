
<meta name="csrf-token" content="{{csrf_token()}}">

<div class="modal-content">
	<div class="modal-header card-header">
		<h5 class="modal-title" id="varyingcontentModalLabel">Gérer les actions</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
		<strong><div class="msgAction"></div></strong>
		<form id="formAction" class="needs-validation" novalidate>
			{!! Form::hidden('id_menu',null,["class"=>"form-control"]) !!}
			@csrf()
			
			<div class="modal-footer">
				<button type="button" class="btn btn-light" data-bs-dismiss="modal">Femer</button>
				
					<button id="valider" type="button"  class="btn btn-danger btn-load" onclick="addAction();"> 
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
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});
</script>
<script type="text/javascript">
	
	function addAction(){

		$('#valider').attr("disabled",!0);
		$('#valider .flex-shrink-0').addClass("spinner-border");
		$("div.msgAction").html('').hide(200);

		$('#libelle_actionError').addClass('d-none');
		$('#dev_actionError').addClass('d-none');
		$.ajax({
			type: 'POST',
			url: '{{ url("/menu/actionUpdate/")}}',
			data: $('#formAction').serialize(),
			success: function(data) {
				$('#valider').attr("disabled",!1);
				$('#valider .flex-shrink-0').removeClass("spinner-border");
				if(data.response!=1){
					$.each(data.response, function(Key, value){
						var ErrorID = '#'+Key+'Error';
						$(ErrorID).removeClass('d-none');
						$(ErrorID).text(value);
					})
				}else{
					$("div.msgAction").html('<div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert"><i class="ri-notification-off-line me-3 align-middle"></i> <strong>Infos </strong> Enregistrement réussi. </div>').show(200);
					window.location.reload();
				}
			},
			error: function(data) {}
		});
	}
	
	$(document).on('click', '.close', function () {
		id = $(this).data('id');
		$("div.msgAction").html('').hide(200);
		$.ajax({
			url : '{{ url("menu/actionDelete")}}',
			dataType:"json", 
			type : 'POST',
			data: {id_action: id},
			success : function(data){
				if(data.response == 1){
					$('.tr-'+id).addClass('d-none');
					$("#varyingcontentModalLabel").animate({ scrollTop: 0 }, "fast");
					$("div.msgAction").html('<div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert"><i class="ri-notification-off-line me-3 align-middle"></i> <strong>Infos </strong> Suppression réussie. </div>').show(200);
				}else{
					$("div.msgAction").html('<div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert"><i class="ri-notification-off-line me-3 align-middle"></i> <strong>Infos </strong> Echec de suppression. </div>').hide(200);
				}
			},
			errors: function(){
				$("div.msgAction").html('<div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert"><i class="ri-notification-off-line me-3 align-middle"></i> <strong>Infos </strong> Echec de suppression. </div>').hide(200);
			}
		});
	});
</script>
