<?php

namespace App\Http\Controllers;

use App\Helpers\HandleJsonResponseHelper;
use App\Http\Requests\NeededIdRequest;
use App\Http\Requests\StoreCostumerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{

    public function getData()
    {
        try {
            $customers = Customer::latest()->paginate(1);
            return HandleJsonResponseHelper::res("Successfully get data!", $customers, 200, true);
        } catch (\Exception $e) {
            return HandleJsonResponseHelper::res("There is a error", $e->getMessage(), 500, false);
        }
    }
    public function store(StoreCostumerRequest $request)
    {
        try {
            DB::beginTransaction();

            $customer = new Customer;
            $customer->name = $request->nama_pelanggan;
            $customer->address = $request->alamat;
            $customer->gender = $request->status;
            $customer->save();

            DB::commit();

            return HandleJsonResponseHelper::res("Successfully add new customer!");
        } catch (\Exception $e) {
            DB::rollBack();

            return HandleJsonResponseHelper::res("There is a error", $e->getMessage(), 500, false);
        }
    }
    public function show(string $id)
    {
        try {
            $book = Customer::where('id', $id)->first();
            if (!$book) {
                return HandleJsonResponseHelper::res("Customer is not found!", [], 404, false);
            }
            return HandleJsonResponseHelper::res("Successfully get Data", $book);
        } catch (\Exception $e) {
            return HandleJsonResponseHelper::res("There is a error", $e->getMessage(), 500, false);
        }

    }
    public function update(UpdateCustomerRequest $request)
    {
        try {
            DB::beginTransaction();

            $customer = Customer::where("id", $request->id)->first();

            if(!$customer){
                return HandleJsonResponseHelper::res("Customer is not found!", [], 404, false);
            }

            $customer->name = $request->nama_pelanggan;
            $customer->address = $request->alamat;
            $customer->gender = $request->status;
            $customer->save();

            DB::commit();

            return HandleJsonResponseHelper::res("Successfully update customer!");
        } catch (\Exception $e) {
            DB::rollBack();

            return HandleJsonResponseHelper::res("There is a error", $e->getMessage(), 500, false);
        }
    }
    public function destroy(NeededIdRequest $request)
    {
        try {
            DB::beginTransaction();

            $customer = Customer::where("id", $request->id)->first();

            if(!$customer){
                return HandleJsonResponseHelper::res("Customer is not found!", [], 404, false);
            }

            $customer->delete();

            DB::commit();

            return HandleJsonResponseHelper::res("Successfully delete customer!");
        } catch (\Exception $e) {
            DB::rollBack();

            return HandleJsonResponseHelper::res("There is a error", $e->getMessage(), 500, false);
        }
    }

    public function print()
    {
        $book = Customer::all();

        $pdf = Pdf::loadView('print.book', ['data' => $book]);
        return $pdf->stream('BookPrint.pdf');
    }
}
