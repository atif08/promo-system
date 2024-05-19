<?php

namespace App\Http\Controllers\PromoCodes;

use App\DataTables\Products\ProductsDataTable;
use App\Enums\UserTypeEnum;
use App\Forms\PromoCodeForm;
use App\Forms\UserForm;
use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use App\Models\User;
use App\Services\FlashMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\QueryDataTable;

class PromoCodesController extends Controller
{

    public function index(): View
    {
        $promo_codes = PromoCode::query()->paginate();

        return view('promo.index',compact('promo_codes'));
    }

    public function create(FormBuilder $formBuilder):View
    {
        $basic_info_form = $this->_getBasicInfoForm($formBuilder);

        return view('promo.form',compact('basic_info_form'));
    }

    public function store(Request $request, FormBuilder $form_builder): RedirectResponse
    {
        $form = $this->_getBasicInfoForm($form_builder);

        $form->redirectIfNotValid();

        PromoCode::query()->create($form->getFieldValues());

        FlashMessage::success('Promo Code created successfully.');

        return to_route('promo-codes.index');

    }


    public function edit(PromoCode $promo_code,FormBuilder $formBuilder):View
    {
        $basic_info_form = $this->_getBasicInfoForm($formBuilder,$promo_code);

        return view('promo.form',compact('basic_info_form','promo_code'));
    }


    public function update(PromoCode $promo_code, FormBuilder $formBuilder):RedirectResponse
    {

        $form = $this->_getBasicInfoForm($formBuilder,$promo_code);

        $form->redirectIfNotValid();

        $validatedData =  $form->getFieldValues();

        if (empty($validatedData['password'])) {
            unset($validatedData['password']);
        }

        $promo_code->update($validatedData);

        FlashMessage::success('User updated successfully');

        return to_route('promo-codes.index');
    }


    public function destroy(PromoCode $promo_code): JsonResponse
    {
        $promo_code->delete();

        return response()->json(['status' => 200, 'message' => 'User deleted successfully.']);
    }


    private function _getBasicInfoForm(FormBuilder $form_builder,$promo_code=null): Form {

        return $form_builder->create(PromoCodeForm::class, [
            'method' => $promo_code ? 'PUT' : 'POST',
            'url'    => $promo_code ? route('promo-codes.update',$promo_code) : route('promo-codes.store'),
            'role'   => 'form',
            'class'  => 'row'
        ], [
            'promo_code'  => $promo_code,
            'class' => get_class($this)
        ]);
    }
}
