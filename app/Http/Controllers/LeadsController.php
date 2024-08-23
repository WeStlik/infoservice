<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeadsRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Leads;
use App\Models\Statuses;
use Illuminate\Support\Facades\Response;

class LeadsController extends Controller
{
    public function show() {
        $leads = [
            'leads' => Leads::orderBy('id', 'desc')->paginate(3),
            'leadsCount' => Leads::count(),
            'statusesCount' => Leads::select('status', DB::raw('count(*) as count'))
                                ->groupBy('status')
                                ->pluck('count', 'status'),
        ];

        return view('dashboard', compact('leads'));
    }
    public function create(LeadsRequest $request)
    {

        Leads::create($request->validated());
        return back()->with('success', 'Ваше сообщение успешно отправлено!');
    }

    public function getOnce($id) {
        $lead = Leads::findOrFail($id);
        return response()->json($lead);
    }

    public function editLead(Request $request, $id)
    {
        $lead = Leads::findOrFail($id);
        $request->validate([
            'first_name' => 'required|string|max:32',
            'last_name' => 'required|string|max:32',
            'email' => 'required|string|email|lowercase',
            'phone' => 'required|digits:10',
            'lead_text' => 'nullable|string',
        ]);

        $lead->first_name = $request->input('first_name');
        $lead->last_name = $request->input('last_name');
        $lead->email = $request->input('email');
        $lead->phone = $request->input('phone');
        $lead->lead_text = $request->input('lead_text');

        $lead->save();

        return response()->json([
            'success' => true,
            'lead' => $lead,
        ]);
    }

    public function deleteLead($id)
    {
        $lead = Leads::findOrFail($id);
        $lead->delete();

        return response()->json(['success' => true]);
    }

    public function statusCounts(Request $request)
    {
        $counts = Leads::select('status', DB::raw('count(*) as count'))
                        ->groupBy('status')
                        ->pluck('count', 'status');

        $newCount = $counts->get('new', 0);
        $progressCount = $counts->get('in_progress', 0);
        $doneCount = $counts->get('done', 0);

        return response()->json([
            'new' => $newCount,
            'progress' => $progressCount,
            'done' => $doneCount
        ]);
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|string|in:new,in_progress,done',
        ]);

        $lead = Leads::find($request->id);
        if($lead) {
            $lead->status = $request->status;
            $lead->save();

            $status = Statuses::where('type', $lead->status)->first();

            return Response::json([
                'success' => true,
                'status' => $status
            ], 200);
        } else {
            return response()->json(['success' => false]);
        }
    }

}
