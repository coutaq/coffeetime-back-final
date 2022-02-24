<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PlaceController
 */
class PlaceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $places = Place::factory()->count(3)->create();

        $response = $this->get(route('place.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PlaceController::class,
            'store',
            \App\Http\Requests\PlaceStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $title = $this->faker->sentence(4);
        $photo = $this->faker->word;
        $description = $this->faker->text;
        $lat = $this->faker->latitude;
        $lon = $this->faker->word;

        $response = $this->post(route('place.store'), [
            'title' => $title,
            'photo' => $photo,
            'description' => $description,
            'lat' => $lat,
            'lon' => $lon,
        ]);

        $places = Place::query()
            ->where('title', $title)
            ->where('photo', $photo)
            ->where('description', $description)
            ->where('lat', $lat)
            ->where('lon', $lon)
            ->get();
        $this->assertCount(1, $places);
        $place = $places->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $place = Place::factory()->create();

        $response = $this->get(route('place.show', $place));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PlaceController::class,
            'update',
            \App\Http\Requests\PlaceUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $place = Place::factory()->create();
        $title = $this->faker->sentence(4);
        $photo = $this->faker->word;
        $description = $this->faker->text;
        $lat = $this->faker->latitude;
        $lon = $this->faker->word;

        $response = $this->put(route('place.update', $place), [
            'title' => $title,
            'photo' => $photo,
            'description' => $description,
            'lat' => $lat,
            'lon' => $lon,
        ]);

        $place->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($title, $place->title);
        $this->assertEquals($photo, $place->photo);
        $this->assertEquals($description, $place->description);
        $this->assertEquals($lat, $place->lat);
        $this->assertEquals($lon, $place->lon);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $place = Place::factory()->create();

        $response = $this->delete(route('place.destroy', $place));

        $response->assertNoContent();

        $this->assertDeleted($place);
    }
}
