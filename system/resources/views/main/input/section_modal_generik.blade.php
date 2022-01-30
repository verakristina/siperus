<div class="modal primary" id="modal-input-generik" role="dialog" aria-labelledby="barangbuktiModalLabel" >
  <div class="modal-dialog modal-md" role="document">
  <form action="" id="form-input-generik" name="barangbuktiform" enctype="multipart/form-data" method="post">
  <div class="modal-content">
	<div class="modal-header modal-primary">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title modal-primary" id="my-modal-label">@yield('modal_name')</h4>
	</div>
	<div class="modal-body">
	<div class="row">
		 @yield('modal_input')

  </div>
	</div>
	<div class="modal-footer">
	<button type="button" class="btn btn-danger"  data-dismiss="modal">Close</button>
	<button type="submit" class="btn btn-danger"  id="submiter">Simpan</button>
	</div>
  </div>
  <input type="hidden" name="_token" value="{{csrf_token()}}">
  </form>
  </div>
</div>

