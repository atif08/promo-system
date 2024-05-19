<?php

namespace App\Http\Controllers\Settings;

use App\Forms\BasicInfoForm;
use App\Forms\UserForm;
use App\Forms\ChangePasswordForm;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\FlashMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;

class ProfileController extends Controller
{
    public function getProfile(Request $request, FormBuilder $form_builder)
    {
        $basic_info_form = $this->_getBasicInfoForm($form_builder);
        $password_form = $this->_getChangePasswordForm($form_builder);

        return view('profile', compact(
            'basic_info_form', 'password_form'
        ));
    }

    public function postProfile(Request $request,User $user, FormBuilder $form_builder) {

        $form = $this->_getBasicInfoForm($form_builder);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $user->name = $request->get('name');
        $user->save();

        FlashMessage::success(__('Successfully updated profile'));

        return redirect('profile');
    }

    public function postChangePassword(Request $request,User $user, FormBuilder $form_builder) {

        $form = $this->_getChangePasswordForm($form_builder);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $password = $request->get('password');
        $user->password = Hash::make($password);
        $user->save();

        FlashMessage::success(__('Successfully changed password. New username/password: ') . $user->email . '/' . $password);

        return redirect('profile');
    }

    private function _getBasicInfoForm(FormBuilder $form_builder): Form {
        $user = Auth::user();
        return $form_builder->create(BasicInfoForm::class, [
            'method' => 'POST',
            'url'    => route('profile.post',$user),
            'role'   => 'form',
            'class'  => 'row'
        ], [
            'user'  => $user,
            'class' => get_class($this)
        ]);
    }

    private function _getChangePasswordForm(FormBuilder $form_builder): Form {
        return $form_builder->create(ChangePasswordForm::class, [
            'method' => 'POST',
            'url'    => route('profile.password.post',Auth::user()),
            'role'   => 'form',
            'class'  => 'row'
        ], [
            'class' => get_class($this)
        ]);
    }
}
