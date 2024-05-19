<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller {

    public function getNavigationMenu(Request $request) {
        $this->settings_page = true;
        $menus = config('menu')[$this->user->user_type] ?? [];
        return view('general.menus', compact('menus'));
    }

    public function getMarketplaceSwitcher(Request $request) {
        abort_if($this->user->isSeller(), 403);
        $accounts = $this->user->getActiveMarketplaces()->keyBy('id');
        return $this->renderView('general.marketplaces', compact('accounts'));
    }

    public function postChangeMarketplace(Request $request) {
        abort_if($this->user->isSeller(), 403);
        $request->validate(['account_id' => ['required']]);
        $this->user->setUserAttribute('current_account', $this->current_account->id);
        return response()->json(['success' => true]);
    }
}
