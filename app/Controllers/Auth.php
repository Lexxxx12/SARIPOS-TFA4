<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if ($this->request->getMethod() === 'POST') {
            if (! $this->validate([
                'username' => 'required|max_length[50]',
                'password' => 'required|max_length[72]',
            ])) {
                return redirect()->back()->withInput();
            }

            $user = (new UserModel())->where('username', trim((string) $this->request->getPost('username')))->first();
            if ($user === null || ! password_verify((string) $this->request->getPost('password'), (string) $user['password'])) {
                return redirect()->back()->withInput()->with('error', 'The username or password is incorrect.');
            }

            session()->regenerate();
            session()->set([
                'userId' => (int) $user['id'],
                'username' => $user['username'],
                'fullName' => $user['full_name'],
                'isLoggedIn' => true,
            ]);

            $destination = session()->get('redirectAfterLogin') ?: site_url('customers');
            session()->remove('redirectAfterLogin');

            return redirect()->to($destination)->with('success', 'Welcome back, ' . $user['full_name'] . '.');
        }

        return view('auth/login', [
            'title' => 'Staff login',
            'activePage' => '',
        ]);
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to(site_url('login'))->with('success', 'You have been logged out.');
    }
}
