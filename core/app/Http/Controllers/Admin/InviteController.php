<?php

namespace App\Http\Controllers\Admin;

use App\Models\InviteTask;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class InviteController extends Controller
{

    public function inviteTask(){
        $pageTitle = 'Invite Task';
        $emptyMessage = 'No invite task has been added.';
        $tasks = InviteTask::orderBy('referral_count')->paginate(getPaginate());
        return view('admin.invite.index', compact('pageTitle', 'emptyMessage', 'tasks'));
    }
    public function createInviteTask(){
        $pageTitle = 'Create Invite Task';
        return view('admin.invite.create', compact('pageTitle'));
    }

    public function storeInviteTask(Request $request){
        $request->validate([
            'referral_count' => 'required|integer|min:1',
            'reward_amount' => 'required|numeric|min:1',
        ]);

        InviteTask::create($request->only(['referral_count', 'reward_amount']));
        $notify[] = ['success', 'Invite task created successfully.'];       
        return redirect()->route('admin.invite.task')->withNotify($notify);
    }

    public function editInviteTask(InviteTask $inviteTask){
        $pageTitle = 'Edit Invite Task';
        $task = $inviteTask;
        return view('admin.invite.edit', compact('pageTitle', 'inviteTask','task'));

    }

    public function updateInviteTask(Request $request, InviteTask $inviteTask){
        $request->validate([
            'referral_count' => 'required|integer|min:1',
            'reward_amount' => 'required|numeric|min:1',
        ]);

        $inviteTask->update($request->only(['referral_count', 'reward_amount']));
        $notify[] = ['success', 'Invite task updated successfully.'];
        return redirect()->route('admin.invite.task')->withNotify($notify);
    }

    public function destroy(InviteTask $inviteTask)
    {
        $inviteTask->delete();
        return redirect()->route('admin.invite.task')->with('success', 'Invite task deleted.');
    }
}