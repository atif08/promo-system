<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    /** @var User */
    protected $user; // logged-in user
    public function __construct() {
        $this->middleware(['auth']);

        $this->middleware(function (Request $request, $next) {
            $this->request = $request;
            $this->setUserProperties($request);
            return $next($request);
        });
    }
    protected function setUserProperties($request) {
        $this->user = Auth::user();
    }
}
