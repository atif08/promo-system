window.dataTables = {};
window.currentDataTable = '';
window.dtOptions = {};
window.dtFilters = {};
window.callbacks = {};

window.dtParameters = {
    allowedHeaders: ['Origin', 'X-Requested-With', 'Content-Type', 'Accept'],
    bStateSave: true,
    iStateDuration: 0,
    aLengthMenu: [10, 25, 50, 100],
    bPaginate: 'false',
    bAutoWidth: 'false',
    bFilter: 'false',
    fixedHeader: {
        header: 'true',
        headerOffset: 60
    },
    bProcessing: true,
    bServerSide: true,
    sScrollX: true,
    bScrollCollapse: true,
    language: {
        "lengthMenu": "_MENU_",
        "infoEmpty": "No records available",
        "infoFiltered": "(filtered from _MAX_ total records)",
        "search": ""

    }
}

function loadDataTable(tableId, dtParams) {
    let this_table_cbs = window.callbacks[tableId] ? window.callbacks[tableId] : {};
    let callbacks = $.extend({}, {
        fnServerParams: function (parameters) {
            $.each(window.dashboardFilters, function (key, value) {
                parameters[key] = value;
            });

            if ((window.dashboardFilters.hasOwnProperty("from_date")) && window.dashboardFilters.hasOwnProperty("to_date")) {
                parameters.date_range = [
                    window.dashboardFilters['from_date'], window.dashboardFilters['to_date']
                ];
            }

            if (window.dtFilters) {
                parameters.custom_filters = window.dtFilters;
            }
        },
    }, this_table_cbs);

    let dtOptions = {
        ...window.dtParameters,
        ...dtParams,
        ...callbacks
    }

    window.dtOptions = dtOptions;
    window.dataTables[tableId] = $('#' + tableId).DataTable(dtOptions);
    window.currentDataTable = tableId;
}
