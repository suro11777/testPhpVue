<?php


namespace App\Models\Api;


use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    /**
     * @var array
     */
    public $fillable = [
        'is_main',
        'name',
        'iso',
    ];
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function category_details()
    {
        return $this->hasMany(CategoryDetail::class);
    }
}
