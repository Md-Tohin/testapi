<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            [
                'category_id' => 1,
                'title' => 'Introduction to Laravel',
                'slug' => 'introduction-to-laravel',
                'description' => 'A beginner\'s guide to getting started with Laravel.',
                'image' => 'https://example.com/images/laravel_intro.png',
                'created_by' => 1,
            ],
            [
                'category_id' => 2,
                'title' => 'Mastering PHP',
                'slug' => 'mastering-php',
                'description' => 'Advanced techniques and best practices for PHP development.',
                'image' => 'https://example.com/images/mastering_php.png',
                'created_by' => 2,
            ],
            [
                'category_id' => 3,
                'title' => 'JavaScript Essentials',
                'slug' => 'javascript-essentials',
                'description' => 'Core concepts and techniques for modern JavaScript programming.',
                'image' => 'https://example.com/images/js_essentials.png',
                'created_by' => 3,
            ],
            [
                'category_id' => 1,
                'title' => 'Building APIs with Laravel',
                'slug' => 'building-apis-with-laravel',
                'description' => 'A comprehensive guide to building RESTful APIs using Laravel.',
                'image' => 'https://example.com/images/apis_with_laravel.png',
                'created_by' => 4,
            ],
            [
                'category_id' => 2,
                'title' => 'PHP Security Best Practices',
                'slug' => 'php-security-best-practices',
                'description' => 'Learn how to secure your PHP applications from common vulnerabilities.',
                'image' => 'https://example.com/images/php_security.png',
                'created_by' => 5,
            ],
        ];
        Post::insert($posts);
    }
}
