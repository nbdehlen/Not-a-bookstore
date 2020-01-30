<?php

use Illuminate\Database\Seeder;

use App\Item;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create(array(
            'name' => 'Mystery Pants',
            'description' => 'Found in an abandoned barn, \
            these pants sure look like they got a story to tell.',
            'type' => 'Armor',
            'price' => 2500,
            'quantity' => 1,
            'image' => ''
        ));
        Item::create(array(
            'name' => 'Rusted Broadsword',
            'description' => 'It\'s fine, just dont try to cut anything\
            with it.',
            'type' => 'Weapon',
            'price' => 300,
            'quantity' => 8,
            'image' => ''
        ));
        Item::create(array(
            'name' => 'Red Cloak',
            'description' => 'It\'s a red cloak.',
            'type' => 'Accessory',
            'price' => 2500,
            'quantity' => 15,
            'image' => ''
        ));
        Item::create(array(
            'name' => 'Mana Potion',
            'description' => 'Need to throw some more fireballs?\
            We got you covered.',
            'type' => 'Consumable',
            'price' => 400,
            'quantity' => 25,
            'image' => ''
        ));
    }
}
