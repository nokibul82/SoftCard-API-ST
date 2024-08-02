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
        if($request->requested_from_id == $request->requested_to_id || $request->requested_from_email == $request->requested_to_email){
            return response()->json([
                'success' => false,
                'message' => 'This connection is invalid. both user_id or user_email is same.',
            ], 401);
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

        $request_list = UserRelation::where('requested_from_id','=',$request->requested_from_id)->where('requested','=',true)->get();

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

        $pending_list = UserRelation::where('requested_to_id','=',$request->requested_to_id)->where('requested','=',true)->get();

        return response()->json([
            'success' => true,
            'request_list' => $pending_list,
        ]);
    }

    public function getContactList(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            $data = [
                'success' => false,
                'errors' => $validator->errors()
            ];
            return response()->json($data, 422);
        }

        $contact_list = UserRelation::where('user_id','=',$request->requested_to_id)->where('accepted','=',true);
        $temp_contact_list = UserRelation::where('user_id','=',$request->requested_from_id)->where('accepted','=',true);
        if($temp_contact_list){
            $contact_list->union($temp_contact_list);
        }
        $contact_list = $contact_list->get();
        return response()->json([
            'success' => true,
            'contact_list' => $contact_list,
        ]);


    }

    public function deleteContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'contact_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            $data = [
                'success' => false,
                'errors' => $validator->errors()
            ];
            return response()->json($data, 422);
        }
        $relation = null;
        $relation =  UserRelation::where('user_id','=',$request->requested_from_id)->where('contact_id','=',$request->requested_to_id)->first();
        if ($relation) {
            $relation->delete();
            return response()->json([
                'success' => true,
                'message' => 'Contact has been deleted !',
            ]);
        }else{
            $relation =  UserRelation::where('contact_id','=',$request->requested_from_id)->where('user_id','=',$request->requested_to_id)->first();
            if($relation == null){
                return response()->json([
                    'success' => false,
                    'message' => 'There is no contact of this user !',
                ], 401);
            }
            $relation->delete();
            return response()->json([
                'success' => true,
                'message' => 'Contact has been deleted !',
            ]);
        }
    }


}
