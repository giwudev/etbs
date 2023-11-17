<div class="modal-content">
	<div class="modal-body text-center p-4">
		<div class="mt-2">
			<h4 class="mb-3 red-g" > {{trans('data.titre_delete')}} <i class="bx bxs-trash"></i></h4>
			<p class="text-muted mb-4"> {{$item}}</p>
			@if($trv)
				<form action="{{url('/frequenter/DeletePromo')}}" method="POST">
					@csrf()
					<button type="button" class="btn btn-light" data-bs-dismiss="modal">Non</button>
					<button id="submit" class="btn btn-danger">Oui</button>
				</form>
				<div class="hstack gap-2 justify-content-center"></div>
			@else
				<button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
			@endif
		</div>
	</div>
</div>
