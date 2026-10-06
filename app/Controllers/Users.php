<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    private array $baseRules = [
        'username' => 'required|min_length[3]|max_length[50]|regex_match[/^[A-Za-z0-9._-]+$/]',
        'full_name' => 'required|max_length[100]',
    ];

    public function index(): string
    {
        $userModel = new UserModel();

        return view('users/index', [
            'title' => 'User Accounts',
            'activePage' => 'users',
            'users' => $userModel->orderBy('full_name', 'ASC')->findAll(),
        ]);
    }

    public function new(): string
    {
        return view('users/form', [
            'title' => 'New User',
            'activePage' => 'users',
            'user' => null,
        ]);
    }

    public function create()
    {
        $rules = $this->baseRules;
        $rules['username'] .= '|is_unique[users.username]';
        $rules['password'] = 'required|min_length[8]|max_length[72]';

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        (new UserModel())->insert([
            'username' => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'password' => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(site_url('users'))->with('success', 'User account created.');
    }

    public function edit(int $id): string
    {
        $user = (new UserModel())->find($id);
        if ($user === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User not found.');
        }

        return view('users/form', [
            'title' => 'Edit User',
            'activePage' => 'users',
            'user' => $user,
        ]);
    }

    public function update(int $id)
    {
        $model = new UserModel();
        $user = $model->find($id);
        if ($user === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User not found.');
        }

        $rules = $this->baseRules;
        $rules['username'] .= "|is_unique[users.username,id,{$id}]";
        $avatar = $this->request->getFile('avatar');
        if ($avatar !== null && $avatar->getError() !== UPLOAD_ERR_NO_FILE) {
            $rules['avatar'] = 'uploaded[avatar]|max_size[avatar,2048]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]';
        }
        if ((string) $this->request->getPost('password') !== '') {
            $rules['password'] = 'min_length[8]|max_length[72]';
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $data = [
            'username' => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
        ];

        if ((string) $this->request->getPost('password') !== '') {
            $data['password'] = password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        if ($avatar !== null && $avatar->isValid() && ! $avatar->hasMoved()) {
            $uploadPath = FCPATH . 'uploads/avatars';
            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $filename = $avatar->getRandomName();
            $avatar->move(WRITEPATH . 'uploads', $filename);
            service('image')
                ->withFile(WRITEPATH . 'uploads/' . $filename)
                ->fit(320, 320, 'center')
                ->save($uploadPath . '/' . $filename, 85);
            @unlink(WRITEPATH . 'uploads/' . $filename);

            if (! empty($user['avatar'])) {
                $oldAvatar = $uploadPath . '/' . basename($user['avatar']);
                if (is_file($oldAvatar)) {
                    @unlink($oldAvatar);
                }
            }
            $data['avatar'] = $filename;
        }

        $model->update($id, $data);

        return redirect()->to(site_url('users'))->with('success', 'User account updated.');
    }
}
