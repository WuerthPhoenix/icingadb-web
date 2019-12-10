<?php

namespace Icinga\Module\Icingadb\Controllers;

use Icinga\Module\Icingadb\Model\Usergroup;
use Icinga\Module\Icingadb\Web\Controller;
use Icinga\Module\Icingadb\Widget\ItemList\UsergroupList;
use Icinga\Security\SecurityException;

class UsergroupsController extends Controller
{
    public function init()
    {
        parent::init();

        if (! $this->hasPermission('*') && $this->hasPermission('no-monitoring/contacts')) {
            throw new SecurityException('No permission for %s', 'monitoring/contacts');
        }
    }

    public function indexAction()
    {
        $this->setTitle($this->translate('User Groups'));

        $db = $this->getDb();

        $usergroups = Usergroup::on($db)->with('user');

        $limitControl = $this->createLimitControl();
        $paginationControl = $this->createPaginationControl($usergroups);
        $filterControl = $this->createFilterControl($usergroups);

        $this->filter($usergroups);

        yield $this->export($usergroups);

        $this->addControl($paginationControl);
        $this->addControl($limitControl);
        $this->addControl($filterControl);

        $this->addContent(new UsergroupList($usergroups));
    }
}
