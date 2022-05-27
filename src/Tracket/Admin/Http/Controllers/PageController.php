<?php

namespace Tracket\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Tracket\Admin\Http\Requests\Pages\StorePageRequest;
use Tracket\Admin\Http\Requests\Pages\UpdatePageRequest;
use Tracket\Services\PageService;

class PageController extends Controller
{
    protected PageService $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function index(Request $request)
    {
        return view('admin::pages.index', [
            'pages' => $this->pageService->getAll()
        ]);
    }

    public function create(Request $request)
    {
        return view('admin::pages.edit');
    }

    public function edit(Request $request, $externalId)
    {
        $page = $this->pageService->getByExternalId($externalId);

        return view('admin::pages.edit', [
            'page' => $page
        ]);
    }

    public function store(StorePageRequest $request)
    {
        $this->pageService->create($request->validated());

        return redirect(route('admin.pages.index'))->with('success-message', 'Page created successfully.');
    }

    public function update(UpdatePageRequest $request, $externalId)
    {
        $this->pageService->update($externalId, $request->validated());

        return redirect(route('admin.pages.index'))->with('success-message', 'Page updated successfully.');
    }

    public function destroy(Request $request, $externalId)
    {
        $this->pageService->delete($externalId);

        return redirect(route('admin.pages.index'))->with('success-message', 'Page deleted successfully.');
    }
}
