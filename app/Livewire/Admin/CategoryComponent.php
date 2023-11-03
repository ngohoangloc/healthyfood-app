<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $state = [];
    public $updateCategory;
    public $showEditModal= false;
    public $categoryIdBeingRemoved;
    public $searchInput;
    private $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }

    public function render()
    {
        return view('livewire.admin.category-component',[
            'categories' => $this->categoryRepository->get($this->searchInput),
        ]);
    }


    public function addCategory()
    {
        $this->state = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createCategory()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required|max:50|unique:categories,deleted_at,NULL',
            'desc' => 'max:200',
        ])->validate();

        $newCategory = $this->categoryRepository->create($validatedData);

        $this->dispatchBrowserEvent('hide-form', [
            'message' => 'Đã thêm nhóm hàng hóa ' . $newCategory['name'] . ' thành công!',
        ]);
    }

    public function editCategory(Category $category)
    {
        $this->state = $category->toArray();

        $this->updateCategory = $category;

        $this->showEditModal = true;

        $this->dispatchBrowserEvent('show-form');
    }

    public function updateCategory()
    {
        $validatedData = Validator::make($this->state, [
            'name' => "required|max:50|unique:categories,name,{$this->updateCategory->id},id,deleted_at,NULL",
            'desc' => 'max:200',
        ])->validate();

        $this->categoryRepository->update($this->updateCategory->id, $validatedData);

        $this->dispatchBrowserEvent('hide-form', [
            'message' => 'Đã cập nhật nhóm hàng hóa ' . $validatedData['name'] . ' thành công!',
        ]);

        return redirect()->back();
    }

    public function confirmCategoryRemoval($categoryId)
    {
        $this->categoryIdBeingRemoved = $categoryId;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function removeCategory()
    {
        $this->categoryRepository->delete($this->categoryIdBeingRemoved);

        $this->dispatchBrowserEvent('hide-delete-modal', [
            'message' => 'Xóa nhóm hàng hóa thành công!',
        ]);
    }
}

