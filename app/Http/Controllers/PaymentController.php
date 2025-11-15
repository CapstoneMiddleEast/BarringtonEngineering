<?php

namespace App\Http\Controllers;


use App\Models\Payment;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PaymentController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view payment', only: ['index']),
            new Middleware('permission:create payment', only: ['create']),
            new Middleware('permission:edit payment', only: ['edit']),
            new Middleware('permission:delete payment', only: ['delete', 'destroy']),
        ];
    }

    /**
     * Display a listing of the Payment.
     */
    public function index()
    {
        $list = Payment::latest()->paginate(25);
        return view('payments.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new Payment.
     */
    public function create()
    {
        return view('payments.create');
    }

    /**
     * Edit a specified Payment.
     */
    public function edit($id)
    {
        $item = Payment::findOrFail($id);
        return view('payments.edit', ['id' => $id]);
    }

    /**
     * Show the form for delete the specified Payment.
     */
    public function delete(string $id)
    {
        $item = Payment::findOrFail($id);
        return view('payments.delete', ['item' => $item]);
    }

    /**
     * Remove the specified Payment from resource.
     */
    public function destroy(string $id)
    {
        $item = Payment::findOrFail($id);
        $item->delete();
        activity()->performedOn($item)->log('Payment "' . $item->name . '" has been deleted!');
        session()->flash('type', 'success');
        session()->flash('message', 'Payment deleted successfully!');
        return redirect()->route('payments.index');
    }
}
