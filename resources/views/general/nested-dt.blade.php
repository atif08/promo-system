<div class="nested-datatable">
    <div class="row">
        <div class="table table-responsive">
            {!! $data_table->table(['class' => 'table table-bordered']) !!}
        </div>
    </div></div>

<script>
    window.dataTables["{{ $data_table->getTableId() }}"] = $('#' + "{{ $data_table->getTableId() }}")
        .DataTable($.extend(
            {},
            window.dtParameters,
            {!! json_encode($data_table->getDTParameters()) !!}
        ));
</script>
