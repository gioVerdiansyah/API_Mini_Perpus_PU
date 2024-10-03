<?php

namespace App\Http\Controllers;

use App\Helpers\HandleJsonResponseHelper;
use App\Http\Requests\NeededIdRequest;
use App\Http\Requests\StoreRentRequest;
use App\Models\Book;
use App\Models\Customer;
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
            $rent->customer_id = Customer::where('number', $request->no_pelanggan)->first()->id;
            $rent->book_id = Book::where('code', $request->kode_buku)->first()->id;
            $rent->rental_date = $request->tanggal_sewa;
            $rent->return_date = $request->tanggal_pengembalian;
            $rent->total = $request->total;
            $rent->tax = $request->denda;
            $rent->save();

            DB::commit();

            return HandleJsonResponseHelper::res("Successfully add new Rent", $rent->id);
        } catch (\Exception $e) {
            DB::rollBack();

            return HandleJsonResponseHelper::res("There is a error", $e->getMessage(), 500, false);
        }
    }

    public function getData(Request $request)
    {
        try {
            $rent = Rent::with(['customer', 'book'])->latest()->paginate(5);
            $customer = Customer::select(['number', 'name'])->get()->toArray();
            $book = Book::select(['code', 'title'])->get()->toArray();

            if($request->has('query')){
                $searchQuery = $request->query('query');
                $books = Book::where('title', 'LIKE', '%' . $searchQuery . '%')->pluck('id');
                $customers = Customer::where('name', 'LIKE', '%' . $searchQuery . '%')->pluck('id');
                $rent = Rent::with(['customer', 'book'])->orWhereIn('book_id', $books)->orWhereIn('customer_id', $customers)->paginate(5);
            }

            return HandleJsonResponseHelper::res("Successfully get data", ['rent' => $rent, 'customerAndBook' => ['customer' => $customer, 'book' => $book]]);
        } catch (\Exception $e) {
            return HandleJsonResponseHelper::res("There is a error", $e->getMessage(), 500, false);
        }
    }

    public function search($search)
    {
        try {
            $book = Book::where('title', 'LIKE', '%' . $search . '%')->pluck('id');
            $customer = Customer::where('name', 'LIKE', '%' . $search . '%')->pluck('id');
            $rent = Rent::orWhereIn('book_id', $book)->orWhereIn('customer_id', $customer)->get();

            return HandleJsonResponseHelper::res("Successfully get data", $rent);
        } catch (\Exception $e) {
            return HandleJsonResponseHelper::res("There is a error", $e->getMessage(), 500, false);
        }
    }
    public function destroy(NeededIdRequest $request)
    {
        try {
            DB::beginTransaction();

            $book = Rent::where("id", $request->id)->first();

            if (!$book) {
                return HandleJsonResponseHelper::res("Book is not found!", [], 404, false);
            }

            $book->delete();

            DB::commit();
            return HandleJsonResponseHelper::res("Successfully delete Book");
        } catch (\Exception $e) {
            DB::rollBack();

            return HandleJsonResponseHelper::res("There is a error", $e->getMessage(), 500, false);
        }
    }
    public function print(string $id)
    {
        $book = Rent::with(['customer', 'book'])->findOrFail($id);

        $pdf = Pdf::loadView('print.receipt', ['data' => $book]);
        return $pdf->stream('BookPrint.pdf');
    }
}
