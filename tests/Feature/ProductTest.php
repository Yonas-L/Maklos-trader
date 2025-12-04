<?php

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('products page can be rendered', function () {
    $response = $this->get('/products');

    $response->assertStatus(200);
});

test('product detail page can be rendered', function () {
    $product = \App\Models\Product::factory()->create();

    $response = $this->get('/products/' . $product->slug);

    $response->assertStatus(200);
    $response->assertSee($product->name);
});
