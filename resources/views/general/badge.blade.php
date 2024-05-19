@php $base = $base ?? 0 @endphp

@if($column < $base)

    <span class="badge text-secondary bg-danger text-white">
        <i class="fa fa-arrow-down"></i> {{ format_kpi($column, $type, $currency ?? 'EUR') }}
    </span>

@elseif($column > $base)

    <span class="badge text-secondary bg-success text-white">
        <i class="fa fa-arrow-up"></i> {{ format_kpi($column, $type, $currency ?? 'EUR') }}
    </span>

@else

    <span class="badge text-secondary bg-warning text-white">
        <i class="fa fa-arrows-alt-v"></i> {{ format_kpi($column, $type, $currency ?? 'EUR') }}
    </span>

@endif
