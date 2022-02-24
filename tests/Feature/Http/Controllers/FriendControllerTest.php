<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Friend;
use App\Models\To;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\FriendController
 */
class FriendControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $friends = Friend::factory()->count(3)->create();

        $response = $this->get(route('friend.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FriendController::class,
            'store',
            \App\Http\Requests\FriendStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $to = To::factory()->create();
        $from_id = $this->faker->;

        $response = $this->post(route('friend.store'), [
            'to_id' => $to->id,
            'from_id' => $from_id,
        ]);

        $friends = Friend::query()
            ->where('to_id', $to->id)
            ->where('from_id', $from_id)
            ->get();
        $this->assertCount(1, $friends);
        $friend = $friends->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $friend = Friend::factory()->create();

        $response = $this->get(route('friend.show', $friend));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FriendController::class,
            'update',
            \App\Http\Requests\FriendUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $friend = Friend::factory()->create();
        $to = To::factory()->create();
        $from_id = $this->faker->;

        $response = $this->put(route('friend.update', $friend), [
            'to_id' => $to->id,
            'from_id' => $from_id,
        ]);

        $friend->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($to->id, $friend->to_id);
        $this->assertEquals($from_id, $friend->from_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $friend = Friend::factory()->create();

        $response = $this->delete(route('friend.destroy', $friend));

        $response->assertNoContent();

        $this->assertDeleted($friend);
    }
}
