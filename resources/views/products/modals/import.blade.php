<div id="importModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <h3 class="modal-title"><b>@lang('products.titles.import')</b></h3>
      </div>
      <div class="modal-body">
          <div class="container">
              <div class="row">
                  <div class="col">
                      <form id="import_form" action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <input name="import_file" type="file">
                      </form>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal-footer">
          <div class="container">
              <div class="row">
                  <div class="col">
                    <button type="submit" form="import_form" class="btn btn-block btn-success">{{ ucfirst(trans('import')) }}</button>
                  </div>
                  <div class="col">
                    <button type="button" class="btn btn-block btn-danger" data-dismiss="modal">{{ ucfirst(trans('cancel')) }}</button>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>
