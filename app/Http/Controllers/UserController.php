<?php

namespace App\Http\Controllers;

use App\Enums\UserTypeEnum;
use App\Forms\UserForm;
use App\Models\User;
use App\Services\FlashMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;

class UserController extends Controller
{

    public function index(): View
    {
        $users = User::query()->whereKeyNot(Auth::id())->paginate();

        return view('user.index',['users'=>$users]);
    }

    public function create(FormBuilder $formBuilder):View
    {
        $basic_info_form = $this->_getBasicInfoForm($formBuilder);

        $user_types= UserTypeEnum::cases();

        return view('user.form',compact('user_types','basic_info_form'));
    }

    public function store(Request $request, FormBuilder $form_builder): RedirectResponse
    {
        $form = $this->_getBasicInfoForm($form_builder);

        $form->redirectIfNotValid();

        User::query()->create($form->getFieldValues());

        FlashMessage::success('User created successfully.');

        return to_route('users.index');

    }


    public function edit(User $user,FormBuilder $formBuilder):View
    {
        $basic_info_form = $this->_getBasicInfoForm($formBuilder,$user);

        $user_types= UserTypeEnum::cases();

        return view('user.form',compact('user_types','basic_info_form','user'));
    }


    public function update(User $user, FormBuilder $formBuilder):RedirectResponse
    {

        $form = $this->_getBasicInfoForm($formBuilder,$user);

        $form->redirectIfNotValid();

        $validatedData =  $form->getFieldValues();

        if (empty($validatedData['password'])) {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        FlashMessage::success('User updated successfully');

        return to_route('users.index');
    }


    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json(['status' => 200, 'message' => 'User deleted successfully.']);
    }


    private function _getBasicInfoForm(FormBuilder $form_builder,$user=null): Form {

        return $form_builder->create(UserForm::class, [
            'method' => $user ? 'PUT' : 'POST',
            'url'    => $user ? route('users.update',$user) : route('users.store'),
            'role'   => 'form',
            'class'  => 'row'
        ], [
            'user'  => $user,
            'class' => get_class($this)
        ]);
    }

}
