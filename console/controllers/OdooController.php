<?php


namespace console\controllers;


use common\models\dvizh\Category;
use common\models\dvizh\Product;
use dvizh\gallery\models\Image;
use dvizh\shop\models\Price;
use Yii;
use yii\httpclient\Client;

class OdooController extends \yii\console\Controller
{
    private function fetchProductsFromOdoo(): array
    {
        $client = new Client([
            'baseUrl' => 'https://odoo.tools.csms.uz',
        ]);

        $response = $client->post(
            '/json/2/product.product/search_read',
            [
                // optional: domain / fields / limit
                // 'limit' => 100,
            ],
            [
                'Authorization' => 'Bearer ca7f15af4c42299fd639e1b686d77867928f9ae5',
                'Accept' => 'application/json',
                'Odoo-Database' => 'wms-test',
                'Content-Type' => 'application/json'
            ]
        )->send();

        if (!$response->isOk) {
            throw new \RuntimeException(
                'Odoo request failed: ' . $response->statusCode
            );
        }

        $data = $response->data;

        // Odoo usually wraps results
        if (isset($data['result'])) {
            return $data['result'];
        }

        return $data;
    }

    public function actionSyncProducts(): void
    {
        // 1. Fetch products from Odoo API
        $odooProducts = $this->fetchProductsFromOdoo();

        foreach ($odooProducts as $odooProduct) {
            $this->syncProduct($odooProduct);
        }

        $this->stdout("Odoo product sync completed\n");
    }

    function syncCategory(array $odooProduct)
    {
        [$externalId, $name] = $odooProduct['categ_id'];

        $category = Category::find()
            ->where(['external_id' => $externalId])
            ->one();

        if ($category === null) {
            $category = new Category();
            $category->external_id = $externalId;
            $category->name = $name;
            $category->code = 'odoo-' . $externalId;
            $category->slug = \yii\helpers\Inflector::slug($name);
            $category->sort = 100;

            if (!$category->save()) {
                throw new \RuntimeException(json_encode($category->errors));
            }
        }

        return $category;
    }

    function syncProduct(array $odooProduct)
    {
        $product = Product::find()
            ->where(['external_id' => $odooProduct['id']])
            ->one();

        if ($product === null) {
            $product = new Product();
            $product->external_id = $odooProduct['id'];

            $defaultCode = $odooProduct['default_code'];

            if (!is_string($defaultCode) || trim($defaultCode) === '') {
                $defaultCode = 'odoo-' . $product->external_id;
            }

            $product->code = $defaultCode;
            $product->sku  = $defaultCode;
        }

        $category = $this->syncCategory($odooProduct);

        $product->is_new = 'yes';

        $product->category_id = $category->id;
        $product->name = $odooProduct['name'];
        $product->barcode = $odooProduct['barcode'] ?: null;
        $product->amount = (int)$odooProduct['qty_available'];
        $product->available = $product->amount > 0 ? 'yes' : 'no';
        $product->text = $odooProduct['description_sale'] ?: '';
        $product->short_text = $odooProduct['product_tmpl_id'][1] ?? '';
        $product->slug = \yii\helpers\Inflector::slug($product->name);
        $product->sort = 100;

        if (!$product->save()) {
            throw new \RuntimeException(json_encode($product->errors));
        }

        $this->syncPrice($product, $odooProduct);
        $this->syncImage($product, $odooProduct);

        return $product;
    }

    function syncPrice(Product $product, array $odooProduct): void
    {
        $price = Price::find()
            ->where([
                'item_id' => $product->id,
//                'type' => 'p'
            ])
            ->one();

        if ($price === null) {
            $price = new Price();
            $price->item_id = $product->id;
            $price->type = '$';
            $price->available = 'yes';
        }

        $price->type_id = 1;
        $price->price = $odooProduct['list_price'] * 12065;
        $price->name = 'Base price';
        $price->sort = 100;

        if (!$price->save()) {
            throw new \RuntimeException(json_encode($price->errors));
        }
    }

    function syncImage(Product $product, array $odooProduct): void
    {
        if (
            empty($odooProduct['image_1920']) or
            !is_string($odooProduct['image_1920'])
        ) {
            return;
        }

        // Prevent duplicates
        if (Image::find()->where([
            'itemId' => $product->id,
            'modelName' => 'Product',
        ])->exists()) {
            return;
        }

        $binary = base64_decode($odooProduct['image_1920']);
        if ($binary === false) {
            throw new \RuntimeException('Invalid base64 image');
        }

        // EXACT dvizh path
        $baseDir = Yii::getAlias('@frontend/web/images/store');
        $dir = $baseDir . '/Products/Product' . $product->id;

        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $filename = uniqid('', true) . '.png';
        file_put_contents($dir . '/' . $filename, $binary);

        // EXACT dvizh DB values
        $image = new Image();
        $image->itemId = $product->id;
        $image->modelName = 'Product'; // IMPORTANT
        $image->filePath = 'Products/Product' . $product->id . '/' . $filename;
        $image->urlAlias = 'product-' . $product->id;
        $image->isMain = 1;
        $image->sort = 0;

        if (!$image->save()) {
            throw new \RuntimeException(json_encode($image->errors));
        }
    }

    function saveBase64Image(string $base64): string
    {
        $data = base64_decode($base64);
        if ($data === false) {
            throw new \RuntimeException('Invalid base64');
        }

        $dir = Yii::getAlias('@frontend/web/uploads/odoo');
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $file = $dir . '/' . uniqid('odoo_', true) . '.png';
        file_put_contents($file, $data);

        return $file;
    }

}