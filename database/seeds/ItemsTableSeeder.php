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
            'name' => 'MYSTERY PANTS',
            'description' => 'Found in an abandoned barn, 
            these pants sure look like they got a story to tell.',
            'type' => 'Armor',
            'price' => 2500,
            'quantity' => 1,
            'image' => 'images/items/mysterypants.png'
        ));
        
        Item::create(array(
            'name' => 'AMULET',
            'description' => 'Chance on hit to charm the enemy. 
            While charmed, the enemy takes 35% increased damage.',
            'type' => 'Jewelery',
            'price' => 1500,
            'quantity' => 4,
            'image' => 'images/items/amulet.png'
        ));
        
        Item::create(array(
            'name' => 'ANCESTORS\' GRACE',
            'description' => 'Legendary Amulet. When receiving 
            fatal damage, you are instead restored to 100% of maximum 
            Life and resources. This item is destroyed in the process.',
            'type' => 'Jewelery',
            'price' => 3000,
            'quantity' => 2,
            'image' => 'images/items/ancestorsgrace.png'
        ));

        Item::create(array(
            'name' => 'BAND OF MIGHT',
            'description' => 'Legendary Ring. After casting Furious Charge, 
            Ground Stomp, or Leap, take 60–80% reduced damage for 8 seconds.',
            'type' => 'Jewelery',
            'price' => 2800,
            'quantity' => 2,
            'image' => 'images/items/bandofmight.png'
        ));

        Item::create(array(
            'name' => 'CINDER COAT',
            'description' => 'Legendary Chest Armor. Fire skills deal [15 - 20]% more damage.
            Reduces the resource cost of Fire skills by 27%.',
            'type' => 'Armor',
            'price' => 3200,
            'quantity' => 6,
            'image' => 'images/items/cindercoat.png'
        ));

        Item::create(array(
            'name' => 'COSMIC STRAND',
            'description' => '+[340 - 370]-[380 - 450] Damage. 
            Teleport gains the effect of the Wormhole rune.
            Holds the secret to existence for those who can decipher its intricate design.',
            'type' => 'Legendary Source',
            'price' => 4000,
            'quantity' => 5,
            'image' => 'images/items/cosmicstrand.png'
        ));
        
        Item::create(array(
            'name' => 'COUNTESS JULIA\'S CAMEO',
            'description' => 'Legendary Amulet. Prevent all Arcane damage taken and heal yourself 
            for 20–25% of the amount prevented.',
            'type' => 'Jewelery',
            'price' => 2500,
            'quantity' => 7,
            'image' => 'images/items/countessjulietscameo.png'
        ));

        Item::create(array(
            'name' => 'FIRE BRAND',
            'description' => 'Legendary Two-Handed Axe. +[732 - 894]-[877 - 1111] Fire Damage.
            +[81 - 100] Fire Resistance. 
            [25 - 50]% chance to cast a fireball when attacking.',
            'type' => 'Weapon',
            'price' => 3800,
            'quantity' => 18,
            'image' => 'images/items/firebrand.png'
        ));

        Item::create(array(
            'name' => 'GOLDSKIN',
            'description' => 'Legendary Chest Armor. 
            +[91 - 100] Resistance to All Elements.  +100% Extra Gold from Monsters. 
            Chance for enemies to drop gold when you hit them.',
            'type' => 'Armor',
            'price' => 3200,
            'quantity' => 4,
            'image' => 'images/items/goldskin.png'
        ));

        Item::create(array(
            'name' => 'GOLEMSKIN BREECHES',
            'description' => 'Legendary Pants. The cooldown on Command Golem 
            is reduced by 24 seconds and you take 30% less damage while your 
            golem is alive. (Necromancer Only) [20 - 25]',
            'type' => 'Armor',
            'price' => 1800,
            'quantity' => 10,
            'image' => 'images/items/golemskinbreeches.png'
        ));

        Item::create(array(
            'name' => 'HAUNT OF VAXO',
            'description' => 'Legendary Amulet. 
            Critical Hit Chance Increased by [8.0 - 10.0]%. 
            Summons shadow clones to your aid when you Stun an enemy. 
            This effect may occur once every 30 seconds.',
            'type' => 'Jewelery',
            'price' => 2000,
            'quantity' => 9,
            'image' => 'images/items/hauntofvaxo.png'
        ));

        Item::create(array(
            'name' => 'HEALTH POTION',
            'description' => 'Grants an instant heal of 60% of 
            maximum health, with a 30 second cooldown before 
            another potion can be consumed.',
            'type' => 'Consumables',
            'price' => 300,
            'quantity' => 19,
            'image' => 'images/items/healthpotion.png'
        ));

        Item::create(array(
            'name' => 'KULLE-AID POTION',
            'description' => 'Legendary Health Potion. 
            It grants the same instant 60% health refill as a normal potion, 
            plus adds a special legendary bonus on top of that, granting the 
            ability to break through Waller walls for 5 seconds.',
            'type' => 'Consumables',
            'price' => 600,
            'quantity' => 20,
            'image' => 'images/items/kulle-aidpotion.png'
        ));

        Item::create(array(
            'name' => 'LEORIC\'S CROWN',
            'description' => 'Legendary Helm. Increases the effect of any 
            non-Legendary gem socketed into the helm by 75–100%. 
            The crown of the Black King.',
            'type' => 'Armor',
            'price' => 4000,
            'quantity' => 8,
            'image' => 'images/items/leoricscrown.png'
        ));

        Item::create(array(
            'name' => 'LUT SOCKS',
            'description' => 'Legendary Boots. Leap can be cast up to 
            three times within 2 seconds before the cooldown begins. (Barbarian Only)',
            'type' => 'Armor',
            'price' => 1200,
            'quantity' => 9,
            'image' => 'images/items/lutsocks.png'
        ));

        Item::create(array(
            'name' => 'MANALD HEAL',
            'description' => 'Legendary Ring. Enemies stunned with 
            Paralysis also take 13,462% weapon damage as Lightning.',
            'type' => 'Jewelery',
            'price' => 3100,
            'quantity' => 6,
            'image' => 'images/items/manaldheal.png'
        ));

        Item::create(array(
            'name' => 'MASK OF SCARLET DEATH',
            'description' => 'Legendary Helm. Revive now consumes all 
            corpses to raise a minion that deals 135% more damage per corpse.',
            'type' => 'Armor',
            'price' => 3500,
            'quantity' => 3,
            'image' => 'images/items/maskofscarletdeath.png'
        ));

        Item::create(array(
            'name' => 'MAXIMUS',
            'description' => 'Legendary Two-Handed Sword. 
            +[1177 - 1439]-[1410 - 1788] Fire Damage. 
            Fire skills deal [15 - 20]% more damage. 
            Chance on hit to summon a Demonic Slave.',
            'type' => 'Weapon',
            'price' => 4200,
            'quantity' => 7,
            'image' => 'images/items/maximus.png'
        ));

        Item::create(array(
            'name' => 'REJUVANATION POTION',
            'description' => 'Legendary Health Potion. 
            Restores 10-15% of your primary resource when used below 25% Life.',
            'type' => 'Consumables',
            'price' => 800,
            'quantity' => 20,
            'image' => 'images/items/rejuvanationpotion.png'
        ));

        Item::create(array(
            'name' => 'ROGAR\'S HUGE STONE',
            'description' => 'Legendary Ring. Increase your Life per Second by 
            up to 95% based on your missing Life.',
            'type' => 'Jewelery',
            'price' => 2800,
            'quantity' => 11,
            'image' => 'images/items/rogarshugestone.png'
        ));

        Item::create(array(
            'name' => 'SKORN',
            'description' => 'Legendary Two-Handed Axe. 
            [34.0 - 39.0]% chance to inflict Bleed for [300 - 400]%
             weapon damage over 5 seconds. ',
            'type' => 'Weapon',
            'price' => 4500,
            'quantity' => 8,
            'image' => 'images/items/skorn.png'
        ));

        Item::create(array(
            'name' => 'STORM SHIELD',
            'description' => 'Legendary Shield. Reduces damage from 
            melee attacks by [25.0 - 30.0]%',
            'type' => 'Shield',
            'price' => 3000,
            'quantity' => 3,
            'image' => 'images/items/stormshield.png'
        ));
        
        Item::create(array(
            'name' => 'SULTAN',
            'description' => 'Legendary Two-Handed Sword. 
            +[1177 - 1439]-[1410 - 1788] Holy Damage.',
            'type' => 'Weapon',
            'price' => 3000,
            'quantity' => 1,
            'image' => 'images/items/sultan.png'
        ));

        Item::create(array(
            'name' => 'THE ESS OF JOHAN',
            'description' => 'Legendary Amulet. 
            Reduces cooldown of all skills by [5.0 - 8.0]%.',
            'type' => 'Jewelery',
            'price' => 2900,
            'quantity' => 5,
            'image' => 'images/items/theessofjohan.png'
        ));

        Item::create(array(
            'name' => 'TORMENTOR',
            'description' => 'Legendary Staff. 
            Chance to charm enemies when you hit them.',
            'type' => 'Weapon',
            'price' => 4000,
            'quantity' => 4,
            'image' => 'images/items/tormentor.png'
        ));

        Item::create(array(
            'name' => 'VALTHEK\'S REBUKE',
            'description' => 'Legendary Staff. 
            Energy Twister now travels in a straight path.',
            'type' => 'Weapon',
            'price' => 3000,
            'quantity' => 7,
            'image' => 'images/items/valtheksrebuke.png'
        ));
    }
}
