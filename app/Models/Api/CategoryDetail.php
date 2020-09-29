<?php


namespace App\Models\Api;


use Illuminate\Database\Eloquent\Model;

class CategoryDetail extends Model
{
    public $fillable = [
        'category_id',
        'language_id',
        'name',
    ];

    public $timestamps = false;
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
