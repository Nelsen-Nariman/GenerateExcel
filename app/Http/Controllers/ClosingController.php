<?php

namespace App\Http\Controllers;

use App\Services\ExcelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClosingController extends Controller
{
    protected $excelService;

    public function __construct(ExcelService $excelService)
    {
        $this->excelService = $excelService;
    }

    public function index()
    {
        return view('closing.index');
    }

    public function generateExcel(Request $request)
    {
        $validated = $request->validate([
            'tipe_klien' => 'required|in:Individu,Korporat',
            'nama_pemegang_polis' => 'required',
            'tertanggung' => 'required',
            'tipe_plan' => 'required|in:X,S',
            'plan' => 'required|in:BRONZE I,BRONZE II,SILVER,GOLD,TITANIUM,PLATINUM',
            'tipe_tanggungan' => 'required|in:Tanpa Tanggungan Mandiri,Dengan Tanggungan Mandiri',
            'premi' => 'required',
            'total_premi' => 'required',
            'premi_tertanggung_tambahan' => 'nullable',
            'tertanggung_tambahan' => 'nullable'
        ]);

        $data = array_merge($validated, [
        'premi' => str_replace(',', '.', str_replace('.', '', $validated['premi'])),
        'premi_tertanggung_tambahan' => $validated['premi_tertanggung_tambahan'] 
            ? str_replace(',', '.', str_replace('.', '', $validated['premi_tertanggung_tambahan']))
            : null
        ]);

        $filename = $this->excelService->generateClosingExcel($data);
        
        return response()->download(
            storage_path('app/public/' . $filename),
            $filename,
            ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']
        )->deleteFileAfterSend();
    }
}