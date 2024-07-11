<?php

namespace App\Http\Controllers;

use App\Models\UserRelation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserRelationController extends Controller
{
    public function request(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'requested_from_id' => 'required|exists:users,id',
            'requested_to_id' => 'required|exists:users,id',
            'requested_from_email' => 'required|email|exists:users,email',
            'requested_to_email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            $data = [
                'success' => false,
                'errors' => $validator->errors()
            ];
            return response()->json($data, 422);
        }
        $relation = null;
        $relation =  UserRelation::where('requested_from_id','=',$request->requested_from_id)->where('requested_to_id','=',$request->requested_to_id)->first();
        if ($relation) {
            return response()->json([
                'success' => false,
                'message' => 'There is already connection with this user',
            ], 401);
        }else {
            $relation = null;
            $relation =  UserRelation::where('requested_from_id','=',$request->requested_to_id)->where('requested_to_id','=',$request->requested_from_id)->first();
            if ($relation == null) {
                $relation = UserRelation::create(request()->all());
                $relation->requested = true;
                $relation->accepted = false;
                $relation->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Request has been sent',
                    'relation' => $relation,
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'There is already connection with this user',
        ], 401);
    }

    public function accept(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'requested_from_id' => 'required|exists:users,id',
            'requested_to_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            $data = [
                'success' => false,
                'errors' => $validator->errors()
            ];
            return response()->json($data, 422);
        }
        $relation = null;
        $relation =  UserRelation::where('requested_from_id','=',$request->requested_from_id)->where('requested_to_id','=',$request->requested_to_id)->first();
        if ($relation) {
            $relation->requested = false;
            $relation->accepted = true;
            $relation->save();
            return response()->json([
                'success' => true,
                'message' => 'Request has been accepted',
                'relation' => $relation,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'There is no requested from this user',
        ], 401);
    }

    public function decline(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'requested_from_id' => 'required|exists:users,id',
            'requested_to_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            $data = [
                'success' => false,
                'errors' => $validator->errors()
            ];
            return response()->json($data, 422);
        }
        $relation = null;
        $relation =  UserRelation::where('requested_from_id','=',$request->requested_from_id)->where('requested_to_id','=',$request->requested_to_id)->first();
        if ($relation) {
            $relation->delete();
            return response()->json([
                'success' => true,
                'message' => 'Request has been declined.',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'There is no requested from this user',
        ], 401);
    }

    public function getRequestList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'requested_from_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            $data = [
                'success' => false,
                'errors' => $validator->errors()
            ];
            return response()->json($data, 422);
        }

        $request_list = UserRelation::where('requested_from_id','=',$request->requested_from_id)->get();

        return response()->json([
            'success' => true,
            'request_list' => $request_list,
        ]);
    }

    public function getPendingList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'requested_to_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            $data = [
                'success' => false,
                'errors' => $validator->errors()
            ];
            return response()->json($data, 422);
        }

        $pending_list = UserRelation::where('requested_to_id','=',$request->requested_to_id)->get();

        return response()->json([
            'success' => true,
            'request_list' => $pending_list,
        ]);
    }
}
