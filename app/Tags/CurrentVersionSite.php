<?php

namespace App\Tags;

use Statamic\Facades\Site;
use Statamic\Tags\Tags;
use Illuminate\Support\Str;

class CurrentVersionSite extends Tags
{
    /**
     * The {{ current_version_site }} tag.
     *
     * @return string|array
     */
    public function index()
    {
        $site = Site::current();

        if (! $site) {
            return Site::all()->first();
        }

        if (Str::contains($site->handle(), 'marketing')) {
            return Site::all()->first();
        }

        return $site;
    }

    /**
     * This kinda lets us use this tag as if it was a variable.
     * Eg: {{ current_version_site:name }}
     *
     * @return string
     */
    public function wildcard($tag)
    {
        return $this->index()->augmentedArrayData()[$tag];
    }
}
