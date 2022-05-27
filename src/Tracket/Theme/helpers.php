<?php

use Tracket\Page\Services\PageService;
use Tracket\Theme\DataTransferObjects\PageLink;

if (! function_exists('pageLink')) {
    function pageLink($slug): PageLink
    {
        /* @var $pageService PageService */
        $pageService = app(PageService::class);

        $page = $pageService->getBySlug($slug);

        return new PageLink($page);
    }
}
