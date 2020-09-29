<?php


namespace App\Services\Api;


use App\Models\Api\Category;
use App\Models\Api\CategoryDetail;
use Illuminate\Support\Facades\DB;

class CategoryService extends BaseService
{

    /**
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        DB::beginTransaction();
        $cat = Category::create(['parent_id' => $data['parent_id'] ?? null]);
        if (empty($cat)) {
            DB::rollBack();
            return false;
        }
        $cat_details = $cat->category_details()->createMany($data['name']);
        if ($cat_details->isEmpty()) {
            DB::rollBack();
            return false;
        }
        DB::commit();
        return $cat;

    }

    /**
     * @param $id
     * @param $data
     * @return bool|null
     */
    public function update($id, $data)
    {
        $cat = Category::find($id);
        if (!$cat) {
            return null;
        }
        DB::beginTransaction();
        $del = $cat->category_details()->delete();
        if (!$del) {
            DB::rollBack();
            return false;
        }
        $cat_details = $cat->category_details()->createMany($data['name']);
        if ($cat_details->isEmpty()) {
            DB::rollBack();
            return false;
        }
        DB::commit();
        return $cat;

    }


    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        $param = $_GET['tree'] ?? '';
        $cat = Category::with('category_details')->get();
        if (!$param && !empty($cat)){
            return $cat->toArray();
        }
        $cat = $this->generatePageTree($cat->toArray());

        return $cat;
    }

    /**
     * @param $datas
     * @param int $parent
     * @param int $depth
     * @return string
     */
    public function generatePageTree($datas, $parent = 0, $depth = 0)
    {
        $ni = count($datas);
        if ($ni === 0 || $depth > 1000) {
            return ''; // Make sure not to have an endless recursion
        }
        $tree = '<ul>';
        for ($i = 0; $i < $ni; $i++) {
            if ($datas[$i]['parent_id'] == $parent) {
                $tree .= '<li>';
                $tree .= $datas[$i]['category_details'][0]['name'];
                $tree .= $this->generatePageTree($datas, $datas[$i]['id'], $depth + 1);
                $tree .= '</li>';
            }
        }
        $tree .= '</ul>';
        return $tree;
    }
}
