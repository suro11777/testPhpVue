<?php


namespace App\Models\Api;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App\Models\Api
 */
class Category extends Model
{
    /**
     * @var array
     */
    public $fillable = [
        'parent_id',
    ];

    public $timestamps = false;
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function category_details()
    {
        $language = Language::where('is_main', 1)->first(['id']);
        return $this->hasMany(CategoryDetail::class)->where('language_id', $language->id);
    }
}
