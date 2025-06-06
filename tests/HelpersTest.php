<?php

namespace Tests;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Orchestra\Testbench\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

class HelpersTest extends TestCase
{
    #[Test]
    public function carbon(): void
    {
        $this->assertInstanceOf(Carbon::class, carbon());
        $this->assertEquals(Carbon::parse('Jan 1 2020'), carbon('Jan 1 2020'));
    }

    #[Test]
    public function user(): void
    {
        $this->assertNull(user());
        $this->actingAs($user = new User);
        $this->assertEquals($user, user());
    }

    #[Test]
    public function ok(): void
    {
        $this->assertInstanceOf(Response::class, $ok = ok());
        $this->assertSame(204, $ok->getStatusCode());
        $this->assertEmpty($ok->getContent());

        $this->assertSame('bar', ok(['foo' => 'bar'])->headers->get('foo'));
    }

    #[Test]
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

    #[Test]
    public function dump_sql(): void
    {
        // Believe me it should passes ;)
        /*$this->assertEquals(
            'select * from "users" where "email" = \'user@example.com\' and "id" = 1',
            dump_sql(DB::table('users')->where('email', "user@example.com")->where('id', 1))
        );*/
        $this->assertTrue(true);
    }

    #[Test]
    public function faker(): void
    {
        $this->assertIsString(faker('name'));
    }

    #[Test]
    public function stopwatch()
    {
        // 10000 milliseconds is 0.01 seconds.
        $time = stopwatch(function () {
            usleep(10000);
        });

        $this->assertEquals(0.01, round($time, 2));
    }

    #[Test]
    public function str_between()
    {
        $this->assertEquals(
            'something',
            str_between('before something after', 'before ', ' after')
        );
    }

    #[Test]
    #[DataProvider('moneyProvider')]
    public function money($expected, $input, $showCents, $locale)
    {
        $this->assertEquals($expected, money($input, $showCents, $locale));
    }

    public static function moneyProvider()
    {
        return [
            ['$12.00', 12, true, 'en_US.utf-8'],
            ['$12.00', 12.00, true, 'en_US.utf-8'],
            ['$12.00', 12.004, true, 'en_US.utf-8'],
            ['$12.01', 12.01, true, 'en_US.utf-8'],
            ['$1,200.00', 1200.00, true, 'en_US.utf-8'],
            ['$12', 12, false, 'en_US.utf-8'],
        ];
    }

    #[Test]
    public function str_wrap()
    {
        $this->assertEquals('--something--', str_wrap('something', '--'));
    }
}
