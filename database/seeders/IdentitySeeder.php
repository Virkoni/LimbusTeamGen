<?php

namespace Database\Seeders;

use App\Models\Identity;
use Illuminate\Database\Seeder;

class IdentitySeeder extends Seeder
{
    public function run()
    {
        $identities = [

            // Yi Sang IDs
            // Base ID
            [
                'sinner' => 'Yi Sang',
                'identity_name' => 'LCB Sinner',
                'rarity' => '0',
                'damage_types' => ['Slash', 'Pierce'],
                'specialties' => ['Sinking', 'Fragile'],
                'season' => 'S0',
                'is_base' => true,
                'image_url' => 'https://www.prydwen.gg/static/400a105d43edf36022c8e4c903005870/60b4d/26_sm.webp'
            ],

            // Faust IDs
            // Base ID
            [
                'sinner' => 'Faust',
                'identity_name' => 'LCB Sinner',
                'rarity' => '0',
                'damage_types' => ['Blunt', 'Pierce'],
                'specialties' => ['Paralyze'],
                'season' => 'S0',
                'is_base' => true,
                'image_url' => 'https://www.prydwen.gg/static/8a5e04ce3cf669ac6c20013fa984b65e/60b4d/27_sm.webp'
            ],

            // Don Quixote IDs
            // Base ID
            [
                'sinner' => 'Don Quixote',
                'identity_name' => 'LCB Sinner',
                'rarity' => '0',
                'damage_types' => ['Pierce'],
                'specialties' => ['Bleed'],
                'season' => 'S0',
                'is_base' => true,
                'image_url' => 'https://www.prydwen.gg/static/c832f4288e8210b40a79b55b2db2afba/60b4d/28_sm.webp'
            ],

            // Ryoshu IDs
            // Base ID
            [
                'sinner' => 'Ryoshu',
                'identity_name' => 'LCB Sinner',
                'rarity' => '0',
                'damage_types' => ['Slash'],
                'specialties' => ['Poise'],
                'season' => 'S0',
                'is_base' => true,
                'image_url' => 'https://www.prydwen.gg/static/03006ea467c31f6c042150828ea31e2e/60b4d/29_sm.webp'
            ],
            // Meursault IDs
            // Base ID
            [
                'sinner' => 'Meursault',
                'identity_name' => 'LCB Sinner',
                'rarity' => '0',
                'damage_types' => ['Blunt'],
                'specialties' => ['Tremor'],
                'season' => 'S0',
                'is_base' => true,
                'image_url' => 'https://www.prydwen.gg/static/7db6c89c678c8b506d3694953b05bab1/60b4d/31_sm.webp'
            ],
            // Hong Lu IDs
            // Base ID
            [
                'sinner' => 'Hong Lu',
                'identity_name' => 'LCB Sinner',
                'rarity' => '0',
                'damage_types' => ['Blunt', 'Slash'],
                'specialties' => ['Sinking', 'Rupture'],
                'season' => 'S0',
                'is_base' => true,
                'image_url' => 'https://www.prydwen.gg/static/6f1d76103e3d8d53067dba4da6df22e5/60b4d/30_sm.webp'
            ],

            // Heathcliff IDs
            // Base ID
            [
                'sinner' => 'Heathcliff',
                'identity_name' => 'LCB Sinner',
                'rarity' => '0',
                'damage_types' => ['Blunt'],
                'specialties' => ['Tremor'],
                'season' => 'S0',
                'is_base' => true,
                'image_url' => 'https://www.prydwen.gg/static/acb2e419fce4f4e89d3df839ec9b5825/60b4d/36_sm.webp'
            ],

            // Ishmael IDs
            // Base ID
            [
                'sinner' => 'Ishmael',
                'identity_name' => 'LCB Sinner',
                'rarity' => '0',
                'damage_types' => ['Blunt'],
                'specialties' => ['Tremor'],
                'season' => 'S0',
                'is_base' => true,
                'image_url' => 'https://www.prydwen.gg/static/53513ccc3e2d99fbc7e13ad7d0503695/60b4d/32_sm.webp'
            ],

            // Rodion IDs
            // Base ID
            [
                'sinner' => 'Rodion',
                'identity_name' => 'LCB Sinner',
                'rarity' => '0',
                'damage_types' => ['Slash'],
                'specialties' => ['Bleed'],
                'season' => 'S0',
                'is_base' => true,
                'image_url' => 'https://www.prydwen.gg/static/c0049ad4a490f047682177a306e04e43/60b4d/33_sm.webp'
            ],

            // Sinclair IDs
            // Base ID
            [
                'sinner' => 'Sinclair',
                'identity_name' => 'LCB Sinner',
                'rarity' => '0',
                'damage_types' => ['Slash'],
                'specialties' => ['Rupture'],
                'season' => 'S0',
                'is_base' => true,
                'image_url' => 'https://www.prydwen.gg/static/34791758301b54cba3f567b86d8f85e1/60b4d/34_sm.webp'
            ],

            // Outis IDs
            // Base ID
            [
                'sinner' => 'Outis',
                'identity_name' => 'LCB Sinner',
                'rarity' => '0',
                'damage_types' => ['Pierce', 'Slash'],
                'specialties' => ['Rupture'],
                'season' => 'S0',
                'is_base' => true,
                'image_url' => 'https://www.prydwen.gg/static/3b2c0a096923d52920b79b61ba78a4ef/60b4d/35_sm.webp'
            ],

            // Gregor IDs
            // Base ID
            [
                'sinner' => 'Gregor',
                'identity_name' => 'LCB Sinner',
                'rarity' => '0',
                'damage_types' => ['Pierce', 'Slash'],
                'specialties' => ['Rupture'],
                'season' => 'S0',
                'is_base' => true,
                'image_url' => 'https://www.prydwen.gg/static/becc6845c70e6ecc5d042abc0441f304/60b4d/37_sm.webp'
            ],
        ];

        foreach ($identities as $identity) {
            Identity::create($identity);
        }
    }
}
