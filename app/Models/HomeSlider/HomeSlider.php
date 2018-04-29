<?php

namespace App\Models\HomeSlider;

use Illuminate\Database\Eloquent\Model;
use App\Models\HomeSlider\Traits\Attribute\Attribute;
use App\Models\HomeSlider\Traits\Relationship\Relationship;

class HomeSlider extends Model
{
    use Attribute,
        Relationship;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    protected $fillable = ["type", "image", "youtubevideo_id", "created_at", "updated_at"];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    	$this->table = config("access.homeslider_table");
    }
}
