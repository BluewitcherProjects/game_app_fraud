<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\User;
use App\Models\Post;

class PlanController extends Controller
{


    public function index(){
        $pageTitle = 'Subscription Plans';
        $plan = Plan::latest()->paginate(getPaginate());
        $emptyMessage = 'Data Not Found';
        return view('admin.plan.index', compact('pageTitle', 'plan', 'emptyMessage'));
    }

    public function create(Request $request){

        $request->validate([
            'name'=> 'required|string|max:191',
            'min_amount'=> 'required|numeric|gt:0',
            'max_amount'=> 'required|numeric',
            'total_return'=> 'required|integer|gt:0',
            'interest_type'=> 'required|in:0,1',
            'interest'=> 'required|numeric|gt:0',
            'status'=> 'required|in:0,1',
            'type'=> 'required|string|max:191',
        ]);

        $plan = new Plan();
        $plan->name = $request->name;
        $plan->min_amount = $request->min_amount;
        $plan->max_amount = $request->max_amount;
        $plan->total_return = $request->total_return;
        $plan->interest_type = $request->interest_type;  //	1=>Percent, 0=>Fixed
        $plan->interest_amount = $request->interest;
        $plan->status = $request->status;
        $plan->type = $request->type;
        $plan->buy_limit = $request->buy_limit;
        $plan->save();

        $notify[] = ['success', 'Plan created successfully'];
        return redirect()->back()->withNotify($notify);

    }

    public function edit(Request $request){

        $request->validate([
            'id'=> 'required|exists:plans,id',
            'name'=> 'required|string|max:191',
            'min_amount'=> 'required|numeric|gt:0',
            'max_amount'=> 'required|numeric',
            'total_return'=> 'required|integer|gt:0',
            'interest_type'=> 'required|in:0,1',
            'interest'=> 'required|numeric|gt:0',
            'status'=> 'required|in:0,1',
            'type'=> 'required|string|max:191',
        ]);

        $findPlan = Plan::find($request->id);
        $findPlan->name = $request->name;
        $findPlan->min_amount = $request->min_amount;
        $findPlan->max_amount = $request->max_amount;
        $findPlan->total_return = $request->total_return;
        $findPlan->interest_type = $request->interest_type;  //	1=>Percent, 0=>Fixed
        $findPlan->interest_amount = $request->interest;
        $findPlan->status = $request->status;
        $findPlan->type = $request->type;
        if($findPlan->buy_limit){
            $findPlan->invest_count = 0;
            $findPlan->buy_limit = $request->buy_limit;
        }
        $findPlan->save();

        $notify[] = ['success', 'Plan updated successfully'];
        return redirect()->back()->withNotify($notify);
    }


    function tasks(){
        $pageTitle = 'Subscription Tasks';
        $plan = Task::latest()->paginate(getPaginate());
        $emptyMessage = 'Data Not Found';
        return view('admin.plan.tasks', compact('pageTitle', 'plan', 'emptyMessage'));
    }


    public function createTask(Request $request){

        $request->validate([
            'title'=> 'required|string|max:191',
            'descr'=> 'required',
            'url'=> 'required',
            'status'=> 'required|in:0,1',
            'image' => ['image',new FileTypeValidate(['jpg','jpeg','png'])]
        ]);



        $plan = new Task();
        $plan->title = $request->title;
        $plan->descr = $request->descr;
        $plan->url = $request->url;
        $plan->status = $request->status;
        if ($request->hasFile('image')) {
            $location = imagePath()['gateway']['path'];
            $size = imagePath()['gateway']['size'];
            $filename = uploadImage($request->image, $location);

            $plan->image = $filename;
            $plan->save();

            $notify[] = ['success', 'Task created successfully'];
            return redirect()->back()->withNotify($notify);
        }

        $notify[] = ['error', 'Unable to create task'];
        return redirect()->back()->withNotify($notify);




    }

    public function editTask(Request $request){

        $request->validate([
            'title'=> 'required|string|max:191',
            'descr'=> 'required',
            'url'=> 'required',
            'status'=> 'required|in:0,1',
        ]);

        $plan = Task::find($request->id);
        $plan->title = $request->title;
        $plan->descr = $request->descr;
        $plan->url = $request->url;
        $plan->status = $request->status;
        $plan->save();

        $notify[] = ['success', 'Task updated successfully'];
        return redirect()->back()->withNotify($notify);
    }


     public function proof(){
        $pageTitle = 'Proofs';
        $proof = Post::latest()->paginate(getPaginate());
        $emptyMessage = 'Data Not Found';
        return view('admin.proof.index', compact('pageTitle', 'proof', 'emptyMessage'));
    }

    public function proofapprove($id){
        $proof = Post::where('id',$id)->first();
        $proof->status = 1;
        $proof->save();

        $user = User::find($id);
        $user->bonus_balance += 35;
        $user->save();

        $notify[] = ['success', 'Post updated successfully'];
        return redirect()->back()->withNotify($notify);
    }

    public function proofreject($id){
        $proof = Post::where('id',$id)->first();
        $proof->status = 3;
        $proof->save();

        $notify[] = ['success', 'Post updated successfully'];
        return redirect()->back()->withNotify($notify);
    }





}