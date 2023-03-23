<?php

namespace Tests\Http\Controllers\Auth;

use App\Core\Domain\_Shared\Converter\ObjectToArray;
use App\Core\UseCase\User\Create\InputCreateUserDto;
use App\Core\UseCase\User\Update\InputUpdateUserDto;
use App\Models\User as UserModel;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:reset');
        $this->artisan('migrate');
    }

    public function testStoreShouldReturn201()
    {
        $input = new InputCreateUserDto(
            'name',
            'name@gmail.com',
            '123456',
        );
        $this->actingAs(UserModel::factory()->create())
            ->json(
                'POST',
                route('user.store'),
                ObjectToArray::convert(InputCreateUserDto::class, $input)
            )
            ->assertCreated();
    }

    public function testUpdateShouldReturn204()
    {
        $input = new InputCreateUserDto(
            'name',
            'name@gmail.com',
            '123456',
        );
        $this->actingAs(UserModel::factory()->create())
            ->json(
                'POST',
                route('user.store'),
                ObjectToArray::convert(InputCreateUserDto::class, $input)
            )
            ->assertCreated();

        $input = new InputUpdateUserDto(
            Uuid::uuid4(),
            'name',
            'name@gmail.com',
            '123456',
        );
        $this->actingAs(UserModel::factory()->create(), 'api')
            ->json(
                'PUT',
                route('user.update'),
                ObjectToArray::convert(InputUpdateUserDto::class, $input)
            )
            ->assertNoContent();
    }

    public function testUpdateShouldReturn404()
    {
        $input = new InputCreateUserDto(
            'name',
            'name@gmail.com',
            '123456',
        );
        $this->actingAs(UserModel::factory()->create())
            ->json(
                'POST',
                route('user.store'),
                ObjectToArray::convert(InputCreateUserDto::class, $input)
            )
            ->assertCreated();

        $input = new InputUpdateUserDto(
            Uuid::uuid4(),
            'name',
            'name@gmail.com',
            '123456',
        );
        $this->actingAs(UserModel::factory()->create())
            ->json(
                'PUT',
                route('user.update'),
                ObjectToArray::convert(InputUpdateUserDto::class, $input)
            )
            ->assertForbidden();
    }
}
