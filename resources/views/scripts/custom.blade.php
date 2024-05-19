<script type="text/javascript">
    window.momentFormat = 'Y-MM-DD';
    window.dashboardFilters = {};

    @if(isset($date_object))
        window.dashboardFilters['from_date'] = "{{ $date_object->getFromDate()->format('Y-m-d') }}";
        window.dashboardFilters['to_date'] = "{{ $date_object->getToDate()->format('Y-m-d') }}";
    @endif

    loadMenu();

    function loadMenu() {
        let parameters = {};
        @if(request()->has('t'))
            parameters['t'] = '{{ request()->get('t') }}';
        @endif
        makeGetCall("{{ url('general/menus') }}", parameters, function (response) {
            $('#side-menu').html(response)
        });
    }

    function redrawDataTable(tableId = null) {
        let _tableId = tableId ? tableId : $('.dt-wrapper').attr('id');
        if (window.dataTables[_tableId]) {
            window.dataTables[_tableId].ajax.reload()
        }
    }

    function displayValidationErrors(container, data) {

        if (container.find('.validation-container').length < 1) {
            container.prepend('<div class="validation-container"></div>');
        }

        const errors = data.responseJSON ? data.responseJSON.errors : data.errors;

        var html = '<ul class="list-unstyled">';

        $.each(errors, function (key, error) {
            html += '<li>- ' + error + '</li>';

            if (container.find('#' + key).length > 0) {
                container.find('#' + key).closest('.form-group').addClass('has-error');
            }
        });

        html += '</ul>';

        container.find('.validation-container').html(html);
    }

    function makeGetCall(url, data = {}, callback) {
        $.ajax({
            url: url,
            type: "GET",
            data: data,
            success: function (response) {
                if (response) {
                    callback(response);
                }
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function success_alert($message) {
        Swal.fire('Success', $message, 'success');
    }

    function error_alert($message) {
        Swal.fire('Error', $message, 'error');
    }

    function copy(text) {
        event.preventDefault();
        navigator.clipboard.writeText(text);
        alertify.success("Copied: " + text);
    }

    @if(!($settings_page ?? false))
        // <<<<<<<<<<<<<<<<<<<<<< Marketplace >>>>>>>>>>>>>>>>>>
        function loadMarketplaces(callback = null) {
            makeGetCall("{{ url('general/marketplaces') }}", window.dashboardFilters, function (response) {
                if (callback) {
                    callback(response);
                }
            });
        }

        $(document).on('change', '.mp-option', function (e) {
            e.preventDefault();
            let account_id = $(this).val();
            if (window.defaultSettings.currentAccountId !== account_id) {
                $.post('{{ url('general/marketplace') }}', {
                    ... window.dashboardFilters,
                    account_id: account_id,
                }, function (response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert("Something went wrong");
                    }
                });
            }
        });

        $(document).on('click', '.marketplace-wrapper', function (e) {
            e.preventDefault();
            loadMarketplaces(function (response) {
                $('.right-sidebar-container').html(response);
                $('body').toggleClass('right-bar-enabled');
            })
        });

        $(document).on('keyup', '#marketplace-search input', function () {
            let value = $(this).val().toLowerCase();
            let mpRows = $(".marketplace-list li");
            mpRows.filter(function () {
                $(this).toggle($(this).find('.mp-name')
                    .text().toLowerCase().indexOf(value) > -1)
            });
        });
        // <<<<<<<<<<<<<<<<<<<<<< Marketplace >>>>>>>>>>>>>>>>>>
    @endif

    // <<<<<<<<<<<<<<<<<<< DateRangePicker >>>>>>>>>>>>>>>>>>
    $('#date-range').dateRangePicker(function (start, end, label) {
        let title = label;
        if (label === 'Custom Range') {
            title = start.format('DD-MM-Y') + ' - ' + end.format('DD-MM-Y');
        }

        let format = 'Y-MM-DD';
        window.dashboardFilters['from_date'] = start.format(format);
        window.dashboardFilters['to_date'] = end.format(format);
        window.dashboardFilters['date_range'] = label;

        // SAVE DATE

        $('#date-range span').html(title);

        if (window['loadChart']) {
            window['loadChart']();
        }

        if (window['loadDashboard']) {
            window['loadDashboard']();
        }

        redrawDataTable();
    });
    // <<<<<<<<<<<<<<<<<<< DateRangePicker >>>>>>>>>>>>>>>>>>

    // <<<<<<<<<<<<<<<<<<< UserTokenSharing >>>>>>>>>>>>>>>>>>
    $(document).on('click', '.btn-share, .btn-token-renew', function (e) {
        e.preventDefault();
        let modal = $('#general-modal');
        $.get($(this).data('url'), {}, function (response) {
            modal.find('.modal-content').html(response);
            modal.modal('show');
        }).fail(function (r) {
            error_alert('Something Went Wrong')
        });
    });

    $(document).on('click', '.btn-token-copy', function (e) {
        e.preventDefault();
        let text = $('#general-modal').find('textarea').text();
        navigator.clipboard.writeText(text);

        let button = $(this);
        // Change the button text to "Copied!"
        button.html('<i class="fa fa-copy"></i> | ' + '{{ __('Copied!') }}');
        // Reset the button text after a brief delay
        setTimeout(function () {
            button.html('<i class="fa fa-copy"></i> | ' + '{{ __('Copy Link') }}');
        }, 3000); // Reset after 3 second
    });

    $(document).on('click', '.btn-token-delete', function (e) {
        e.preventDefault();
        let data_url = $(this).data('url');
        Swal.fire({
            title: 'Are you sure?',
            text: 'No one will be able to access dashboard with this link!',
            icon: 'warning',
            showCancelButton: !0,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
            confirmButtonClass: 'btn btn-success mt-2',
            cancelButtonClass: 'btn btn-danger ms-2 mt-2',
            buttonsStyling: !1
        }).then(function (input) {
            if (input.isConfirmed) {
                $.get(data_url, {}, function (response) {
                    success_alert("{{ __('Deleted.') }}");
                    $('#user-token-modal').modal('hide');
                }).fail(function () {
                    error_alert('Something Went Wrong');
                });
            }
        })
    });
    // <<<<<<<<<<<<<<<<<<< UserTokenSharing >>>>>>>>>>>>>>>>>>
</script>
