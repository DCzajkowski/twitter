<?php

namespace Tests\Feature;

use App\Tweet;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TweetsTest extends TestCase
{
    use RefreshDatabase;

    public function test_body_is_required()
    {
        $user = factory(User::class)->create();

        $response = $this->from(route('home'))->actingAs($user)->post(route('tweets.store'));

        $response->assertRedirect(route('home'));
        $response->assertSessionHasErrors('body');
    }

    public function test_body_cannot_be_shorter_than_3_characters()
    {
        $user = factory(User::class)->create();

        $response = $this->from(route('home'))->actingAs($user)->post(route('tweets.store'), [
            'body' => 'a',
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHasErrors('body');
    }

    public function test_body_cannot_be_longer_than_120_characters()
    {
        $user = factory(User::class)->create();

        $response = $this->from(route('home'))->actingAs($user)->post(route('tweets.store'), [
            'body' => str_repeat('a', 121),
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHasErrors('body');
    }

    public function test_user_can_post_tweets()
    {
        $user = factory(User::class)->create();

        $response = $this->from(route('home'))->actingAs($user)->post(route('tweets.store'), [
            'body' => 'Hello World!',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertEquals('Hello World!', Tweet::first()->body);
    }

    public function test_guest_cannot_tweet()
    {
        $response = $this->from(route('home'))->post(route('tweets.store'), [
            'body' => 'Hello World!',
        ]);

        $response->assertRedirect(route('login'));
        $this->assertNull(Tweet::first());
    }
}
