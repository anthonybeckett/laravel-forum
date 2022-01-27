<?php

namespace Database\Seeders;

use App\Models\Channel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ChannelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create([
            'name' => 'Laravel 8',
            'slug' => Str::slug('Laravel 8')
        ]);

        Channel::create([
            'name' => 'React JS',
            'slug' => Str::slug('React JS')
        ]);

        Channel::create([
            'name' => 'Angular JS',
            'slug' => Str::slug('Angular JS')
        ]);

        Channel::create([
            'name' => 'Node JS',
            'slug' => Str::slug('Node JS')
        ]);
    }
}
