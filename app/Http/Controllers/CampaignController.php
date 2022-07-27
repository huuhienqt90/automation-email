<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use App\Models\Campaign;
use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $campaigns = Campaign::paginate(12);
        return Inertia::render('Campaign/Index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return Inertia::render('Campaign/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCampaignRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCampaignRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->input('user_id') ?: auth()->user()->id;
        Campaign::create($data);
        return redirect()->route('campaigns.index')->with('success', 'Create campaign success.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Campaign $campaign
     * @return Response
     */
    public function edit(Campaign $campaign)
    {
        return Inertia::render('Campaign/Edit', compact('campaign'));
    }

    /**
     * Show the template page
     *
     * @param Campaign $campaign
     * @return Response
     */
    public function getDashboard(Campaign $campaign)
    {
        return Inertia::render('Campaign/Dashboard', compact('campaign'));
    }

    /**
     * Show the template page
     *
     * @param Campaign $campaign
     * @return Response
     */
    public function getTemplates(Campaign $campaign)
    {
        $contacts = Contact::all();
        $companies = Company::all();
        $jobTitles = DB::table('contacts')
            ->select(['job_title'])
            ->distinct()
            ->get();
        return Inertia::render(
            'Campaign/Template',
            compact('campaign', 'contacts', 'companies', 'jobTitles')
        );
    }

    /**
     * Show the schedule page
     *
     * @param Campaign $campaign
     * @return Response
     */
    public function getSchedules(Campaign $campaign)
    {
        return Inertia::render('Campaign/Schedule', compact('campaign'));
    }

    /**
     * Show the schedule page
     *
     * @param Campaign $campaign
     * @return Response
     */
    public function getSettings(Campaign $campaign)
    {
        return Inertia::render('Campaign/Setting', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCampaignRequest $request
     * @param Campaign $campaign
     * @return RedirectResponse
     */
    public function update(UpdateCampaignRequest $request, Campaign $campaign)
    {
        $campaign->update($request->validated());
        return redirect()->route('campaigns.index')->with('success', 'Update campaign success.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Campaign $campaign
     * @return RedirectResponse
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
        return redirect()->route('campaigns.index')->with('success', 'Delete campaign success.');
    }
}
