@push('js')
<script>
  $(function(){
    $('#bottom-logout').on('click', function(e){
      e.preventDefault();
      new PNotify({
        title: 'Підтвердження',
        text: 'Вийти з системи?',
        icon: 'glyphicon glyphicon-question-sign',
        hide: true,
        confirm: {
          confirm: true
        },
        addclass: 'stack-modal',
        stack: {'dir1': 'down', 'dir2': 'right', 'modal': true}
        }).get().on('pnotify.confirm', function(){
          window.location.href = $(e.currentTarget).attr('href');
        }).on('pnotify.cancel', function(){
        });
    });
    });
</script>
@endpush
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
      <div class="navbar nav_title" style="border: 0;">
        <a href="javascript:;" class="site_title"><i class="fa fa-object-ungroup"></i> <span>Smart services</span></a>
      </div>

      <div class="clearfix"></div>

      <!-- menu profile quick info -->
      <div class="profile clearfix">
        <div class="profile_pic">
          <img src="{{ asset('images/avatar.png') }}" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
          <span>Користувач</span>
          <h2>{{ auth()->user()->pib }}</h2>
        </div>
        <div class="clearfix"></div>
      </div>
      <!-- /menu profile quick info -->

      <br />

      <!-- sidebar menu -->
      <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
          <h3>Управління</h3>
          <ul class="nav side-menu">
            @permission(['users.manage', 'groups.manage', 'roles.manage'])
            <li class="active">
              <a><i class="fa fa-users"></i> Користувачі <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu {{ request()->routeIs('user*') ? 'active' : ''}}">
                @permission('users.manage')
                  <li class="{{ request()->routeIs('user.listUsers') ? 'current-page' : '' }}"><a href="{{ route('user.listUsers') }}">Список користувачів</a></li>
                @endpermission
                @permission('groups.manage')
                  <li><a href="{{ route('user.listGroups') }}">Групи користувачів</a></li>
                @endpermission
                @permission('roles.manage')
                  <li><a href="{{ route('user.listRoles') }}">Ролі користувачів</a></li>
                @endpermission
              </ul>
            </li>
            @endpermission
          </ul>
        </div>
      </div>
      <!-- /sidebar menu -->

      <!-- /menu footer buttons -->
      <div class="sidebar-footer hidden-small">
        <a href="{{ route('home') }}" data-toggle="tooltip" data-placement="top" title="Домівка">
          <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
        </a>
        <a href="{{ route('profile.form') }}" data-toggle="tooltip" data-placement="top" title="Settings">
          <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
        </a>
        <a id="user-time"></a>
        <a href="{{ route('logout') }}" id="bottom-logout" data-toggle="tooltip" data-placement="top" title="Logout">
          <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        </a>
      </div>
      <!-- /menu footer buttons -->
    </div>
  </div>