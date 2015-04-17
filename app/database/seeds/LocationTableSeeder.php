<?php
 
class LocationTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('location')->delete();
 
        Location::create(array(
            'user_id' => 3,
            'country_name' => 'United States',
            'state_name' => 'Wisconsin',
            'city_name' => 'Milwaukee',
            'street_name' => 'North 20th Street',
            'street_number' => '836',
            'room_number' => '23',
            'level' => 6,
            'parent' => 0
        ));

        Location::create(array(
            'user_id' => 3,
            'country_name' => 'United States',
            'state_name' => 'Wisconsin',
            'city_name' => 'Milwaukee',
            'street_name' => 'North 20th Street',
            'street_number' => '836',
            'room_number' => '22',
            'level' => 6,
            'parent' => 0
        ));

        Location::create(array(
            'user_id' => 3,
            'country_name' => 'United States',
            'state_name' => 'Wisconsin',
            'city_name' => 'Milwaukee',
            'street_name' => 'North 20th Street',
            'street_number' => '836',
            'level' => 5,
            'parent' => 0
        ));

        Location::create(array(
            'user_id' => 3,
            'country_name' => 'United States',
            'state_name' => 'Wisconsin',
            'city_name' => 'Milwaukee',
            'street_name' => 'North 20th Street',
            'street_number' => '835',
            'room_number' => '22',
            'level' => 6,
            'parent' => 0
        ));

        Location::create(array(
            'user_id' => 3,
            'country_name' => 'United States',
            'state_name' => 'Wisconsin',
            'city_name' => 'Milwaukee',
            'street_name' => 'North 20th Street',
            'level' => 4,
            'parent' => 0
        ));

        Location::create(array(
            'user_id' => 3,
            'country_name' => 'United States',
            'state_name' => 'Wisconsin',
            'city_name' => 'Milwaukee',
            'street_name' => 'North 20th Street',
            'street_number' => '4210',
            'room_number' => '24',
            'level' => 6,
            'parent' => 0
        ));

         Location::create(array(
            'user_id' => 3,
            'country_name' => 'United States',
            'state_name' => 'Wisconsin',
            'city_name' => 'Milwaukee',
            'street_name' => 'North 20th Street',
            'level' => 4,
            'parent' => 0
        ));

        Location::create(array(
            'user_id' => 3,
            'country_name' => 'United States',
            'state_name' => 'Wisconsin',
            'city_name' => 'Milwaukee',
            'street_name' => 'North 22th Street',
            'street_number' => '2231',
            'room_number' => '26',
            'level' => 6,
            'parent' => 0
        ));


        Location::create(array(
            'user_id' => 3,
            'country_name' => 'United States',
            'state_name' => 'Wisconsin',
            'city_name' => 'Milwaukee',
            'street_name' => 'North 44th Street',
            'street_number' => '777',
            'level' => 5,
            'parent' => 0
        ));

        Location::create(array(
            'user_id' => 3,
            'country_name' => 'United States',
            'state_name' => 'Wisconsin',
            'city_name' => 'Milwaukee',
            'level' => 3,
            'parent' => 0
        ));

        Location::create(array(
            'user_id' => 3,
            'country_name' => 'United States',
            'state_name' => 'Wisconsin',
            'level' => 2,
            'parent' => 0
        ));

        Location::create(array(
            'user_id' => 3,
            'country_name' => 'United States',
            'level' => 1,
            'parent' => 0
        ));
 
    }
 
}