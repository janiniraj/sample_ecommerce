<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product\Traits\Attribute\Attribute;
use App\Models\Product\Traits\Relationship\Relationship;

/**
 * Class Product.
 */
class Product extends Model
{
    use Attribute,
        Relationship;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'category_id', 'main_image', 'created_at', 'updated_at'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = 'products';
    }
}
