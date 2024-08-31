<?php

it('returns a successful response', function () {
    $response = $this->options(route('laratus.options'));
    $response->ddHeaders();
    $response->assertStatus(200);
});
