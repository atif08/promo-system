<?php

namespace App\Http\Controllers\Settings;

use App\Enums\UserTypeEnum;
use App\Forms\ConnectionForm;
use App\Forms\UserForm;
use App\Http\Controllers\Controller;
use App\Models\Connection;
use App\Models\SpToken;
use App\Models\User;
use App\Services\FlashMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\Form;

class ConnectionsController extends Controller {

    public function create(FormBuilder $formBuilder):View
    {

        $basic_info_form = $this->_getBasicInfoForm($formBuilder);

        $user_types= UserTypeEnum::cases();

        return view('connection.form',compact('user_types','basic_info_form'));

    }

    public function store(Request $request, FormBuilder $form_builder): RedirectResponse
    {
        $form = $this->_getBasicInfoForm($form_builder);

        $form->redirectIfNotValid();

        Connection::query()->create($form->getFieldValues()+['user_id'=>Auth::user()->id]);

        FlashMessage::success('Connection created successfully.');

        return to_route('connections.create');

    }


    private function _getBasicInfoForm(FormBuilder $form_builder): Form {

        return $form_builder->create(ConnectionForm::class, [
            'method' =>  'POST',
            'url'    =>  route('connections.store'),
            'role'   => 'form',
            'class'  => 'row'
        ], [
            'connection'  => '',
            'class' => get_class($this)
        ]);
    }
}
