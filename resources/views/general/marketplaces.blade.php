<!-- Right Sidebar -->
<div class="right-bar">

    <div data-simplebar class="h-100">

        <div class="rightbar-title d-flex align-items-center px-3 py-4">

            <h5 class="m-0 me-2">{{ __('Active Accounts') }}</h5>
            <a href="javascript:;" class="right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div>

        <div id="marketplace-search">
            <span class="marketplace-search"><i class="fas fa-search"></i></span>
            <input type="text" class="account-search pull-left" placeholder="{{ __('Search by Name') }}"/>
        </div>

        <ul class="p-3 list-group-flush marketplace-list">

            @foreach($accounts as $account)

                @if($account->id === $current_account->id) @continue @endif

                <li class="list-group-item dropdown-item" style="padding: 5px">
                    <input class="form-check-input me-1 mp-option" type="radio" value="{{ $account->id }}"
                           name="mp_option" id="mp-option-{{ $account->id }}">

                    <span class="me-2 fi fi-{{ strtolower( ($account->marketplace->code === 'UK') ? 'gb' : $account->marketplace->code ) }}"></span>

                    <span class="mp-name">{{ $account->parent->name . ' / ' . ($account->name ?: $account->seller_id) }}</span>
                </li>

            @endforeach

        </ul>

    </div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->
