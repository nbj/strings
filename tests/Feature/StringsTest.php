<?php

use Nbj\Str;
use PHPUnit\Framework\TestCase;

class StrTest extends TestCase
{
    /** @test */
    public function str_can_convert_a_string_to_upper_case()
    {
        $result = Str::toUpper('some test string');
        $this->assertEquals('SOME TEST STRING', $result);
    }

    /** @test */
    public function str_can_convert_a_string_to_lower_case()
    {
        $result = Str::toLower('SOME TEST STRING');
        $this->assertEquals('some test string', $result);
    }

    /** @test */
    public function str_can_find_the_length_of_a_string()
    {
        $result = Str::length('some test string');
        $this->assertEquals(16, $result);
    }

    /** @test */
    public function str_can_convert_strings_to_snake_case()
    {
        $result = Str::toSnake('someTestString');
        $this->assertEquals('some_test_string', $result);

        $result = Str::toSnake('SomeTestString');
        $this->assertEquals('some_test_string', $result);

        $result = Str::toSnake('some test string');
        $this->assertEquals('some_test_string', $result);

        $result = Str::toSnake('someteststring');
        $this->assertEquals('someteststring', $result);

        $result = Str::toSnake('sometestString');
        $this->assertEquals('sometest_string', $result);

        $result = Str::toSnake('some    Test    String');
        $this->assertEquals('some_test_string', $result);
    }

    /** @test */
    public function str_can_convert_strings_to_kebab_case()
    {
        $result = Str::toKebab('someTestString');
        $this->assertEquals('some-test-string', $result);

        $result = Str::toKebab('SomeTestString');
        $this->assertEquals('some-test-string', $result);

        $result = Str::toKebab('some test string');
        $this->assertEquals('some-test-string', $result);

        $result = Str::toKebab('someteststring');
        $this->assertEquals('someteststring', $result);

        $result = Str::toKebab('sometestString');
        $this->assertEquals('sometest-string', $result);

        $result = Str::toKebab('some    Test    String');
        $this->assertEquals('some-test-string', $result);
    }

    /** @test */
    public function str_can_convert_a_string_to_camel_case()
    {
        $result = Str::toCamel('some_test_string');
        $this->assertEquals('someTestString', $result);

        $result = Str::toCamel('SomeTestString');
        $this->assertEquals('someTestString', $result);

        $result = Str::toCamel('Some Test String');
        $this->assertEquals('someTestString', $result);

        $result = Str::toCamel('some Test String');
        $this->assertEquals('someTestString', $result);

        $result = Str::toCamel('some test string');
        $this->assertEquals('someTestString', $result);

        $result = Str::toCamel('some-test-string');
        $this->assertEquals('someTestString', $result);

        $result = Str::toCamel('someteststring');
        $this->assertEquals('someteststring', $result);
    }

    /** @test */
    public function str_can_convert_a_string_to_pascal_case()
    {
        $result = Str::toPascal('some_test_string');
        $this->assertEquals('SomeTestString', $result);

        $result = Str::toPascal('SomeTestString');
        $this->assertEquals('SomeTestString', $result);

        $result = Str::toPascal('Some Test String');
        $this->assertEquals('SomeTestString', $result);

        $result = Str::toPascal('some Test String');
        $this->assertEquals('SomeTestString', $result);

        $result = Str::toPascal('some test string');
        $this->assertEquals('SomeTestString', $result);

        $result = Str::toPascal('some-test-string');
        $this->assertEquals('SomeTestString', $result);

        $result = Str::toPascal('someteststring');
        $this->assertEquals('Someteststring', $result);
    }

    /** @test */
    public function to_snake_case_results_are_cached_for_better_performance()
    {
        Str::toSnake('SomeTestString');
        $result = Str::toSnake('SomeTestString');

        $this->assertEquals('some_test_string', $result);
    }

    /** @test */
    public function to_camel_case_results_are_cached_for_better_performance()
    {
        Str::toCamel('some_test_string');
        $result = Str::toCamel('some_test_string');

        $this->assertEquals('someTestString', $result);
    }

    /** @test */
    public function str_can_check_if_a_string_starts_with_another_string()
    {
        $this->assertTrue(Str::startWith('Some', 'SomeTestString'));
        $this->assertFalse(Str::startWith('Test', 'SomeTestString'));
    }

    /** @test */
    public function str_can_check_if_a_string_ends_with_another_string()
    {
        $this->assertTrue(Str::endsWith('String', 'SomeTestString'));
        $this->assertFalse(Str::endsWith('Test', 'SomeTestString'));
    }

    /** @test */
    public function str_can_check_if_a_string_contains_another_string()
    {
        $this->assertTrue(Str::contains('Test', 'SomeTestString'));
        $this->assertFalse(Str::contains('SomeThingElse', 'SomeTestString'));
    }
}
