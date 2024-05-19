@if(isset($date_object))
<div
    class="btn btn-primary float-end"
    id="date-range"
    data-start-date="{{ $date_object->getFromDate()->format('Y-m-d') }}"
    data-end-date="{{ $date_object->getToDate()->format('Y-m-d') }}">
    <i class="fa fa-calendar"></i> | <span>{{ $date_object->displayRange() }}</span>
</div>
@endif