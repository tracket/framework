<?php

namespace Tracket\Admin\Http\Controllers;

use App\Services\CompanyService;
use Illuminate\Http\Request;
use Tracket\Admin\Http\Requests\Companies\StoreCompanyRequest;
use Tracket\Admin\Http\Requests\Companies\UpdateCompanyRequest;

class CompanyController extends Controller
{
    protected CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function index(Request $request)
    {
        return view('admin::companies.index', [
            'companies' => $this->companyService->getAll()
        ]);
    }

    public function create(Request $request)
    {
        return view('admin::companies.edit');
    }

    public function edit(Request $request, $externalId)
    {
        $company = $this->companyService->getByExternalId($externalId);

        return view('admin::companies.edit', [
            'company' => $company
        ]);
    }

    public function store(StoreCompanyRequest $request)
    {
        $this->companyService->create($request->validated());

        return redirect(route('admin.companies.index'))->with('success-message', 'Company created successfully.');
    }

    public function update(UpdateCompanyRequest $request, $externalId)
    {
        $this->companyService->update($externalId, $request->validated());

        return redirect(route('admin.companies.index'))->with('success-message', 'Company updated successfully.');
    }

    public function destroy(Request $request, $externalId)
    {
        $this->companyService->delete($externalId);

        return redirect(route('admin.companies.index'))->with('success-message', 'Company deleted successfully.');
    }
}
