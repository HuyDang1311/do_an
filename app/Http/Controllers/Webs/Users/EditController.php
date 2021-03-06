<?php

namespace App\Http\Controllers\Webs\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditController extends Controller
{

    /**
     * Show form update car
     *
     * @param Request $request Request
     *
     * @return JsonResponse
     */
    public function show(Request $request)
    {
        try {
            $user = Auth::user();
            return view('web.users.edit')
                ->with([
                    'data' => $user,
                ]);
        } catch (Exception $ex) {
            session()->flash('error', trans('message.users.show_fail'));
            return back();
        }
    }

    /**
     * Update car
     *
     * @param Request $request Request
     *
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        try {
            $data = $request->only([
                'name',
                'email',
                'address',
                'phone_number',
                'username',
                'password',
            ]);
            $user = Auth::user();

            $user->fill($data);
            $user->save();
        } catch (Exception $ex) {
            session()->flash('error', trans('message.users.show_fail'));
            return back()->with(['error' => trans('message.users.update_fail')]);
        }

        session()->flash('message_success', trans('message.users.update_success'));
        return redirect('users/info');
    }
}
