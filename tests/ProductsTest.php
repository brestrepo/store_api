<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Product;

class ProductTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_gets_all_products()
    {

        $this->createProducts(5);

        $response  = $this->call('GET', 'api/products');

        $this->assertResponseOk();

        $this->assertResponseStatus(200, $response->status());

    }

    public function test_gets_one_product()
    {

        /* we create one so that we can ensure the object exists */
        $this->createProducts(1);

        $response  = $this->call('GET', 'api/products/1');

        $this->assertResponseOk();

        $this->assertResponseStatus(200, $response->status());

    }    


    public function test_create_one_product()
    {

        $product = [
            'name'=> 'Product name'.rand(0,1000), 
            'price'=> rand(10000, 100000),
            'in_stock' => rand(0,1)
        ];
        /* we create one so that we can ensure the object exists */
        $response  = $this->call('POST', 'api/products', $product);

        $this->assertResponseStatus(201, $response->status());

    }  


    public function test_update_one_product()
    {

        /* we create one so that we can ensure the object exists */
        $this->createProducts(1);

        $product = [
            'name'=> 'Product name'.rand(0,1000), 
            'price'=> rand(10000, 100000),
            'in_stock' => rand(0,1), 
            '_method' => "PUT"
        ];
        /* we create one so that we can ensure the object exists */
        $response  = $this->call('POST', 'api/products/1', $product);

        $this->assertResponseStatus(200, $response->status());

    }  


    public function createProducts($number)
    {
        for ($i = 0; $i <= $number; $i++)
        {
            $product = [
            'name'=> 'Product name'.rand(0,1000), 
            'price'=> rand(10000, 100000),
            'in_stock' => rand(0,1)
            ];

            Product::create($product);
        }
    }


}
