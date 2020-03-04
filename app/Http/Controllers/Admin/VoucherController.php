<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Voucher;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditVoucherRequest;
use App\Http\Requests\VoucherRequest;
use App\Services\VoucherService;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    protected $voucherService;

    public function __construct()
    {
        $this->voucherService = app(VoucherService::class);
    }

    public function index(Request $request)
    {
        $limits    = $request->get('limits', 10);
        $search    = $request->get('search', '');
        $searchKey = $request->get('searchBy', '');

        $vouchers = $this->voucherService->getVouchers($limits, $search, $searchKey);

        return view('admin.vouchers.list', compact('vouchers'));
    }

    public function create()
    {
        return view('admin.vouchers.create');
    }

    public function store(VoucherRequest $request)
    {
        $params = $request->except('_token');

        Voucher::create($params);

        return redirect(route('voucher.index'));
    }

    public function edit($id)
    {
        $voucher = Voucher::find($id);

        return view('admin.vouchers.edit', compact('voucher'));
    }

    public function update(EditVoucherRequest $request, $id)
    {
        $params = $request->except('_token');

        Voucher::find($id)->update($params);

        return redirect(route('voucher.index'))->with('success', 'Updated successfully!');
    }

    public function destroy($id)
    {
        Voucher::find($id)->delete();

        return redirect(route('voucher.index'))->with('success', 'Deleted Successfully!');
    }
}
