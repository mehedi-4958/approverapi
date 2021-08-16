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
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 401);
        }
        $input = $request->all();
        $approvalItem = ApprovalItemMaster::create($input);
        return response()->json([
            'success' => true,
            'data' => $approvalItem,
        ]);
//        $this->validate($request, [
//            'title' => 'required|min:4',
//            'amount' => 'required',
//            'status' => 'required',
//        ]);

//        $approvalItem = new ApprovalItemMaster();
//        $approvalItem->title = $request->title;
//        $approvalItem->amount = $request->amount;
//        $approvalItem->status = $request->status;


//        if (auth('api')->user()->itemMaster()->save($approvalItem)){
//            return response()->json([
//                'success' => true,
//                'data' => $approvalItem->toArray(),
//            ]);
//        } else {
//            return  response()->json([
//                'success' => false,
//                'message' => 'Item could not be added',
//            ], 500);
//        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApprovalItemMaster  $approvalItemMaster
     * @return \Illuminate\Http\Response
     */
    public function show(ApprovalItemMaster $approvalItemMaster)
    {
        return response()->json($approvalItemMaster, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ApprovalItemMaster  $approvalItemMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApprovalItemMaster $approvalItemMaster)
    {
        $updated = $approvalItemMaster->fill($request->all())->save();

        if ($updated) {
            return response()->json([
                'success' => true,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Item could not be updated',
            ], 500);
        }
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
