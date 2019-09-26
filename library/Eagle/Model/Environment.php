<?php

namespace Icinga\Module\Eagle\Model;

use ipl\Orm\Model;
use ipl\Orm\Relations;

class Environment extends Model
{
    public function getTableName()
    {
        return 'environment';
    }

    public function getKeyName()
    {
        return 'id';
    }

    public function getColumns()
    {
        return [
            'name'
        ];
    }

    public function createRelations(Relations $relations)
    {
        $relations->hasMany('action_url', ActionUrl::class);
        $relations->hasMany('checkcommand', Checkcommand::class);
        $relations->hasMany('checkcommand_argument', CheckcommandArgument::class);
        $relations->hasMany('checkcommand_customvar', CheckcommandCustomvar::class);
        $relations->hasMany('checkcommand_envvar', CheckcommandEnvvar::class);
        $relations->hasMany('customvar', Customvar::class);
        $relations->hasMany('customvar_flat', CustomvarFlat::class);
        $relations->hasMany('endpoint', Endpoint::class);
        $relations->hasMany('eventcommand', Eventcommand::class);
        $relations->hasMany('eventcommand_argument', EventcommandArgument::class);
        $relations->hasMany('eventcommand_customvar', EventcommandCustomvar::class);
        $relations->hasMany('eventcommand_envvar', EventcommandEnvvar::class);
        $relations->hasMany('host', Host::class);
        $relations->hasMany('host_comment', HostComment::class);
        $relations->hasMany('host_customvar', HostCustomvar::class);
        $relations->hasMany('host_downtime', HostDowntime::class);
        $relations->hasMany('host_state', HostState::class);
        $relations->hasMany('hostgroup', Hostgroup::class);
        $relations->hasMany('hostgroup_customvar', HostgroupCustomvar::class);
        $relations->hasMany('hostgroup_member', HostgroupMember::class);
        $relations->hasMany('icon_image', IconImage::class);
        $relations->hasMany('notes_url', NotesUrl::class);
        $relations->hasMany('notification', Notification::class);
        $relations->hasMany('notification_customvar', NotificationCustomvar::class);
        $relations->hasMany('notification_user', NotificationUser::class);
        $relations->hasMany('notification_usergroup', NotificationUsergroup::class);
        $relations->hasMany('notificationcommand', Notificationcommand::class);
        $relations->hasMany('notificationcommand_argument', NotificationcommandArgument::class);
        $relations->hasMany('notificationcommand_customvar', NotificationcommandCustomvar::class);
        $relations->hasMany('notificationcommand_envvar', NotificationcommandEnvvar::class);
        $relations->hasMany('service', Service::class);
        $relations->hasMany('service_comment', ServiceComment::class);
        $relations->hasMany('service_customvar', ServiceCustomvar::class);
        $relations->hasMany('service_downtime', ServiceDowntime::class);
        $relations->hasMany('service_state', ServiceState::class);
        $relations->hasMany('servicegroup', Servicegroup::class);
        $relations->hasMany('servicegroup_customvar', ServicegroupCustomvar::class);
        $relations->hasMany('servicegroup_member', ServicegroupMember::class);
        $relations->hasMany('timeperiod', Timeperiod::class);
        $relations->hasMany('timeperiod_customvar', TimeperiodCustomvar::class);
        $relations->hasMany('timeperiod_override_exclude', TimeperiodOverrideExclude::class);
        $relations->hasMany('timeperiod_override_include', TimeperiodOverrideInclude::class);
        $relations->hasMany('timeperiod_range', TimeperiodRange::class);
        $relations->hasMany('user', User::class);
        $relations->hasMany('user_customvar', UserCustomvar::class);
        $relations->hasMany('usergroup', Usergroup::class);
        $relations->hasMany('usergroup_customvar', UsergroupCustomvar::class);
        $relations->hasMany('usergroup_member', UsergroupMember::class);
        $relations->hasMany('zone', Zone::class);
    }
}
