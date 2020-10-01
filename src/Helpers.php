<?php

use Faker\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

if (! function_exists('carbon')) {
    function carbon(...$args)
    {
        return new Carbon(...$args);
    }
}

if (! function_exists('user')) {
    function user(string $guard = null)
    {
        return auth($guard)->user();
    }
}

if (! function_exists('ok')) {
    function ok(array $headers = [])
    {
        return response()->noContent(204, $headers);
    }
}

if (! function_exists('fail_validation')) {
    function fail_validation(string $key, string $message)
    {
        throw ValidationException::withMessages([$key => $message]);
    }
}

if (! function_exists('dump_sql')) {
    function dump_sql($builder)
    {
        $sql = $builder->toSql();
        $bindings = $builder->getBindings();

        array_walk($bindings, static function ($value) use (&$sql) {
            $value = is_string($value) ? var_export($value, true) : $value;
            $sql = preg_replace("/\?/", $value, $sql, 1);
        });

        return $sql;
    }
}

if (! function_exists('faker')) {
    function faker($property = null)
    {
        $faker = Factory::create();

        return $property ? $faker->{$property} : $faker;
    }
}

if (! function_exists('stopwatch')) {
    function stopwatch($callback, $times = 1)
    {
        $totalTime = 0;

        foreach (range(1, $times) as $time) {
            $start = microtime(true);

            $callback();

            $totalTime += microtime(true) - $start;
        }

        return $totalTime / $times;
    }
}


if (! function_exists('str_between')) {
    function str_between($subject, $beginning, $end = null)
    {
        return Str::between($subject, $beginning, $end);
    }
}
