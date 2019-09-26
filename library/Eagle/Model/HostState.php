<?php

namespace Icinga\Module\Eagle\Model;

use Icinga\Module\Eagle\Common\HostStates;
use ipl\Orm\Relations;

/**
 * Host state model.
 */
class HostState extends State
{
    public function getTableName()
    {
        return 'host_state';
    }

    public function getKeyName()
    {
        return 'host_id';
    }

    public function createRelations(Relations $relations)
    {
        $relations->belongsTo('environment', Environment::class);
        $relations->belongsTo('host', Host::class);

        $relations->hasOne('comment', HostComment::class)
            ->setCandidateKey('acknowledgement_comment_id');
    }

    /**
     * Get the host state as the textual representation
     *
     * @return string
     */
    public function getStateText()
    {
        return HostStates::text($this->properties['soft_state']);
    }

    /**
     * Get the host state as the translated textual representation
     *
     * @return string
     */
    public function getStateTextTranslated()
    {
        return HostStates::text($this->properties['soft_state']);
    }
}
