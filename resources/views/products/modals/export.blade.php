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
                      <a class="btn btn-block btn-outline-warning" href="{{ route('products.export') }}">@lang('common.actions.download')</a>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal-footer">
          <div class="container">
              <div class="row">
                  <div class="col">
                    <button type="button" class="btn btn-block btn-danger" data-dismiss="modal">@lang('common.actions.cancel')</button>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>
