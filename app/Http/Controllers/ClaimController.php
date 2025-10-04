<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExcelService;

class ClaimController extends Controller
{
    protected $excelService;

    public function __construct(ExcelService $excelService)
    {
        $this->excelService = $excelService;
    }

    public function index()
    {
        return view('claim.index');
    }

    public function generateExcel(Request $request)
    {
        try {
            $validated = $request->validate([
                'currency' => 'required|string|in:IDR,USD,EUR,SGD',
                'nama_tertanggung' => 'required|string',
                'total_tagihan' => 'required',
                'manfaat_tahunan' => 'required',
                'booster' => 'required',
            ]);

            $data = [
            'currency' => $validated['currency'],
            'nama_tertanggung' => $validated['nama_tertanggung'],
            'total_tagihan' => str_replace(',', '.', str_replace('.', '', $validated['total_tagihan'])),
            'manfaat_tahunan' => str_replace(',', '.', str_replace('.', '', $validated['manfaat_tahunan'])),
            'booster' => str_replace(',', '.', str_replace('.', '', $validated['booster']))
        ];

            $filename = $this->excelService->generateClaimExcel($data);
            
            return response()->download(
                storage_path('app/public/' . $filename)
            )->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Failed to generate Excel: ' . $e->getMessage());
        }
    }
}