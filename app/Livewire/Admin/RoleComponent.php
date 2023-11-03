<?php

namespace App\Livewire\Admin;

use App\Models\Role;
use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class RoleComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $state = [];
    public $updateRole;
    public $showEditModal= false;
    public $roleIdBeingRemoved;
    public $searchInput;
    private $roleRepository;

    public function __construct()
    {
        $this->roleRepository = new RoleRepository();
    }

    public function render()
    {
        return view('livewire.admin.role-component',[
            'roles' => $this->roleRepository->get($this->searchInput),
        ]);
    }

    public function addRole()
    {
        $this->state = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createRole()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required|max:50|unique:roles,deleted_at,NULL',
            'desc' => 'max:200',
        ])->validate();

        $newRole = $this->roleRepository->create($validatedData);

        $this->dispatchBrowserEvent('hide-form', [
            'message' => 'Đã thêm nhóm người dùng ' . $newRole['name'] . ' thành công!',
        ]);
    }

    public function editRole(Role $role)
    {
        $this->state = $role->toArray();

        $this->updateRole = $role;

        $this->showEditModal = true;

        $this->dispatchBrowserEvent('show-form');
    }

    public function updateRole()
    {
        // dd($this->state);
        $validatedData = Validator::make($this->state, [
            'name' => "required|max:50|unique:roles,name,{$this->updateRole->id},id,deleted_at,NULL",
            'desc' => 'max:200',
        ])->validate();

        $this->roleRepository->update($this->updateRole->id, $validatedData);

        $this->dispatchBrowserEvent('hide-form', [
            'message' => 'Đã cập nhật nhóm người dùng ' . $validatedData['name'] . ' thành công!',
        ]);

        return redirect()->back();
    }

    public function confirmRoleRemoval($roleId)
    {
        $this->roleIdBeingRemoved = $roleId;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function removeRole()
    {
        $this->roleRepository->delete($this->roleIdBeingRemoved);

        $this->dispatchBrowserEvent('hide-delete-modal', [
            'message' => 'Xóa nhóm người dùng thành công!',
        ]);
    }
}

