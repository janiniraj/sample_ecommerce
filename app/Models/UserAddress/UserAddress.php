<?php

namespace App\Models\UserAddress;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserAddress\Traits\Attribute\Attribute;
use App\Models\UserAddress\Traits\Relationship\Relationship;

class UserAddress extends Model
{
    use Relationship,
        Attribute;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    protected $fillable = ["email", "first_name", "user_id", "last_name", "address", "street", "city", "state", "country", "postal_code", "phone", "type", "created_at", "updated_at"];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    	$this->table = config("access.user_address_table");
    }
}
