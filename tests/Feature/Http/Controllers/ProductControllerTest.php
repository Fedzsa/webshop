<?php

namespace Tests\Feture\Http\Controllers;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testGetProductsView()
    {
        $this->actingAsAdmin();

        $this->get('/products')
            ->assertViewIs('product.index');
    }

    private function actingAsAdmin()
    {
        $this->actingAs(\factory(User::class)->create([
            'admin' => 1,
        ]));
    }

    public function testGuestUserCantReachProductsView()
    {
        $this->actingAsUser();

        $this->get('/products')
            ->assertStatus(403);
    }

    private function actingAsUser()
    {
        $this->actingAs(factory(User::class)->create());
    }

    public function testProductViewGetTheData()
    {
        $this->actingAsAdmin();

        $this->get('/products')->assertViewHasAll([ 'products', 'search' ]);
    }

    public function twstGetNewProductView()
    {
        $this->actingAsAdmin();

        $this->get('/products/create')
            ->assertViewIs('product.create');
    }

    public function testJustAdminsReachTheNewProductView()
    {
        $this->actingAsUser();

        $this->get('/products/create')
            ->assertStatus(403);
    }

    public function testEverybodyCanSeeTheProductPage()
    {
        $product = $this->generateProduct();

        $this->get('/products/' . $product->id)
            ->assertViewIs('product.show')
            ->assertViewHas('product')
            ->assertOk();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    private function generateProduct()
    {
        return factory(Product::class)->create();
    }

    public function testJustAdminsCanStoreAProduct()
    {
        $this->actingAsUser();

        factory(Category::class)->create();

        $response = $this->post('/products', $this->getTestProductAttributes());

        $response->assertStatus(403);
    }

    private function getTestProductAttributes(): array
    {
        return [
            'name' => 'Test product',
            'category_id' => Category::first()->id,
            'price' => 100,
            'amount' => 10,
            'description' => 'description',
        ];
    }

    public function testIsProductStored()
    {
        $this->actingAsAdmin();

        factory(Category::class)->create();

        $response = $this->post('/products', $this->getTestProductAttributes());

        $this->assertCount(1, Product::all());
        $response->assertSessionHas('status');
        $response->assertStatus(302);
    }

    public function testAdminsCanSeeTheProductEditPage()
    {
        $this->actingAsAdmin();

        $product = $this->generateProduct();

        $this->get('/products/' . $product->id . '/edit')->assertViewIs('product.edit');
    }

    public function testProductPageGetTheData()
    {
        $this->actingAsAdmin();

        $product = $this->generateProduct();

        $this->get('/products/' . $product->id . '/edit')->assertViewHasAll([ 'product', 'categories' ]);
    }

    public function testAdminsCanUpdateTheProduct()
    {
        $this->actingAsUser();

        $product = $this->generateProduct();

        $this->put('/products/' . $product->id)->assertStatus(403);
    }

    public function testIsProductUpdated()
    {
        $this->actingAsAdmin();

        $product = $this->generateProduct();

        $this->put('/products/' . $product->id, [
            'name' => 'asd',
            'category_id' => Category::first()->id,
            'price' => 100,
            'amount' => 10,
            'description' => 'description',
        ]);

        $updatedProduct = Product::find($product->id);

        $this->assertNotEquals($updatedProduct->name, $product->name);
    }

    public function testAdminsCanDestroyTheProduct()
    {
        $this->actingAsAdmin();

        $product = $this->generateProduct();

        $this->delete('/products/' . $product->id)
            ->assertOk()
            ->assertJson([ 'success' => true ]);

        $this->assertSoftDeleted($product);
    }

    public function testAdminsCanRestoreTheProduct()
    {
        $this->withExceptionHandling();
        $this->actingAsAdmin();

        $product = factory(Product::class)->create([
            'deleted_at' => now(),
        ]);

        $this->put('/products/' . $product->id . '/restore')
            ->assertOk()
            ->assertJson([ 'success' => true ]);

        $product = Product::find($product->id);

        $this->assertNull($product->deleted_at);
    }
}
