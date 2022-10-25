<?php

namespace Aoe\Asdis\Content\Scraper\Html;

use Aoe\Asdis\Content\Scraper\ScraperInterface;
use Aoe\Asdis\Domain\Model\Asset\Collection;

/**
 * Scrapes CSS assets from "<link>" tags.
 */
class CssFile extends AbstractHtmlScraper implements ScraperInterface
{
    /**
     * @param $content
     * @return Collection
     */
    public function scrape($content)
    {
        return $this->getAssets('link', 'href', $content, ['rel' => 'stylesheet'])
            ->merge($this->getAssets('link', 'href', $content, ['type' => 'text/css']));
    }
}
