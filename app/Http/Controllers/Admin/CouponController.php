<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::orderBy('id','asc')->get();
        return view('admin.coupons.index',compact('coupons'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->percentage = $request->percentage;
        $coupon->expire_date = $request->expire_date;
        $coupon->save();
        return redirect()->route('admin.coupons.index')->with('create','Coupon Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $coupon = Coupon::find($request->id);
        $coupon->code = $request->code;
        $coupon->percentage = $request->percentage;
        $coupon->expire_date = $request->expire_date;
        $coupon->update();
        return redirect()->route('admin.coupons.index')->with('create','Coupon Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('delete','Coupon Deleted Successfully');
    }
}
