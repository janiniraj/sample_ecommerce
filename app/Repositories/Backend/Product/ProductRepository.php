<?php namespace App\Repositories\Backend\Product;

use App\Models\Product\Product;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductRepository.
 */
class ProductRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Product::class;

    /**
     * @param string $order_by
     * @param string $sort
     *
     * @return mixed
     */
    public function getAll($order_by = 'id', $sort = 'asc')
    {
        return $this->query()
            ->orderBy($order_by, $sort)
            ->get();
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                'products.id',
                'products.name'
            ]);
    }

    /**
     * @param array $input
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {
        if ($this->query()->where('name', $input['name'])->first()) {
            throw new GeneralException("Product with same name Exist");
        }
        $file = $input['main_image'];

        $destinationPath = public_path(). '/uploads/products/';
        $filename = time().$file->getClientOriginalName();

        $file->move($destinationPath, $filename);

        $input['main_image'] = $filename;

        DB::transaction(function () use ($input) {
            $product = self::MODEL;
            $product = new $product();
            $product->name = $input['name'];
            $product->main_image = $input['main_image'];

            if ($product->save()) {

                return true;
            }

            throw new GeneralException('Error in saving Product.');
        });
    }

    /**
     * @param Model $product
     * @param  $input
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function update(Model $product, array $input)
    {

        $product->name = $input['name'];

        if(isset($input['main_image']) && $input['main_image'])
        {
            $file = $input['main_image'];

            $destinationPath = public_path(). '/uploads/products/';
            $filename = time().$file->getClientOriginalName();

            $file->move($destinationPath, $filename);

            $product->main_image = $input['main_image'] = $filename;
        }


        DB::transaction(function () use ($product, $input) {
            if ($product->save()) {
                return true;
            }

            throw new GeneralException('Error in saving Product');
        });
    }

    /**
     * @param Model $product
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Model $product)
    {
        DB::transaction(function () use ($product) {

            if ($product->delete()) {

                return true;
            }

            throw new GeneralException('Error in deleting Product');
        });
    }
}
