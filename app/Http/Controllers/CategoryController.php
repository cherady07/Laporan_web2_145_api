<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Api\BaseController;

class CategoryController extends BaseController{
    protected CategoryService $svc;

    public function __construct(CategoryService $svc){
        $this->svc = $svc;
    }

    public function index(): JsonResponse {
        return $this->success($this->svc->all(), 'Berhasil menarik semua data Kategori');
    }

    public function store(StoreCategoryRequest $req): JsonResponse{
        $category = $this->svc->create($req->validated());
        return $this->success($category, 'Kategori berhasil dibuat', 201);
    }

    public function show($id): JsonResponse {
        try {
            $category = $this->svc->find($id);
            return $this->success($category, 'Berhasil menarik satu data Kategori');
        } catch (Exception $e) {
            return $this->error('Kategori tidak ditemukan', 404);
        }
    }

    public function update(UpdateCategoryRequest $req, $id): JsonResponse {
        $category = $this->svc->update($id, $req->validated());
        return $this->success($category, 'Kategori berhasil diperbarui');
    }

    public function destroy($id): JsonResponse  {
        try {
            $this->svc->delete($id);
            return $this->success(null, 'Kategori berhasil dihapus');
        } catch (Exception $e) {
            return $this->error('Gagal menghapus kategori atau data tidak ditemukan', 400);
        }
    }
}