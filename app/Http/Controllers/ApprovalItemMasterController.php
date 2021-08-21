<?php

namespace App\Http\Controllers;

use App\Models\ApprovalItemMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApprovalItemMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $approvalItems = ApprovalItemMaster::all();

        return response()->json([
            'success' => true,
            'message' => 'Item List',
            'data' => $approvalItems,
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
            'title' => 'required|min:4',
            'amount' => 'required',
            //'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 401);
        }
        $input = $request->all();
        $approvalItem = ApprovalItemMaster::create($input);
        $approvalItem->Status = 'Pending';
        $approvalItem->save();
        return response()->json([
            'success' => true,
            'data' => $approvalItem,
        ]);

    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPending()
    {
            $items = ApprovalItemMaster::where('Status', 'Pending')->get();

            return response()->json([
                'message' => 'item found',
                'data' => $items
            ]);

    }



    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showApproved()
    {
        $items = ApprovalItemMaster::where('Status', 'Approved')->get();

        return response()->json([
            'message' => 'item found',
            'data' => $items
        ]);

    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDeclined()
    {
        $items = ApprovalItemMaster::where('Status', 'Declined')->get();

        return response()->json([
            'message' => 'item found',
            'data' => $items
        ]);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->input('ID');
        $status = $request->input('Status');
        $item = ApprovalItemMaster::where('ID',  $id)->update(['Status' => $status]);

        return response()->json(['success' => true, 'message' => $status,]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApprovalItemMaster  $approvalItemMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApprovalItemMaster $approvalItemMaster)
    {
        if (!$approvalItemMaster) {
            return response()->json([
                'success' => false,
                'message' => 'Apprval Item with id' . $approvalItemMaster->ID . 'not found',
            ],400);
        }

        if ($approvalItemMaster->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Item deleted successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Item could not be deleted',
            ], 500);
        }
    }
}
