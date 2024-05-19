<script type="text/javascript">
    {{--  DATE RANGE PICKER START  --}}
    $.fn.dateRangePicker = function(callback, options = {}) {
        let ranges = {
            'Today'     : [moment(), moment()],
            'Yesterday' : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '7 Days'    : [moment().subtract(6, 'days'), moment()],
            'This Week' : [moment().startOf('week'), moment().endOf('week')],
            'Last Week' : [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')],
            'This Year' : [moment().startOf('year'), moment()],
            '30 Days'   : [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }

        let startDate = moment($(this).data('start-date'));
        let endDate = moment($(this).data('end-date'));

        let settings = $.extend({
            alwaysShowCalendars: true,
            autoApply: true,
            opens: 'left',
            ranges: ranges,
            startDate: startDate,
            endDate: endDate
        }, options);

        $(this).daterangepicker(settings, function (start, end, label) {
            callback(start, end, label);
        });
    };
    {{--  DATE RANGE PICKER END  --}}

    $.fn.dataTableExt.oSort['numeric_ignore_nan-asc'] = function(x,y) {
        x = numericClean( x );
        y = numericClean( y );

        if (isNaN(x) && isNaN(y)) return 0;
        if (isNaN(x)) return 1;
        if (isNaN(y)) return -1;

        return ((x < y) ? -1 : ((x > y) ? 1 : 0));
    };

    $.fn.dataTableExt.oSort['numeric_ignore_nan-desc'] = function(x,y) {
        x = numericClean( x );
        y = numericClean( y );

        if (isNaN(x) && isNaN(y)) return 0;
        if (isNaN(x)) return 1;
        if (isNaN(y)) return -1;

        return ((x < y) ? 1 : ((x > y) ? -1 : 0));
    };

    function numericClean(input) {
        if (typeof input === 'string') {
            if (input.indexOf('N/A') >= 0) {
                return 'N/A';
            }

            $.each([' ', '<br/>'], function (index, value) {
                input = input.split(value)[0];
            });

            if (input.endsWith('</span>')) {
                input = $(input).text();
            }

            input = input.replace(/[^\d\.\-]/g, '');
        }

        return parseFloat(input);
    }

    window['blend_palette'] = {
        1: ['#7195BB', '#89A7C7', '#A2B9D2', '#BACBDE', '#D2DDE9'],
        2: ['#FF5E5E', '#FF7777', '#FF9090', '#FFAAAA', '#FFC3C3'],
        3: ['#FFFF63', '#FFFF80', '#FFFF9D', '#FFFFBA', '#FFFFD7'],
        4: ['#419673', '#5DA388', '#7AB09D', '#96BDB2', '#B3CAC7'],
    };

    window['blend_range'] = {
        1: [5000, 3500, 2000, 1500, 500],
        2: [80, 60, 40, 20, 5],
        3: [80, 60, 40, 20, 5],
        4: [1000, 500, 200, 100, 50],
    };

    function colorBlendCell(cell, ind) {
        let val = numericClean(cell.text());
        let css = {'text-align': 'center'};
        let prev = null;

        $.each(window['blend_range'][ind], function (key, range) {
            if ((val >= range) && (prev ? val < prev : true)) {
                $.extend(css, {
                    'background-color': window['blend_palette'][ind][key]
                });

                if (key <= 1) {
                    $.extend(css, {'color': '#FFFFFF'});
                }

                if (key === 0) {
                    $.extend(css, {'font-weight': 'bold'});
                }

                return false;
            }
            prev = range;
        });

        cell.css(css);
    }
</script>
