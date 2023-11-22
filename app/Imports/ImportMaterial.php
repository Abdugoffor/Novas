<?php

namespace App\Imports;

use App\Models\Log;
use App\Models\Material;
use App\Models\MaterialStokValue;
use App\Models\Nakladnoy;
use App\Models\Prixod;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportMaterial implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {

        $nakladnoy = Nakladnoy::create([
            'shipper' => $rows[1][2],
            'consignee' => $rows[2][2],
            'nomer' => $rows[3][2],
            'sender' => $rows[4][2],
            'recipient' => $rows[5][2],
            'date' => $rows[6][2],
        ]);
        unset($rows[0], $rows[1], $rows[2], $rows[3], $rows[4], $rows[5], $rows[6], $rows[7], $rows[8], $rows[9]);
        $date = [];

        // dd($rows);
        
        foreach ($rows as $row) {

            $date[] = $row;

            $material = Material::where('name', mb_strtolower($row[1]))->first();
            if ($material) {
                Prixod::create([
                    'material_id' => $material->id,
                    'nakladnoy_id' => $nakladnoy->id,
                    'unit' => $row[2],
                    'quantity' => $row[3],
                    'price' => $row[4],
                    'sum' => ($row[3] * $row[4]),
                    'term' => $row[6],
                ]);
            } else {
                $material = Material::create(['name' => mb_strtolower($row[1])]);
                Prixod::create([
                    'material_id' => $material->id,
                    'nakladnoy_id' => $nakladnoy->id,
                    'unit' => $row[2],
                    'quantity' => $row[3],
                    'price' => $row[4],
                    'sum' => ($row[3] * $row[4]),
                    'term' => $row[6],
                ]);
            }
            $materialStokValue = MaterialStokValue::where('material_id', $material->id)->where('material_stok_id', 1)->first();
            if ($materialStokValue) {
                Log::create([
                    'type' => 1, // 1 prixod, 2 transfer
                    'increment' => 1, // 1 qo'shilish, 2 ayirilish
                    'material_id' => $material->id,
                    'quantity' => $row[4],
                    'went' => $materialStokValue->quantity, // nechta edi ,
                    'remained' => $materialStokValue->quantity + $row[4], // nechta qoldi
                    'from_id' => $nakladnoy->id,
                    'to_id' => 1,
                ]);
                $materialStokValue->update([
                    'unit' => $row[2],
                    'quantity' => $materialStokValue->quantity + $row[3],
                ]);
            } else {

                $materialStokValue = MaterialStokValue::create([
                    'material_stok_id' => 1,
                    'material_id' => $material->id,
                    'unit' => $row[2],
                    'quantity' => $row[3],
                ]);
                Log::create([
                    'type' => 1, // 1 prixod, 2 transfer
                    'increment' => 1, // 1 qo'shilish, 2 ayirilish
                    'material_id' => $material->id,
                    'quantity' => $row[4],
                    'went' => 0, // nechta edi ,
                    'remained' => $row[4], // nechta qoldi
                    'from_id' => $nakladnoy->id,
                    'to_id' => 1,
                ]);
            }
        }
        // dd($date);
    }
}
