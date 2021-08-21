<?php

namespace App\Http\Controllers;

use App\Models\ApprovalItemDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApprovalItemDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $approvalItemDetails = ApprovalItemDetail::all();

        return response()->json([
            'success' => true,
            'message' => 'Item Detail',
            'data' => $approvalItemDetails,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'approvalItemID' => 'required',
            'key' => 'required',
            'value' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 401);
        }
        $input = $request->all();
        $approvalItemDetail = ApprovalItemDetail::create($input);
        return response()->json([
            'success' => true,
            'data' => $approvalItemDetail,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDetail(Request $request)
    {
        $detail_id = $request->input('ID');
        $item = ApprovalItemDetail::where('ID', $detail_id)->get();

        return response()->json([
            'message' => 'item found',
            'data' => $item
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApprovalItemDetail  $approvalItemDetail
     * @return \Illuminate\Http\Response
     */
    public function show(ApprovalItemDetail $approvalItemDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ApprovalItemDetail  $approvalItemDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApprovalItemDetail $approvalItemDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApprovalItemDetail  $approvalItemDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApprovalItemDetail $approvalItemDetail)
    {
        //
    }
}
