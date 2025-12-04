<?php

use Illuminate\Support\Str;

it('renders the manufacturing image promo section with heading and image', function () {
    $response = $this->get('/');

    $response->assertSuccessful();
    $response->assertSee('manufacturing-image-promo', false);
    $response->assertSee('From Essentials to Excellence — Explore the Full Maklos Collection', false);

    // Ensure the image reference is present (path may be transformed by Vite/asset helper at runtime)
    $response->assertSee('storage/assets/allproducts.jpeg', false);
});
