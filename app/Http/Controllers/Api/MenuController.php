<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MenuController extends Controller
{
    public function index(): JsonResponse
    {
        $menu = MenuItem::orderBy('menu_name')->get();

        return $this->success($menu);
    }

    public function available(): JsonResponse
    {
        $menu = MenuItem::available()
            ->orderBy('menu_name')
            ->get();

        return $this->success($menu);
    }

    public function category(string $category): JsonResponse
    {
        $decodedCategory = urldecode($category);

        if (! in_array($decodedCategory, ['Makanan Berat', 'Minuman', 'Snack'], true)) {
            return $this->success([], 'Kategori tidak ditemukan');
        }

        $menu = MenuItem::where('category', $decodedCategory)
            ->orderBy('menu_name')
            ->get();

        return $this->success($menu);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $this->validatePayload($request);
        $menuItem = MenuItem::create($data);

        return $this->success($menuItem, 'Menu berhasil ditambahkan', 201);
    }

    public function update(Request $request, MenuItem $menuItem): JsonResponse
    {
        $data = $this->validatePayload($request);
        $menuItem->update($data);

        return $this->success($menuItem->fresh(), 'Menu berhasil diperbarui');
    }

    public function updateStock(Request $request, MenuItem $menuItem): JsonResponse
    {
        $validated = $request->validate([
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        $menuItem->update($validated);

        return $this->success($menuItem->fresh(), 'Stok berhasil diperbarui');
    }

    public function destroy(MenuItem $menuItem): JsonResponse
    {
        $menuItem->delete();

        return $this->success(null, 'Menu berhasil dihapus');
    }

    private function validatePayload(Request $request): array
    {
        return $request->validate([
            'menu_name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'category' => ['required', Rule::in(['Makanan Berat', 'Minuman', 'Snack'])],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image_url' => ['nullable', 'string', 'max:255'],
            'is_available' => ['sometimes', 'boolean'],
        ]);
    }

    private function success($data, string $message = 'OK', int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}

