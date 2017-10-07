@php

    $levelAmount = 'level';

    if (Auth::User()->level() >= 2) {
        $levelAmount = 'levels';

    }

@endphp


<div class="panel panel-primary @role('admin', true) panel-info  @endrole">
    <div class="panel-heading">

        Welcome {{ Auth::user()->name }}

        @role('admin', true)
            <span class="pull-right label label-primary" style="margin-top:4px">
            Admin Access
            </span>
        @else
            <span class="pull-right label label-warning" style="margin-top:4px">
            User Access
            </span>
        @endrole

    </div>
    <div class="panel-body">
        <h2 class="lead">
            {{ trans('auth.loggedIn') }}
        </h2>
        <hr>

        @role('admin')

            <hr>

            <h4>
                You have permissions:
                @permission('view.users')
                    <span class="label label-primary margin-half margin-left-0"">
                        {{ trans('permsandroles.permissionView') }}
                    </span>
                @endpermission

                @permission('create.users')
                    <span class="label label-info margin-half margin-left-0"">
                        {{ trans('permsandroles.permissionCreate') }}
                    </span>
                @endpermission

                @permission('edit.users')
                    <span class="label label-warning margin-half margin-left-0"">
                        {{ trans('permsandroles.permissionEdit') }}
                    </span>
                @endpermission

                @permission('delete.users')
                    <span class="label label-danger margin-half margin-left-0"">
                        {{ trans('permsandroles.permissionDelete') }}
                    </span>
                @endpermission

            </h4>

        @endrole

    </div>
</div>