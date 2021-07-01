<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Users;

class UsersController extends Controller
{
    private function validatorInput($request)
    {
        $rules = [
            'username' => 'required|min:3|max:250',
            'password' => 'required|min:6|max:250',
        ];
        $messages = [
            'username.required' => 'Tài khoản là trường bắt buộc',
            'username.min' => 'Tài khoản chứa ít nhất 3 ký tự',
            'username.max' => 'Tài khoản có nhiều nhất 250 ký tự',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
            'password.max' => 'Mật khẩu có nhiều nhất 250 ký tự',
        ];

        return Validator::make($request, $rules, $messages);
    }

    public function loginGet() {
        return view('users.login');
    }

    public function loginPost(Request $request)
    {
        $validator = $this->validatorInput($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Users::login($request['username'], $request['password']);

        if (is_null($user)) {
            return redirect()->back()->withInput()->withErrors(new MessageBag(['error' => 'Đăng nhập thất bại']));
        }

        Auth::loginUsingId($user->id, false);

        return redirect()->route('overview.index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login.get');
    }

    public function changePassword(){
        return view('users.changePassword');
    }

    public function changePasswordPost(Request $request){
        $rules = [
            'password_old' => 'required|min:3|max:250',
            'password_new' => 'required|min:3|max:250',
            'password_confirm' => 'max:250|same:password_new',
        ];
        $messages = [
            'password_old.required' => 'Mật khẩu là trường bắt buộc',
            'password_old.min' => 'Mật khẩu phải chứa ít nhất 6 ký tự',
            'password_old.max' => 'Mật khẩu có nhiều nhất 250 ký tự',
            'password_new.required' => 'Mật khẩu mới là trường bắt buộc',
            'password_new.min' => 'Mật khẩu mới phải chứa ít nhất 6 ký tự',
            'password_new.max' => 'Mật khẩu mới có nhiều nhất 250 ký tự',
            'password_confirm.max' => 'Mật khẩu có nhiều nhất 250 ký tự',
            'password_confirm.same' => 'Mật khẩu không trùng khớp',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = Users::login(Auth::user()->username, $request['password_old']);
        
        if (is_null($user)) {
            return redirect()->back()->withInput()->withErrors(new MessageBag(['password_old' => 'Mật khẩu cũ không đúng']));
        }

        $user = Users::find(Auth::user()->id);
        if (is_null($user)) {
            return redirect()->back()->withErrors(new MessageBag(['error' => 'Không tìm thấy tài khoản']));
        }

        if (!empty($request->input('password_old'))) {
            $user->password = Hash::make($request->input('password_old'));
        }

        if ($user->save()) {
            return redirect()->route('admin.change_password.get')->withErrors(new MessageBag(['success' => 'Đổi mật khẩu thành công']));
        }

        return redirect()->back()->withInput()->withErrors(new MessageBag(['error' => 'Đổi mật khẩu thất bại']));
    }
}
