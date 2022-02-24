<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Message;
use App\Models\To;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MessageController
 */
class MessageControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $messages = Message::factory()->count(3)->create();

        $response = $this->get(route('message.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MessageController::class,
            'store',
            \App\Http\Requests\MessageStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $text = $this->faker->word;
        $to = To::factory()->create();
        $from_id = $this->faker->;

        $response = $this->post(route('message.store'), [
            'text' => $text,
            'to_id' => $to->id,
            'from_id' => $from_id,
        ]);

        $messages = Message::query()
            ->where('text', $text)
            ->where('to_id', $to->id)
            ->where('from_id', $from_id)
            ->get();
        $this->assertCount(1, $messages);
        $message = $messages->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $message = Message::factory()->create();

        $response = $this->get(route('message.show', $message));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MessageController::class,
            'update',
            \App\Http\Requests\MessageUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $message = Message::factory()->create();
        $text = $this->faker->word;
        $to = To::factory()->create();
        $from_id = $this->faker->;

        $response = $this->put(route('message.update', $message), [
            'text' => $text,
            'to_id' => $to->id,
            'from_id' => $from_id,
        ]);

        $message->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($text, $message->text);
        $this->assertEquals($to->id, $message->to_id);
        $this->assertEquals($from_id, $message->from_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $message = Message::factory()->create();

        $response = $this->delete(route('message.destroy', $message));

        $response->assertNoContent();

        $this->assertDeleted($message);
    }
}
