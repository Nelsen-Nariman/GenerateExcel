<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ExcelService
{
    public function generateClosingExcel(array $data)
    {
        // Load the template file
        $templatePath = resource_path('templates/OutputClosing_Template.xlsx');

        if (!file_exists($templatePath)) {
            throw new \Exception("Template file not found at: " . $templatePath);
        }
        
        if (!is_readable($templatePath)) {
            throw new \Exception("Template file is not readable at: " . $templatePath);
        }
        
        try {
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
            if (!$reader->canRead($templatePath)) {
                throw new \Exception("Reader cannot read the file at: " . $templatePath);
            }
            $spreadsheet = $reader->load($templatePath);
        } catch (\Exception $e) {
            throw new \Exception("Error loading template: " . $e->getMessage() . " at: " . $templatePath);
        }
        $sheet = $spreadsheet->getActiveSheet();

        // Concatenate plan and tipe_plan
        $fullPlanName = match(true) {
            str_contains($data['plan'], 'BRONZE I') => 'BRONZE ' . $data['tipe_plan'] . ' I',
            str_contains($data['plan'], 'BRONZE II') => 'BRONZE ' . $data['tipe_plan'] . ' II',
            default => $data['plan'] . ' ' . $data['tipe_plan']
        };

        // Fill in the template cells
        $sheet->setCellValue('C2', $data['tipe_klien']);
        $sheet->setCellValue('C3', $data['nama_pemegang_polis']);
        $sheet->setCellValue('C4', $data['tertanggung']);
        $sheet->setCellValue('C5', $data['tertanggung_tambahan'] ?? '-');
        $sheet->setCellValue('C6', $fullPlanName);
        $sheet->setCellValue('C7', $data['tipe_tanggungan']);

        if ($this->data['tipe_plan'] === 'X'){
            if ($this->data['tipe_klien'] === 'Tanpa Tanggungan Mandiri'){
                if ($this->data['plan'] === 'BRONZE I'){
                    $data['premi'] = 6701000;
                    $data['premi_tertanggung_tambahan'] = 0;
                }
                else if ($this->data['plan'] === 'BRONZE II'){
                    $data['premi'] = 5649000;
                    $data['premi_tertanggung_tambahan'] = 0;
                }
                else if ($this->data['plan'] === 'SILVER'){
                    $data['premi'] = 8004000;
                    $data['premi_tertanggung_tambahan'] = 0;
                }
                else if ($this->data['plan'] === 'GOLD'){
                    $data['premi'] = 15449000;
                    $data['premi_tertanggung_tambahan'] = 0;
                }
                else if ($this->data['plan'] === 'TITANIUM'){
                    $data['premi'] = 22897000;
                    $data['premi_tertanggung_tambahan'] = 0;
                }
                else{
                    $data['premi'] = 23113000;
                    $data['premi_tertanggung_tambahan'] = 0;
                }
            }
            else{
                if ($this->data['plan'] === 'BRONZE I'){
                    $data['premi'] = 5027000;
                    $data['premi_tertanggung_tambahan'] = 0;
                }
                else if ($this->data['plan'] === 'BRONZE II'){
                    $data['premi'] = 4521000;
                    $data['premi_tertanggung_tambahan'] = 0;
                }
                else if ($this->data['plan'] === 'SILVER'){
                    $data['premi'] = 6005000;
                    $data['premi_tertanggung_tambahan'] = 0;
                }
                else if ($this->data['plan'] === 'GOLD'){
                    $data['premi'] = 10044000;
                    $data['premi_tertanggung_tambahan'] = 0;
                }
                else if ($this->data['plan'] === 'TITANIUM'){
                    $data['premi'] = 14886000;
                    $data['premi_tertanggung_tambahan'] = 0;
                }
                else{
                    $data['premi'] = 15025000;
                    $data['premi_tertanggung_tambahan'] = 0;
                }
            }
        }
        else{
            if ($this->data['tipe_klien'] === 'Tanpa Tanggungan Mandiri'){
                if ($this->data['plan'] === 'BRONZE I'){
                    $data['premi'] = 6210000;
                    $data['premi_tertanggung_tambahan'] = 0;
                }
                else if ($this->data['plan'] === 'BRONZE II'){
                    $data['premi'] = 4904000;
                    $data['premi_tertanggung_tambahan'] = 0;
                }
                else if ($this->data['plan'] === 'SILVER'){
                    $data['premi'] = 7639000;
                    $data['premi_tertanggung_tambahan'] = 0;
                }
                else if ($this->data['plan'] === 'GOLD'){
                    $data['premi'] = 11679000;
                    $data['premi_tertanggung_tambahan'] = 0;
                }
                else if ($this->data['plan'] === 'TITANIUM'){
                    $data['premi'] = 16303000;
                    $data['premi_tertanggung_tambahan'] = 0;
                }
            }
            else{
                if ($this->data['plan'] === 'BRONZE I'){
                    $data['premi'] = 4659000;
                    $data['premi_tertanggung_tambahan'] = 0;
                }
                else if ($this->data['plan'] === 'BRONZE II'){
                    $data['premi'] = 3924000;
                    $data['premi_tertanggung_tambahan'] = 0;
                }
                else if ($this->data['plan'] === 'SILVER'){
                    $data['premi'] = 5729000;
                    $data['premi_tertanggung_tambahan'] = 0;
                }
                else if ($this->data['plan'] === 'GOLD'){
                    $data['premi'] = 7592000;
                    $data['premi_tertanggung_tambahan'] = 0;
                }
                else if ($this->data['plan'] === 'TITANIUM'){
                    $data['premi'] = 11124000;
                    $data['premi_tertanggung_tambahan'] = 0;
                }
            }
        }
        $sheet->setCellValue('C8', 'Rp. ' . number_format($this->extractNumber($data['premi']), 0, ',', '.'));
        $sheet->setCellValue('C9', 'Rp. ' . number_format($this->extractNumber($data['premi_tertanggung_tambahan']), 0, ',', '.'));
        // $sheet->setCellValue('C9', $data['premi_tertanggung_tambahan'] ? 'Rp. '. number_format($this->extractNumber($data['premi_tertanggung_tambahan']), 0, ',', '.') : 'Rp. 0');
        
        // Calculate and set total premi in C10
        $totalPremi = $this->extractNumber($data['premi']);
        if ($data['premi_tertanggung_tambahan']) {
            $totalPremi += $this->extractNumber($data['premi_tertanggung_tambahan']);
        }
        $sheet->setCellValue('C10', 'Rp. ' . number_format($totalPremi, 0, ',', '.'));

        // Set plan in C15
        $sheet->setCellValue('C15', ': ' . $fullPlanName);

        // Set region based on plan in C16
        $planRegionMap = [
            'BRONZE I' => 'INDONESIA',
            'BRONZE II' => 'INDONESIA',
            'SILVER' => 'ASIA (KECUALI HONG KONG, JEPANG, DAN SINGAPURA)',
            'GOLD' => 'SELURUH ASIA',
            'TITANIUM' => 'SELURUH DUNIA (KECUALI AMERIKA SERIKAT)',
            'PLATINUM' => 'SELURUH DUNIA'
        ];
        $sheet->setCellValue('C16', ': ' . $planRegionMap[$data['plan']] ?? '');

        // Set Tanggungan Mandiri in C17
        if ($data['tipe_tanggungan'] === 'Dengan Tanggungan Mandiri') {
            $tanggunganText = match($data['plan']) {
                'BRONZE I', 'BRONZE II' => 'Dengan Tanggungan Mandiri, per rawat inap sebesar Rp 4.000.000',
                'SILVER' => 'Dengan Tanggungan Mandiri, per rawat inap sebesar Rp 5.000.000',
                'GOLD' => 'Dengan Tanggungan Mandiri, per rawat inap sebesar Rp 10.000.000',
                'TITANIUM' => 'Dengan Tanggungan Mandiri, per rawat inap sebesar Rp 15.000.000',
                'PLATINUM' => 'Dengan Tanggungan Mandiri, per rawat inap sebesar Rp 20.000.000',
                default => $data['tipe_tanggungan']
            };
            $sheet->setCellValue('C17', ': ' . $tanggunganText);
        } else {
            $sheet->setCellValue('C17', ': ' . $data['tipe_tanggungan']);
        }

        // Set nilai manfaat
        if ($data['plan'] === 'BRONZE II') {
            $descRoom = "* Maksimal 365 hari per tahun Polis\n"
              . "* Manfaat biaya kamar dan menginap adalah mana yang lebih tinggi antara: harga kamar terendah dengan 2 tempat tidur dengan kamar mandi di dalam atau nilai penggantian sebesar";
            $sheet->setCellValue('D22', $descRoom);

            $data['tipe_plan'] === 'S' ? $sheet->setCellValue('G22', '500000') : null;
        } elseif ($data['plan'] === 'BRONZE I') {
            $sheet->setCellValue('G31', '50000000');
            $sheet->setCellValue('G47', '30000000');
            $sheet->setCellValue('G48', '30000000');
            
            if ($data['tipe_plan'] === 'S') {
                $sheet->setCellValue('G22', '1000000');
                $sheet->setCellValue('G49', '3500000000');
                $sheet->setCellValue('G50', '7000000000');
            } else if ($data['tipe_plan'] === 'X') {
                $sheet->setCellValue('G22', '1500000');
                $sheet->setCellValue('G49', '6000000000');
                $sheet->setCellValue('G50', '10000000000');
            }
        } elseif ($data['plan'] === 'SILVER') {
            $sheet->setCellValue('G31', '50000000');
            $sheet->setCellValue('G47', '40000000');
            $sheet->setCellValue('G48', '40000000');
            
            if ($data['tipe_plan'] === 'S') {
                $sheet->setCellValue('G22', '1000000');
                $sheet->setCellValue('G49', '3500000000');
                $sheet->setCellValue('G50', '7000000000');
            } elseif ($data['tipe_plan'] === 'X') {
                $sheet->setCellValue('G22', '1500000');
                $sheet->setCellValue('G49', '6000000000');
                $sheet->setCellValue('G50', '10000000000');
            }
        } elseif ($data['plan'] === 'GOLD') {
            $sheet->setCellValue('G31', '75000000');
            $sheet->setCellValue('G47', '50000000');
            $sheet->setCellValue('G48', '50000000');
            
            if ($data['tipe_plan'] === 'S') {
                $sheet->setCellValue('G22', '1500000');
                $sheet->setCellValue('G49', '7500000000');
                $sheet->setCellValue('G50', '20000000000');
            } elseif ($data['tipe_plan'] === 'X') {
                $sheet->setCellValue('G22', '3000000');
                $sheet->setCellValue('G49', '9500000000');
                $sheet->setCellValue('G50', '24000000000');
            }
        } elseif ($data['plan'] === 'TITANIUM') {
            $sheet->setCellValue('G31', '90000000');
            $sheet->setCellValue('G47', '60000000');
            $sheet->setCellValue('G48', '60000000');

            if ($data['tipe_plan'] === 'S') {
                $sheet->setCellValue('G22', '2000000');
                $sheet->setCellValue('G49', '10000000000');
                $sheet->setCellValue('G50', '24000000000');
            } elseif ($data['tipe_plan'] === 'X') {
                $sheet->setCellValue('G22', '5000000');
                $sheet->setCellValue('G49', '11000000000');
                $sheet->setCellValue('G50', '26000000000');
            }
        } elseif ($data['plan'] === 'PLATINUM') {
            $sheet->setCellValue('G22', '5000000');
            $sheet->setCellValue('G31', '120000000');
            $sheet->setCellValue('G47', '75000000');
            $sheet->setCellValue('G48', '75000000');
            $sheet->setCellValue('G49', '17500000000');
            $sheet->setCellValue('G50', '30000000000');
        } else {
            $sheet->setCellValue('G22', '-');
            $sheet->setCellValue('G31', '-');
            $sheet->setCellValue('G47', '-');
            $sheet->setCellValue('G48', '-');
            $sheet->setCellValue('G49', '-');
            $sheet->setCellValue('G50', '-');
        }

        // Create the Excel file
        $writer = new Xlsx($spreadsheet);
        $filename = 'Output Closing.xlsx';
        $path = '/tmp/' . $filename;
        
        // Save the file
        $writer->save($path);
        
        return $path;
    }

    public function generateClaimExcel(array $data)
    {
        // Load the template file
        $templatePath = resource_path('templates/OutputClaim_Template.xlsx');
    
        if (!file_exists($templatePath)) {
            throw new \Exception("Template file not found at: " . $templatePath);
        }
        
        if (!is_readable($templatePath)) {
            throw new \Exception("Template file is not readable at: " . $templatePath);
        }
        
        try {
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
            if (!$reader->canRead($templatePath)) {
                throw new \Exception("Reader cannot read the file at: " . $templatePath);
            }
            $spreadsheet = $reader->load($templatePath);
        } catch (\Exception $e) {
            throw new \Exception("Error loading template: " . $e->getMessage() . " at: " . $templatePath);
        }
        $sheet = $spreadsheet->getActiveSheet();

        // Set currency dropdown value in C1 (make sure your template has the dropdown in C1)
        $currency = $data['currency'] ?? 'IDR'; // Default to IDR if not set
        // Fill in the basic data with currency prefix
        $sheet->setCellValue('C2', $data['nama_tertanggung']);
        $sheet->setCellValue('C3', $currency . ' ' .number_format($this->extractNumber($data['total_tagihan']), 0, ',', '.'));
        $sheet->setCellValue('C4', $currency . ' ' .number_format($this->extractNumber($data['manfaat_tahunan']), 0, ',', '.'));
        $sheet->setCellValue('C5', $currency . ' ' .number_format($this->extractNumber($data['booster']), 0, ',', '.'));

        // Calculate remaining benefit
        $totalTagihan = $this->extractNumber($data['total_tagihan']);
        $manfaatTahunan = $this->extractNumber($data['manfaat_tahunan']);
        $boosterTerakhir = $this->extractNumber($data['booster']);
        
        $remainingBenefit = $manfaatTahunan - $totalTagihan;
        $penguranganBooster = 0;
        
        if ($remainingBenefit < 0) {
            $penguranganBooster = abs($remainingBenefit);
            $remainingBenefit = 0;
        }
        
        // Set the remaining benefit in C6
        $sheet->setCellValue('C6', $currency . ' ' .number_format($remainingBenefit, 0, ',', '.'));
        
        // Calculate and set the remaining booster in C7
        $remainingBooster = ($penguranganBooster === 0) 
            ? $boosterTerakhir 
            : $boosterTerakhir - $penguranganBooster;
        $sheet->setCellValue('C7', $currency . ' ' .number_format($remainingBooster, 0, ',', '.'));

        // Create the Excel file
        $writer = new Xlsx($spreadsheet);
        $filename = 'Output Claim.xlsx';
        $path = '/tmp/' . $filename;
        
        // Save the file
        $writer->save($path);
        
        return $path;
    }

    private function extractNumber($value)
    {
        // If already numeric, return as is
        if (is_numeric($value)) {
            return (float) $value;
        }
        
        // Remove any currency symbols and spaces
        $value = preg_replace('/[^0-9,.]/', '', $value);
        
        // Replace dot separator with empty string (for thousand separators)
        $value = str_replace('.', '', $value);
        
        // Replace comma with dot (for decimal points)
        $value = str_replace(',', '.', $value);
        
        return (float) $value;
    }
}
