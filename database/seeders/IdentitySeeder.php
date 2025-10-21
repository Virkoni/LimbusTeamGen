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

            [
                'sinner' => 'Yi Sang',
                'identity_name' => 'Molar Office Fixer',
                'rarity' => '00',
                'damage_types' => ['Blunt', 'Pierce'],
                'specialties' => ['Tremor', 'Discard'],
                'season' => 'S0',
                'is_base' => false,
                'image_url' => 'https://www.prydwen.gg/static/4a85ec81405aa0aaf6908e6df8f40369/60b4d/72_sm.webp'
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

            [
                'sinner' => 'Faust',
                'identity_name' => 'W Corp. L2 Cleanup Agent',
                'rarity' => '000',
                'damage_types' => ['Blunt'],
                'specialties' => ['Charge', 'Paralyze', 'Bind'],
                'season' => 'S0',
                'is_base' => false,
                'image_url' => 'https://www.prydwen.gg/static/1106fa201a3c262606a170105ff70c98/60b4d/23_sm.webp'
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

            [
                'sinner' => 'Don Quixote',
                'identity_name' => 'Shi Association South Section 5 Director',
                'rarity' => '00',
                'damage_types' => ['Slash'],
                'specialties' => ['Poise', 'Haste'],
                'season' => 'S0',
                'is_base' => false,
                'image_url' => 'https://www.prydwen.gg/static/6c4bce5e89e11bc77a9d34ba20edbfdb/60b4d/21_sm.webp'
            ],

            [
                'sinner' => 'Don Quixote',
                'identity_name' => 'Cinq Assoc. East Section 3',
                'rarity' => '000',
                'damage_types' => ['Slash'],
                'specialties' => ['Poise', 'Burn'],
                'season' => 'S0',
                'is_base' => false,
                'image_url' => 'https://www.prydwen.gg/static/d722c0b8009e7d142f078acf1a5de8e7/60b4d/135_sm.webp'
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

            [
                'sinner' => 'Ryoshu',
                'identity_name' => 'N Corp. E.G.O::Contempt, Awe',
                'rarity' => '000',
                'damage_types' => ['Pierce'],
                'specialties' => ['Bleed', 'Tremor'],
                'season' => 'S0',
                'is_base' => false,
                'image_url' => 'https://www.prydwen.gg/static/fb48e7f1bd59634adf606828a6f72c23/60b4d/154_sm.webp'
            ],

            [
                'sinner' => 'Ryoshu',
                'identity_name' => 'Lobotomy E.G.O::Red Eyes & Penitence',
                'rarity' => '000',
                'damage_types' => ['Blunt'],
                'specialties' => ['Bleed', 'Haste'],
                'season' => 'S0',
                'is_base' => false,
                'image_url' => 'https://www.prydwen.gg/static/acae3d253cbb63c402a6014750677cf7/60b4d/115_sm.webp'
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

            [
                'sinner' => 'Meursault',
                'identity_name' => 'The Thumb East Capo IIII',
                'rarity' => '000',
                'damage_types' => ['Slash', 'Blunt'],
                'specialties' => ['Burn', 'Tremor', 'Ammo'],
                'season' => 'S0',
                'is_base' => false,
                'image_url' => 'https://www.prydwen.gg/static/aab0c75b94d71c009ac67f0a92e4a4c5/60b4d/146_sm.webp'
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

            [
                'sinner' => 'Hong Lu',
                'identity_name' => 'Tingtang Gang Gangleader',
                'rarity' => '000',
                'damage_types' => ['Slash', 'Pierce'],
                'specialties' => ['Bleed'],
                'season' => 'S0',
                'is_base' => false,
                'image_url' => 'https://www.prydwen.gg/static/7a0a1168b6ada9b410fbac93341270d7/60b4d/5_sm.webp'
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

            [
                'sinner' => 'Heathcliff',
                'identity_name' => 'Kurokumo Clan Wakashu',
                'rarity' => '000',
                'damage_types' => ['Slash'],
                'specialties' => ['Bleed'],
                'season' => 'S0',
                'is_base' => false,
                'image_url' => 'https://www.prydwen.gg/static/9df47c6be41a4c157506dfe0d1068856/60b4d/132_sm.webp'
            ],

            [
                'sinner' => 'Heathcliff',
                'identity_name' => 'Full-Stop Office Fixer',
                'rarity' => '000',
                'damage_types' => ['Pierce'],
                'specialties' => ['Ammo', 'Poise'],
                'season' => 'S0',
                'is_base' => false,
                'image_url' => 'https://www.prydwen.gg/static/1f97f6ff3294d4791cf2aac19ccc68ee/60b4d/128_sm.webp'
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

            [
                'sinner' => 'Ishmael',
                'identity_name' => 'Family Hierarch Candidate',
                'rarity' => '000',
                'damage_types' => ['Blunt', 'Slash'],
                'specialties' => ['Poise', 'Rupture'],
                'season' => 'S0',
                'is_base' => false,
                'image_url' => 'https://www.prydwen.gg/static/ad8919455ed70529a2eb3c26993bfc22/60b4d/144_sm.webp'
            ],

            [
                'sinner' => 'Ishmael',
                'identity_name' => 'Zwei. Assoc. West Section 3',
                'rarity' => '000',
                'damage_types' => ['Blunt'],
                'specialties' => ['Tremor', 'Aggro'],
                'season' => 'S0',
                'is_base' => false,
                'image_url' => 'https://www.prydwen.gg/static/a53cff4436c4a0f5d417ed06cbdb7088/60b4d/118_sm.webp'
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

            [
                'sinner' => 'Rodion',
                'identity_name' => 'Dieci Assoc. South Section 4',
                'rarity' => '0',
                'damage_types' => ['Slash'],
                'specialties' => ['Sinking', 'Discard', 'Aggro'],
                'season' => 'S0',
                'is_base' => false,
                'image_url' => 'https://www.prydwen.gg/static/644a063ef07163b6eaa55f3814eb875e/60b4d/74_sm.webp'
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

            [
                'sinner' => 'Sinclair',
                'identity_name' => 'Blade Lineage Salsu',
                'rarity' => '000',
                'damage_types' => ['Slash', 'Pierce'],
                'specialties' => ['Bleed', 'Paralyze', 'Poise'],
                'season' => 'S0',
                'is_base' => false,
                'image_url' => 'https://www.prydwen.gg/static/2781029f2c5225e997309500acbde2a1/60b4d/10_sm.webp'
            ],

            [
                'sinner' => 'Sinclair',
                'identity_name' => 'The Middle Little Brother',
                'rarity' => '000',
                'damage_types' => ['Blunt'],
                'specialties' => ['Bleed', 'Aggro', 'Barrier'],
                'season' => 'S0',
                'is_base' => false,
                'image_url' => 'https://www.prydwen.gg/static/369b697bbd47ec33aff4a567b5f2d50a/60b4d/139_sm.webp'
            ],

            [
                'sinner' => 'Sinclair',
                'identity_name' => 'Los Mariachis Jefe',
                'rarity' => '00',
                'damage_types' => ['Blunt'],
                'specialties' => ['Poise', 'Sinking'],
                'season' => 'S0',
                'is_base' => false,
                'image_url' => 'https://www.prydwen.gg/static/53217aa98aed9e95351771248e86879f/60b4d/24_sm.webp'
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

            [
                'sinner' => 'Outis',
                'identity_name' => 'The Barber of La Manchaland',
                'rarity' => '000',
                'damage_types' => ['Slash'],
                'specialties' => ['Bleed'],
                'season' => 'S0',
                'is_base' => false,
                'image_url' => 'https://www.prydwen.gg/static/8d6746b713c1cf951d9d03305123ead6/60b4d/121_sm.webp'
            ],

            [
                'sinner' => 'Outis',
                'identity_name' => 'The Ring Pointillist Student',
                'rarity' => '00',
                'damage_types' => ['Pierce'],
                'specialties' => ['Bleed', 'Burn', 'Haste', 'Rupture', 'Sinking', 'Tremor'],
                'season' => 'S0',
                'is_base' => false,
                'image_url' => 'https://www.prydwen.gg/static/f2cdd071f5b6084bd1acdbd65ddd67f1/60b4d/105_sm.webp'
            ],

            // Gregor IDs
            // Base ID
            [
                'sinner' => 'Gregor',
                'identity_name' => 'Firefist Office Survivor',
                'rarity' => '0',
                'damage_types' => ['Pierce', 'Slash'],
                'specialties' => ['Rupture'],
                'season' => 'S0',
                'is_base' => true,
                'image_url' => 'https://www.prydwen.gg/static/becc6845c70e6ecc5d042abc0441f304/60b4d/37_sm.webp'
            ],

            [
                'sinner' => 'Gregor',
                'identity_name' => 'LCB Sinner',
                'rarity' => '000',
                'damage_types' => ['Blunt'],
                'specialties' => ['Burn'],
                'season' => 'S0',
                'is_base' => false,
                'image_url' => 'https://www.prydwen.gg/static/a737268518735d538f3b9e9a6a7db1be/60b4d/136_sm.webp'
            ],

            [
                'sinner' => 'Gregor',
                'identity_name' => 'G Corp. Manager Corporal',
                'rarity' => '00',
                'damage_types' => ['Slash', 'Pierce'],
                'specialties' => ['Rupture'],
                'season' => 'S0',
                'is_base' => false,
                'image_url' => 'https://www.prydwen.gg/static/088a3561e67414ea5bebd5bd5b2ffc12/60b4d/1_sm.webp'
            ],
        ];

        foreach ($identities as $identity) {
            Identity::create($identity);
        }
    }
}
