<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;


test('registers with valid credentials', function () {

    $response = $this->post('/register', [
        'username' => 'testuser',
        'email' => 'test@example.com',
        'password' => 'TestPassword123',
        'password_confirmation' => 'TestPassword123',
    ]);

    $response->assertRedirect('/auth?login');
    $response->assertSessionHas('message', 'Registration successful, you can now log in.');

    $response->assertStatus(302);
});

test('fails registration with invalid email', function () {
    $response = $this->post('/register', [
        'username' => 'testuser',
        'email' => 'invalid-email',
        'password' => 'TestPassword123',
        'password_confirmation' => 'TestPassword123',
    ]);

    $response->assertSessionHasErrors('email');
    $response->assertStatus(302);
});

test('fails registration with short password', function() {
    $response = $this->post('/register', [
        'username' => 'testuser',
        'email' => 'test@example.com',
        'password' => 'short',
        'password_confirmation' => 'short',
    ]);

    $response->assertSessionHasErrors('password');
    $response->assertStatus(302);
});

test('logs in with valid credentials', function () {
    $user = \App\Models\User::factory()->create([
        'password' => bcrypt('TestPassword123'),
    ]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'TestPassword123',
        'remember' => true,
    ]);

    $response->assertRedirect('/');
    $this->assertAuthenticatedAs($user);
});

test('fails login with invalid credentials', function () {
    $response = $this->post('/login', [
        'email' => 'nottheemail@fn.com',
        'password' => 'wrongpassword',
    ]);
    $response->assertSessionHasErrors('email');
    $response->assertStatus(302);
});

test('logs out successfully', function () {
    $user = \App\Models\User::factory()->create();
    Auth::login($user);

    $response = $this->post('/logout');

    $response->assertRedirect('/');
    $this->assertGuest();
});
