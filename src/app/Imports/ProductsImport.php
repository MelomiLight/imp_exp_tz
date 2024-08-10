<?php

namespace App\Imports;

use App\Jobs\ProcessPhoto;
use App\Models\Product;
use App\Models\ProductAdditionalInfo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection): void
    {
        DB::transaction(function () use ($collection) {
            foreach ($collection as $row) {
                $existingProduct = Product::where('external_code', $row['vnesnii_kod'])->first();

                if (!$existingProduct) {
                    $product = Product::create([
                        'external_code' => $row['vnesnii_kod'],
                        'name' => $row['naimenovanie'],
                        'description' => $row['opisanie'],
                        'price' => (float)$row['cena_cena_prodazi'],
                        'currency_price' => $row['valiuta_cena_prodazi'],
                        'purchase_price' => (float)$row['zakupocnaia_cena'],
                        'currency_purchase_price' => $row['valiuta_zakupocnaia_cena'],
                    ]);

                    ProductAdditionalInfo::create([
                        'product_id' => $product->id,
                        'size' => $row['dop_pole_razmer'] ?? null,
                        'colour' => $row['dop_pole_cvet'] ?? null,
                        'brand' => $row['dop_pole_brend'] ?? null,
                        'structure' => $row['dop_pole_sostav'] ?? null,
                        'amount_package' => $row['dop_pole_kol_vo_v_upakovke'] ?? null,
                        'seo_title' => $row['dop_pole_seo_title'] ?? null,
                        'seo_h1' => $row['dop_pole_seo_h1'] ?? null,
                        'seo_description' => $row['dop_pole_seo_description'] ?? null,
                        'weight_product_g' => $row['dop_pole_ves_tovarag'] ?? null,
                        'width_product_mm' => $row['dop_pole_sirinamm'] ?? null,
                        'height_product_mm' => $row['dop_pole_vysotamm'] ?? null,
                        'length_product_mm' => $row['dop_pole_dlinamm'] ?? null,
                        'weight_package_g' => $row['dop_pole_ves_upakovkig'] ?? null,
                        'width_package_mm' => $row['dop_pole_sirina_upakovkimm'] ?? null,
                        'height_package_mm' => $row['dop_pole_vysota_upakovkimm'] ?? null,
                        'length_package_mm' => $row['dop_pole_dlina_upakovkimm'] ?? null,
                        'category' => $row['dop_pole_kategoriia_tovara'] ?? null,
                    ]);

                    ProcessPhoto::dispatch($row['dop_pole_ssylka_na_upakovku'], $product->id, 'package');

                    if (isset($row['dop_pole_ssylki_na_foto'])) {
                        $photoUrls = explode(',', $row['dop_pole_ssylki_na_foto']);
                        foreach ($photoUrls as $url) {
                            ProcessPhoto::dispatch(trim($url), $product->id, 'photo');
                        }
                    }
                } else {
                    Log::info("Skipped product with external_code: " . $row['vnesnii_kod']);
                }
            }
        });
    }
}
