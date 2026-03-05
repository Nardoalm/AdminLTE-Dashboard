<?php

use App\Http\Requests\StoreUserRequest;

test('store user request was expected rules', function () {
    $rules = (new StoreUserRequest())->rules();

    expect($rules['name'])->toBe('required|string|max:255')
        ->and($rules['email'])->toContain('unique:users,email')
        ->and($rules['avatar'])->toBe('nullable|image|max:2048');
});
