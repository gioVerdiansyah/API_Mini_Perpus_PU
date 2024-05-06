<?php

namespace App\Http\Controllers;

use App\Helpers\HandleJsonResponseHelper;
use App\Http\Requests\StoreRentRequest;
use App\Models\Rent;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentController extends Controller
{
    public function store(StoreRentRequest $request)
    {
        try {
            DB::beginTransaction();

            $rent = new Rent;
            $rent->rental_date = $request->tanggal_sewa;
            $rent->return_date = $request->tanggal_pengembalian;
            $rent->total = $request->total;
            $rent->tax = $request->denda;
            $rent->save();

            DB::commit();

            return HandleJsonResponseHelper::res("Successfully add new Rent");
        } catch (\Exception $e) {
            DB::rollBack();

            return HandleJsonResponseHelper::res("There is a error", $e->getMessage(), 500, false);
        }
    }

    public function print(string $id)
    {
        $book = Rent::findOrFail($id);

        $pdf = Pdf::loadView('print.book', ['data' => $book]);
        return $pdf->stream('BookPrint.pdf');
    }
}
