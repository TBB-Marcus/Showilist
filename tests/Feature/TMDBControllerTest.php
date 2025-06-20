<?php

test('test show details gets fetched correctly', function () {
    $response = $this->get('/show/221300');

    $response->assertStatus(200);
    $response->assertViewIs('show');
    $response->assertViewHas('show');

    $show = $response->viewData('show');
    expect($show)->toHaveProperty('id');
    expect($show)->toHaveProperty('name');
});
