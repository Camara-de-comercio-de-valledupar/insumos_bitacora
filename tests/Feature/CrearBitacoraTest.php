<?php

use App\Models\DetalleBitácora;
use Illuminate\Foundation\Testing\RefreshDatabase;


test('Guardar un detalle de bitácora', closure: function () {
    $data = DetalleBitácora::factory()->make()->toArray();
    $data = array_diff($data, array('id', 'bitácora_id'));
    $response = $this->post(route('bitácora-guardar'), $data);
    $response->assertStatus(200);
});
