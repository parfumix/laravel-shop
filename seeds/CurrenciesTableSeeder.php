<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        \DB::table('currencies')->delete();

        $currencies = config('laravel-shop.currencies');

        array_walk($currencies, function($options, $slug) {
            \Laravel\Shop\Currency::create([
                'title'  => $options['title'],
                'slug'   => $options['slug'],
                'symbol' => $options['symbol'],
                'active' => $options['active'],
            ]);
        });
    }
}
