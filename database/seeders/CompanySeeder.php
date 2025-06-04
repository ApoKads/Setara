<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Category;
use App\Models\CategoryCompany;
use Illuminate\Database\Seeder;
use Database\Seeders\CategoryCompanySeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Company::factory()->create([
            'name'=>'PT JAYA ABADI',
            'location'=>'Jakarta Barat',
            'description'=>'lorem ipsum et dolor sit amet',
        ]);

        Company::factory()->create([
            'name'=>'PT PEMIMPIN ASIA',
            'location'=>'Balikpapan',
            'description'=>'Datang tak diundang, pulang harus di bom',
        ]);

        Company::factory()->create([
            'name'=>'PT CAHAYA YEDIJA',
            'location'=>'Depok',
            'description'=>'Anak Perusahaan dari perusahaan BG Corp dengan Alias Winion',
        ]);

        Company::factory()->create([
            'name'=>'PT UNDRA SUKSES',
            'location'=>'Surabaya',
            'description'=>'Tim Sukses PPTI 18',

        ]);

        Company::factory()->create([
            'name'=>'PT UNDRA SUKSES 2',
            'location'=>'Surabaya',
            'description'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur corporis nihil illo dolorem totam aliquid, quisquam commodi officiis dolores exercitationem, odio unde necessitatibus expedita itaque rerum, cum laudantium impedit minima eius. Assumenda architecto sequi sunt, quos, numquam, molestiae facere consequatur molestias perferendis aliquam alias laboriosam consequuntur quis porro harum saepe!',

        ]);

        Company::factory()->count(100)->create();

        $this->call([CategoryCompanySeeder::class]);


        // CategoryCompany::factory(100)->recycle([
        //     Company::all(),
        //     Category::all()
        // ])->create()->ensureUniqueRelationships(['company_id', 'category_id']);
    }
}
