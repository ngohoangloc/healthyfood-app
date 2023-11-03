<?php

namespace App\Http\Controllers;

use App\Repositories\AccountRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $accountRepository;

    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function index()
    {
        if (session()->has('user')) {
            if (session()->get('user.role_id') == 1)
                return redirect('/');
            else
                return redirect('/cashier');
        } else
            return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];

        $account = $this->accountRepository->getByUsername($credentials['username']);
        if (!empty($account))
            if($account->active === 0)
            {
                return redirect()->back()->with('error', 'Tài khoản đã bị khóa. Hãy liên hệ quản trị viên!');
            }
            else
            {
                if (Hash::check($credentials['password'], $account->password)) {
                    session()->put('user', $account->user);

                    if (session()->get('user.role_id') == 1)
                        return redirect('/');
                    else
                        return redirect('/cashier');
                } else {
                    return redirect()->back()->with('warning', 'Mật khẩu không chính xác!');
                }
            }
        else {
            return redirect('/auth/login')->with('error', 'Tài khoản không tồn tại!');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect('/auth/login')->with('warning', 'Đã đăng xuất tài khoản!');
    }
}
