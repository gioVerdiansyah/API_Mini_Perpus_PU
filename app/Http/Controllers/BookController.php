<?php

namespace App\Http\Controllers;

use App\Helpers\HandleJsonResponseHelper;
use App\Http\Requests\NeededIdRequest;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function getData(Request $request)
    {
        try {
            $books = Book::latest()->paginate(5);

            if($request->has('query')){
                $searchQuery = $request->query('query');
                $books = Book::orWhere('title', $searchQuery)->orWhere('code', 'LIKE', '%' . $searchQuery . '%')->orWhere('category', 'LIKE', '%' . $searchQuery . '%')->orWhere('publisher', 'LIKE', '%' . $searchQuery . '%')->paginate(5);
            }

            return HandleJsonResponseHelper::res("Successfully get Data", $books);
        } catch (\Exception $e) {
            return HandleJsonResponseHelper::res("There is a error", $e->getMessage(), 500, false);
        }
    }
    public function store(StoreBookRequest $request)
    {
        try {
            DB::beginTransaction();

            $book = new Book;
            $book->code = fake()->isbn13();
            $book->title = $request->judul_buku;
            $book->category = $request->jenis_buku;
            $book->publisher = $request->produksi;
            $book->save();

            DB::commit();
            return HandleJsonResponseHelper::res("Successfully add new Book");
        } catch (\Exception $e) {
            DB::rollBack();

            return HandleJsonResponseHelper::res("There is a error", $e->getMessage(), 500, false);
        }
    }
    public function show(string $id)
    {
        try {
            $book = Book::where('id', $id)->first();
            if (!$book) {
                return HandleJsonResponseHelper::res("Book is not found!", [], 404, false);
            }
            return HandleJsonResponseHelper::res("Successfully get Data", $book);
        } catch (\Exception $e) {
            return HandleJsonResponseHelper::res("There is a error", $e->getMessage(), 500, false);
        }

    }
    public function update(UpdateBookRequest $request)
    {
        try {
            DB::beginTransaction();

            $book = Book::where("id", $request->id)->first();

            if (!$book) {
                return HandleJsonResponseHelper::res("Book is not found!", [], 404, false);
            }

            $book->title = $request->judul_buku;
            $book->category = $request->jenis_buku;
            $book->publisher = $request->produksi;
            $book->save();

            DB::commit();
            return HandleJsonResponseHelper::res("Successfully update Book");
        } catch (\Exception $e) {
            DB::rollBack();

            return HandleJsonResponseHelper::res("There is a error", $e->getMessage(), 500, false);
        }
    }
    public function destroy(NeededIdRequest $request)
    {
        try {
            DB::beginTransaction();

            $book = Book::where("id", $request->id)->first();

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
    public function print()
    {
        $book = Book::all();

        $pdf = Pdf::loadView('print.book', ['data' => $book])->setPaper('A4', 'landscape');
        return $pdf->stream('BookPrint.pdf');
    }
}
