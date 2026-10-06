<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    private array $rules = [
        'full_name' => 'required|max_length[100]',
        'email' => 'required|valid_email|max_length[100]',
        'phone' => 'permit_empty|max_length[20]|regex_match[/^[0-9+() .-]+$/]',
    ];

    public function index(): string
    {
        $customerModel = new CustomerModel();

        return view('customers/index', [
            'title' => 'Customer Accounts',
            'activePage' => 'customers',
            'customers' => $customerModel->orderBy('full_name', 'ASC')->findAll(),
        ]);
    }

    public function new(): string
    {
        return view('customers/form', [
            'title' => 'New Customer',
            'activePage' => 'customers',
            'customer' => null,
        ]);
    }

    public function create()
    {
        if (! $this->validate($this->rules)) {
            return redirect()->back()->withInput();
        }

        (new CustomerModel())->insert([
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email' => trim((string) $this->request->getPost('email')),
            'phone' => trim((string) $this->request->getPost('phone')) ?: null,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(site_url('customers'))->with('success', 'Customer account created.');
    }

    public function edit(int $id): string
    {
        $customer = (new CustomerModel())->find($id);
        if ($customer === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Customer not found.');
        }

        return view('customers/form', [
            'title' => 'Edit Customer',
            'activePage' => 'customers',
            'customer' => $customer,
        ]);
    }

    public function update(int $id)
    {
        $model = new CustomerModel();
        if ($model->find($id) === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Customer not found.');
        }

        if (! $this->validate($this->rules)) {
            return redirect()->back()->withInput();
        }

        $model->update($id, [
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email' => trim((string) $this->request->getPost('email')),
            'phone' => trim((string) $this->request->getPost('phone')) ?: null,
        ]);

        return redirect()->to(site_url('customers'))->with('success', 'Customer account updated.');
    }
}
