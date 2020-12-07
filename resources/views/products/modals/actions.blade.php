@include('products.modals.import')
@include('products.modals.export')
<div id="actionsModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <h3 class="modal-title font-weight-bold">@lang('Actions')</h3>
      </div>
      <div class="modal-body d-flex justify-content-around">
        <a class="text-dark" data-dismiss="modal" data-toggle="modal" data-target="#importModal"><i class="fas fa-3x fa-upload sel hvr-grow" data-toggle="tooltip" data-placement="bottom" title="@lang('products.titles.import')"></i></a>
        <a class="text-dark" data-dismiss="modal" data-toggle="modal" data-target="#exportModal"><i class="fas fa-3x fa-download sel hvr-grow" data-toggle="tooltip" data-placement="bottom" title="@lang('products.titles.export')"></i></a>
        <a class="text-dark" href="{{ route('reports.summary') }}"><i class="fas fa-3x fa-chart-line sel hvr-grow" data-toggle="tooltip" data-placement="bottom" title="@lang('products.titles.report')"></i></a>
        <a class="text-dark" href="{{ route('products.create') }}"><i class="fas fa-3x fa-plus-circle sel hvr-grow" data-toggle="tooltip" data-placement="bottom" title="@lang('products.titles.create')"></i></a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-block btn-danger" data-dismiss="modal">@lang('common.actions.cancel')</button>
      </div>
    </div>
  </div>
</div>


