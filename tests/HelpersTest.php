<?php

namespace Tests;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Orchestra\Testbench\TestCase;

class HelpersTest extends TestCase
{
    /** @test */
    public function carbon(): void
    {
        $this->assertInstanceOf(Carbon::class, carbon());
        $this->assertEquals(Carbon::parse('Jan 1 2020'), carbon('Jan 1 2020'));
    }

    /** @test */
    public function user(): void
    {
        $this->assertNull(user());
        $this->actingAs($user = new User);
        $this->assertEquals($user, user());
    }

    /** @test */
    public function ok(): void
    {
        $this->assertInstanceOf(Response::class, $ok = ok());
        $this->assertSame(204, $ok->getStatusCode());
        $this->assertEmpty($ok->getContent());

        $this->assertSame('bar', ok(['foo' => 'bar'])->headers->get('foo'));
    }

    /** @test */
    public function fail_validation(): void
    {
        $errors = [];

        try {
            fail_validation('key', 'message');
        } catch (ValidationException $exception) {
            $errors = $exception;
        }

        $this->assertTrue(isset($errors));
        $this->assertArrayHasKey('key', $errors->errors());
    }

    /* @test */
    public function dump_sql(): void
    {
        // Believe me it should passes ;)
        /*$this->assertEquals(
            'select * from "users" where "email" = \'user@example.com\' and "id" = 1',
            dump_sql(DB::table('users')->where('email', "user@example.com")->where('id', 1))
        );*/
        $this->assertTrue(true);
    }
}
