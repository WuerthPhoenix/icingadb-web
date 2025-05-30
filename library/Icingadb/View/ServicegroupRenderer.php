<?php

/* Icinga DB Web | (c) 2025 Icinga GmbH | GPLv2 */

namespace Icinga\Module\Icingadb\View;

use Icinga\Module\Icingadb\Common\Links;
use Icinga\Module\Icingadb\Model\ServicegroupSummary;
use Icinga\Module\Icingadb\Widget\Detail\ServiceStatistics;
use ipl\Html\Attributes;
use ipl\Html\HtmlDocument;
use ipl\Html\HtmlElement;
use ipl\Html\Text;
use ipl\I18n\Translation;
use ipl\Stdlib\BaseFilter;
use ipl\Stdlib\Filter;
use ipl\Web\Widget\ItemTable\ItemTableRenderer;
use ipl\Web\Widget\Link;

/** @implements ItemTableRenderer<ServicegroupSummary> */
class ServicegroupRenderer implements ItemTableRenderer
{
    use Translation;
    use BaseFilter;

    public function assembleAttributes($item, Attributes $attributes, string $layout): void
    {
        $attributes->get('class')->addValue('servicegroup');
    }

    public function assembleVisual($item, HtmlDocument $visual, string $layout): void
    {
    }

    public function assembleTitle($item, HtmlDocument $title, string $layout): void
    {
        if ($layout === 'header') {
            $title->addHtml(new HtmlElement(
                'span',
                Attributes::create(['class' => 'subject']),
                Text::create($item->display_name)
            ));
        } else {
            $link = new Link(
                $item->display_name,
                Links::servicegroup($item),
                [
                    'class' => 'subject',
                    'title' => sprintf(
                        $this->translate('List all services in the group "%s"'),
                        $item->display_name
                    )
                ]
            );

            if ($this->hasBaseFilter()) {
                $link->getUrl()->setFilter($this->getBaseFilter());
            }

            $title->addHtml($link);
        }
    }

    public function assembleCaption($item, HtmlDocument $caption, string $layout): void
    {
        $caption->addHtml(Text::create($item->name));
    }

    public function assembleExtendedInfo($item, HtmlDocument $info, string $layout): void
    {
        // assembleExtendedInfo() is only called when $layout == header
        $info->addHtml($this->createStatistics($item));
    }

    public function assembleFooter($item, HtmlDocument $footer, string $layout): void
    {
    }

    public function assemble($item, string $name, HtmlDocument $element, string $layout): bool
    {
        return false; // no custom sections
    }

    public function assembleColumns($item, HtmlDocument $columns, string $layout): void
    {
        $serviceStats = $this->createStatistics($item);

        if ($this->hasBaseFilter()) {
            $serviceStats->setBaseFilter(Filter::all($serviceStats->getBaseFilter(), $this->getBaseFilter()));
        }

        $columns->addHtml($serviceStats);
    }

    /**
     * Create statistics for the given item
     *
     * @param ServicegroupSummary $item
     *
     * @return ServiceStatistics
     */
    protected function createStatistics(ServicegroupSummary $item): ServiceStatistics
    {
        return (new ServiceStatistics($item))
            ->setBaseFilter(Filter::equal('servicegroup.name', $item->name));
    }
}
