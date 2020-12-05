<div id="exportModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <h3 class="modal-title font-weight-bold">@lang('products.titles.export')</h3>
      </div>
      <div class="modal-body">
          <div class="container">
              <div class="row">
                  <div class="col">
                      <form id="export_form" action="{{ route('export') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <label for="name">@lang('Enter the name of the export'):</label>
                          <input id="name" name="name" type="text" class="form-control" placeholder="@lang('Name')">
                      </form>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal-footer">
          <div class="container">
              <div class="row">
                  <div class="col">
                    <button type="submit" form="export_form" class="btn btn-block btn-success">@lang('common.actions.export')</button>
                  </div>
                  <div class="col">
                    <button type="button" class="btn btn-block btn-danger" data-dismiss="modal">@lang('common.actions.cancel')</button>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>
