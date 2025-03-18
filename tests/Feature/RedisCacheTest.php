<?php

namespace Tests\Feature;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class RedisCacheTest extends TestCase
{
    /** @test */
    public function it_can_store_and_retrieve_data_from_redis()
    {
        // Test ma'lumotni Redis'ga saqlaymiz
        Cache::store('redis')->put('test_key', 'Hello Redis!', 60);

        // Saqlangan qiymatni qayta o‘qiymiz
        $value = Cache::store('redis')->get('test_key');

        // Qiymat tekshiriladi
        $this->assertEquals('Hello Redis!', $value);
    }

    /** @test */
    public function it_can_delete_data_from_redis()
    {
        // Avval ma'lumotni saqlaymiz
        Cache::store('redis')->put('test_key', 'Temporary Data', 60);

        // Keyin uni o‘chiramiz
        Cache::store('redis')->forget('test_key');

        // Ma'lumot o‘chirilganini tekshiramiz
        $this->assertNull(Cache::store('redis')->get('test_key'));
    }
}