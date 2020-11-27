<div id="importModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <h3 class="modal-title font-weight-bold">{{ __('Import products') }}</h3>
      </div>
      <div class="modal-body">
          <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <input name="importFile" type="file">
              <button type="submit" class="btn btn-block btn-success mt-3">{{ __('Import') }}</button>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-block btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
