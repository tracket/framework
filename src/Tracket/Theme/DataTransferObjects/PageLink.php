<?php

namespace Tracket\Theme\DataTransferObjects;

use Tracket\Page\Models\Page;

class PageLink
{
    private Page $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function getUrl(): string
    {
        return route('web.pages.show', $this->page->getSlug());
    }

    public function getTitle(): string
    {
        return $this->page->getTitle();
    }
}
