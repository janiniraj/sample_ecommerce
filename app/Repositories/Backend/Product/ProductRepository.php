<?php namespace App\Repositories\Backend\Product;

use App\Models\Product\Product;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Http\Utilities\FileUploads;
use App\Models\Product\ProductSize;
use App\Models\Product\ProductReview;

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

        $sizeArray = [];

        if(isset($input['length']) && !empty($input['length']))
        {
            foreach ($input['length'] as $singleKey => $singleValue) {
                $sizeArray[$singleKey]['length']    = $singleValue;
                $sizeArray[$singleKey]['width']     = $input['width'][$singleKey];
            }

            $sizeArray = array_values($sizeArray);
        }

        unset($input['length'], $input['width']);

        DB::transaction(function () use ($input, $sizeArray) {
            $product                    = self::MODEL;
            $product                    = new $product();
            $product->name              = $input['name'];
            $product->main_image        = $input['main_image'];
            $product->sku               = $input['sku'];
            $product->brand             = $input['brand'];
            $product->category_id       = $input['category_id'];
            $product->subcategory_id    = isset($input['subcategory_id']) ? $input['subcategory_id'] : '';
            $product->style_id          = $input['style_id'];
            $product->material_id       = $input['material_id'];
            $product->weave_id          = $input['weave_id'];
            $product->color_id          = $input['color_id'];
            $product->border_color_id   = $input['border_color_id'];
            $product->shape             = $input['shape'];
            /*$product->length            = $input['length'];
            $product->width             = $input['width'];*/
            $product->foundation        = $input['foundation'];
            $product->knote_per_sq      = $input['knote_per_sq'];
            $product->detail            = $input['detail'];
            $product->type              = $input['type'];
            $product->country_origin    = isset($input['country_origin']) ? $input['country_origin'] : '';

            $shopLinks = [];

            if(isset($input['amazon_link']))
            {
                $shopLinks['amazon_link'] = $input['amazon_link'];
            }

            if(isset($input['ebay_link']))
            {
                $shopLinks['ebay_link'] = $input['ebay_link'];
            }

            if(isset($input['other_link']))
            {
                $shopLinks['other_link'] = $input['other_link'];
            }

            $product->shop = json_encode($shopLinks);

            if ($product->save()) {

                $productId = $product->id;

                if($sizeArray)
                {
                    foreach($sizeArray as $singleKey => $singleValue)
                    {
                        $productSize = new ProductSize();
                        $productSize->product_id = $productId;
                        $productSize->length = $singleValue['length'];
                        $productSize->width = $singleValue['width'];
                        $productSize->save();
                    }
                }

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
        $product->type = $input['type'];

        $sizeArray = [];

        if(isset($input['length']) && !empty($input['length']))
        {
            foreach ($input['length'] as $singleKey => $singleValue) {
                $sizeArray[$singleKey]['length']    = $singleValue;
                $sizeArray[$singleKey]['width']     = $input['width'][$singleKey];
            }

            $sizeArray = array_values($sizeArray);
        }

        unset($input['length'], $input['width']);

        if(isset($input['image_old']))
        {
            $product->main_image = json_encode($input['image_old']);
        }

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

        if(isset($input['sku']))
        {
            $product->sku = $input['sku'];
        }

        if(isset($input['brand']))
        {
            $product->brand = $input['brand'];
        }

        if(isset($input['category_id']))
        {
            $product->category_id = $input['category_id'];
        }

        if(isset($input['subcategory_id']))
        {
            $product->subcategory_id = $input['subcategory_id'];
        }

        if(isset($input['style_id']))
        {
            $product->style_id = $input['style_id'];
        }

        if(isset($input['material_id']))
        {
            $product->material_id = $input['material_id'];
        }

        if(isset($input['weave_id']))
        {
            $product->weave_id = $input['weave_id'];
        }

        if(isset($input['color_id']))
        {
            $product->color_id = $input['color_id'];
        }

        if(isset($input['border_color_id']))
        {
            $product->border_color_id = $input['border_color_id'];
        }

        if(isset($input['shape']))
        {
            $product->shape = $input['shape'];
        }

        if(isset($input['length']))
        {
            $product->length = $input['length'];
        }

        if(isset($input['width']))
        {
            $product->width = $input['width'];
        }

        if(isset($input['foundation']))
        {
            $product->foundation = $input['foundation'];
        }

        if(isset($input['knote_per_sq']))
        {
            $product->knote_per_sq = $input['knote_per_sq'];
        }

        if(isset($input['detail']))
        {
            $product->detail = $input['detail'];
        }

        if(isset($input['shop']))
        {
            $product->shop = $input['shop'];
        }

        if(isset($input['country_origin']))
        {
            $product->country_origin = $input['country_origin'];
        }

        $shopLinks = [];

        if(isset($input['amazon_link']))
        {
            $shopLinks['amazon_link'] = $input['amazon_link'];
        }

        if(isset($input['ebay_link']))
        {
            $shopLinks['ebay_link'] = $input['ebay_link'];
        }

        if(isset($input['other_link']))
        {
            $shopLinks['other_link'] = $input['other_link'];
        }

        $product->shop = json_encode($shopLinks);

        DB::transaction(function () use ($product, $input, $sizeArray) {
            if ($product->save()) {

                $productId = $product->id;
                ProductSize::where('product_id', $productId)->delete();

                if($sizeArray)
                {
                    foreach($sizeArray as $singleKey => $singleValue)
                    {
                        $productSize = new ProductSize();
                        $productSize->product_id = $productId;
                        $productSize->length = $singleValue['length'];
                        $productSize->width = $singleValue['width'];
                        $productSize->save();
                    }
                }

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
