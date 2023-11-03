<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Repositories\AccountRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeComponent extends Component
{
    use WithPagination;
    public $state = [];

    public $showEditModal = false;
    public $updateEmployee;
    public $employeeIdBeingRemoved;
    public $searchInput;

    private $userRepository;
    private $accountRepository;
    private $roleRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
        $this->accountRepository = new AccountRepository;
        $this->roleRepository = new RoleRepository;
    }

    public function render()
    {
        $employees = $this->userRepository->getAll($this->searchInput);
        $roles = $this->roleRepository->getAll();
        return view('livewire.admin.employee-component', [
            'employees' => $employees,
            'roles' => $roles
        ]);
    }

    public function addEmployee()
    {
        $this->state = [
            'active' => true
        ];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createEmployee()
    {
        $validatedData = Validator::make($this->state, [
            'fullName'=> 'required|max:50',
            'phone' => "required|digits:10|unique:users,phone,NULL,id,deleted_at,NULL",
            'address' => 'required|max:100',
            'role_id' => 'required',
            'username' => "required|alpha_num|min:5|max:20|unique:accounts,username,NULL,id,deleted_at,NULL",
            'password' => 'required|min:5|max:20',
            'password_again' => 'required|same:password'
        ])->validate();

        $validatedData['active'] = $this->state['active'];

        try{
            $newEmployee = $this->accountRepository->create($validatedData);
            $this->dispatchBrowserEvent('hide-form', [
                'message' => 'Đã thêm nhân viên ' . $newEmployee->user->fullName . ' thành công!',
            ]);
        }
        catch(\Exception $e){
            $this->dispatchBrowserEvent('toastr-error', [
                'message' => 'Đã có lỗi xảy ra!',
            ]);
        }
    }

    public function editEmployee(User $employee)
    {
        $this->state = $employee->toArray();

        $this->state['username'] = $employee->account->username;
        $this->state['active'] = $employee->account->active;

        $this->updateEmployee = $employee;

        $this->showEditModal = true;

        $this->dispatchBrowserEvent('show-form');
    }

    public function updateEmployee()
    {
        $validatedData = Validator::make($this->state, [
            'fullName'=> 'required|max:50',
            'phone' => "required|digits:10|unique:users,phone,{$this->updateEmployee->id},id,deleted_at,NULL",
            'address' => 'required|max:100',
            'role_id' => 'required',
            'username' => "required|alpha_num|min:5|max:20|unique:accounts,username,{$this->updateEmployee->account->id},id,deleted_at,NULL",
        ])->validate();

        $validatedData['active'] = $this->state['active'];

        $this->accountRepository->update($this->updateEmployee->account->id, $validatedData);

        $this->dispatchBrowserEvent('hide-form', [
            'message' => 'Đã cập nhật nhân viên ' . $validatedData['fullName'] . ' thành công!',
        ]);

        return redirect()->back();
    }

    public function confirmEmployeeRemoval($employeeId)
    {
        $this->employeeIdBeingRemoved = $employeeId;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function removeEmployee()
    {
        $this->accountRepository->delete($this->employeeIdBeingRemoved);

        $this->dispatchBrowserEvent('hide-delete-modal', [
            'message' => 'Xóa nhân viên thành công!',
        ]);
    }
}
