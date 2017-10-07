@extends('layouts.app')

@section('template_title')
  Showing User {{ $user['name'] }}
@endsection

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <div class="panel @if ($user['activated'] == 1) panel-success @else panel-danger @endif">

          <div class="panel-heading">
            <a href="/users/" class="btn btn-primary btn-xs pull-right">
              <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
              <span class="hidden-xs">{{ trans('usersmanagement.usersBackBtn') }}</span>
            </a>
            {{ trans('usersmanagement.usersPanelTitle') }}
          </div>
          <div class="panel-body">
            <div class="border-bottom"></div>

            @if ($user['name'])

              <div class="col-sm-5 col-xs-6 text-larger">
                <strong>
                  {{ trans('usersmanagement.labelUserName') }}
                </strong>
              </div>

              <div class="col-sm-7">
                {{ $user['name'] }}
              </div>

              <div class="clearfix"></div>
              <div class="border-bottom"></div>

            @endif

            @if ($user['email'])

            <div class="col-sm-5 col-xs-6 text-larger">
              <strong>
                {{ trans('usersmanagement.labelEmail') }}
              </strong>
            </div>

            <div class="col-sm-7">
              {{ HTML::mailto($user['email'], $user['email']) }}
            </div>

            <div class="clearfix"></div>
            <div class="border-bottom"></div>

            @endif

            @if ($user['first_name'])

              <div class="col-sm-5 col-xs-6 text-larger">
                <strong>
                  {{ trans('usersmanagement.labelFirstName') }}
                </strong>
              </div>

              <div class="col-sm-7">
                {{ $user['first_name'] }}
              </div>

              <div class="clearfix"></div>
              <div class="border-bottom"></div>

            @endif

            @if ($user['last_name'])

              <div class="col-sm-5 col-xs-6 text-larger">
                <strong>
                  {{ trans('usersmanagement.labelLastName') }}
                </strong>
              </div>

              <div class="col-sm-7">
                {{ $user['last_name'] }}
              </div>

              <div class="clearfix"></div>
              <div class="border-bottom"></div>

            @endif

            <div class="col-sm-5 col-xs-6 text-larger">
              <strong>
                {{ trans('usersmanagement.labelRole') }}
              </strong>
            </div>

            <div class="col-sm-7">
              @if ($user['role_name'] == 'User')
                @php $labelClass = 'primary' @endphp

              @elseif ($user['role_name'] == 'Admin')
                @php $labelClass = 'warning' @endphp

              @elseif ($user['role_name'] == 'Unverified')
                @php $labelClass = 'danger' @endphp

              @else
                @php $labelClass = 'default' @endphp

              @endif

              <span class="label label-{{$labelClass}}">{{ $user['role_name'] }}</span>
            </div>

            <div class="clearfix"></div>
            <div class="border-bottom"></div>

            <div class="col-sm-5 col-xs-6 text-larger">
              <strong>
                {{ trans('usersmanagement.labelStatus') }}
              </strong>
            </div>

            <div class="col-sm-7">
              @if ($user['activated'] == 1)
                <span class="label label-success">
                  Activated
                </span>
              @else
                <span class="label label-danger">
                  Not-Activated
                </span>
              @endif
            </div>

            <div class="clearfix"></div>
            <div class="border-bottom"></div>

            @if ($user['created_at'])

              <div class="col-sm-5 col-xs-6 text-larger">
                <strong>
                  {{ trans('usersmanagement.labelCreatedAt') }}
                </strong>
              </div>

              <div class="col-sm-7">
                {{ $user['created_at'] }}
              </div>

              <div class="clearfix"></div>
              <div class="border-bottom"></div>

            @endif

            @if ($user['updated_at'])

              <div class="col-sm-5 col-xs-6 text-larger">
                <strong>
                  {{ trans('usersmanagement.labelUpdatedAt') }}
                </strong>
              </div>

              <div class="col-sm-7">
                {{ $user['updated_at'] }}
              </div>

              <div class="clearfix"></div>
              <div class="border-bottom"></div>

            @endif

            @if ($user['signup_ip_address'])

              <div class="col-sm-5 col-xs-6 text-larger">
                <strong>
                  {{ trans('usersmanagement.labelIpEmail') }}
                </strong>
              </div>

              <div class="col-sm-7">
                {{ $user['signup_ip_address'] }}
              </div>

              <div class="clearfix"></div>
              <div class="border-bottom"></div>

            @endif

            @if ($user['signup_confirmation_ip_address'])

              <div class="col-sm-5 col-xs-6 text-larger">
                <strong>
                  {{ trans('usersmanagement.labelIpConfirm') }}
                </strong>
              </div>

              <div class="col-sm-7">
                {{ $user['signup_confirmation_ip_address'] }}
              </div>

              <div class="clearfix"></div>
              <div class="border-bottom"></div>

            @endif

            @if ($user['signup_sm_ip_address'])

              <div class="col-sm-5 col-xs-6 text-larger">
                <strong>
                  {{ trans('usersmanagement.labelIpSocial') }}
                </strong>
              </div>

              <div class="col-sm-7">
                {{ $user['signup_sm_ip_address'] }}
              </div>

              <div class="clearfix"></div>
              <div class="border-bottom"></div>

            @endif

            @if ($user['admin_ip_address'])

              <div class="col-sm-5 col-xs-6 text-larger">
                <strong>
                  {{ trans('usersmanagement.labelIpAdmin') }}
                </strong>
              </div>

              <div class="col-sm-7">
                {{ $user['admin_ip_address'] }}
              </div>

              <div class="clearfix"></div>
              <div class="border-bottom"></div>

            @endif

            @if ($user['updated_ip_address'])

              <div class="col-sm-5 col-xs-6 text-larger">
                <strong>
                  {{ trans('usersmanagement.labelIpUpdate') }}
                </strong>
              </div>

              <div class="col-sm-7">
                {{ $user['updated_ip_address'] }}
              </div>

              <div class="clearfix"></div>
              <div class="border-bottom"></div>

            @endif

          </div>

        </div>
      </div>
    </div>
  </div>

  @include('modals.modal-delete')

@endsection

@section('footer_scripts')

  @include('scripts.delete-modal-script')

@endsection
