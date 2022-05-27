<?php

namespace Tracket\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Tracket\Admin\Http\Requests\Jobs\StoreJobRequest;
use Tracket\Admin\Http\Requests\Jobs\UpdateJobRequest;
use Tracket\Services\CompanyService;
use Tracket\Services\JobService;

class JobController extends Controller
{
    protected JobService $jobService;
    protected CompanyService $companyService;

    public function __construct(JobService $jobService, CompanyService $companyService)
    {
        $this->jobService = $jobService;
        $this->companyService = $companyService;
    }

    public function index(Request $request)
    {
        return view('admin::jobs.index', [
            'jobs' => $this->jobService->getAll()
        ]);
    }

    public function create(Request $request)
    {
        $companies = $this->companyService->getComboboxOptions();
        return view('admin::jobs.edit', [
            'companies' => $companies
        ]);
    }

    public function edit(Request $request, $externalId)
    {
        $job       = $this->jobService->getByExternalId($externalId);
        $companies = $this->companyService->getComboboxOptions();

        return view('admin::jobs.edit', [
            'job'       => $job,
            'companies' => $companies
        ]);
    }

    public function store(StoreJobRequest $request)
    {
        $this->jobService->create($request->validated());
        return redirect(route('admin.jobs.index'))->with('success-message', 'Job created successfully.');
    }

    public function update(UpdateJobRequest $request, $externalId)
    {
        $this->jobService->update($externalId, $request->validated());
        return redirect(route('admin.jobs.index'))->with('success-message', 'Job updated successfully.');
    }

    public function destroy(Request $request, $externalId)
    {
        $this->jobService->delete($externalId);
        return redirect(route('admin.jobs.index'))->with('success-message', 'Job deleted successfully.');
    }
}
