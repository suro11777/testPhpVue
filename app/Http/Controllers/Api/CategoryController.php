<?php


namespace App\Http\Controllers\Api;


use App\Services\Api\CategoryService;
use Illuminate\Http\Request;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Api
 */
class CategoryController extends BaseController
{
    /**
     * CategoryController constructor.
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->baseService = $categoryService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $cat = $this->baseService->store($request->all());

        if (!$cat){
            return response()->json(['status' => 500, 'message' => 'category don`t save']);
        }
        return response()->json(['status' => 201, 'message' => 'category save']);

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $cat = $this->baseService->update($id, $request->all());

        if ($cat == null){
            return response()->json(['status' => 404, 'message' => 'category not found']);
        }elseif (!$cat){
            return response()->json(['status' => 500, 'message' => 'category don`t update']);
        }
        return response()->json(['status' => 200, 'message' => 'category update']);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $cat = $this->baseService->getAll();
        return response()->json(['status' => 200, 'data' => $cat]);
    }


}
