<?php namespace App\Repositories\Backend\Product;

use App\Models\Product\Product;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Http\Utilities\FileUploads;

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
        $files = $input['main_image'];

        $imageNameArray = [];

        foreach ($files as $file)
        {
            /*$destinationPath    = public_path(). '/uploads/products/';
            $filename           = time().$file->getClientOriginalName();

            $file->move($destinationPath, $filename);*/

            $fileUpload = new FileUploads();
            $fileUpload->setBasePath('products');

            $filename = $fileUpload->upload($file);

            $imageNameArray[] = $filename;
        }

        $input['main_image'] = json_encode($imageNameArray);

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

        if(isset($input['main_image']))
        {
            $files = $input['main_image'];

            $imageNameArray = json_decode($product->main_image, true);

            foreach ($files as $file)
            {
                /*$destinationPath    = public_path(). '/uploads/products/';
                $filename           = time().$file->getClientOriginalName();

                $file->move($destinationPath, $filename);*/

                $fileUpload = new FileUploads();
                $fileUpload->setBasePath('products');

                $filename = $fileUpload->upload($file);

                $imageNameArray[] = $filename;
            }

            $product->main_image = json_encode($imageNameArray);
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
