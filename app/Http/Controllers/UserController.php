<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\User;
use App\Permission;
use App\Role;
use App\Http\Requests\User\SaveGroup as SaveGroupRequest;
use App\Http\Requests\User\SaveUser as SaveUserRequest;
use App\Http\Requests\User\SaveRole as SaveRoleRequest;

class UserController extends Controller
{
    public function listGroups()
    {
        $this->authorize('manage', Group::class);
        $tree = auth()->user()->getTreeAllGroups(['users', 'roles', 'descendants.users']);
        return view('user.listGroups', compact('tree'));
    }

    public function addGroup()
    {
        $this->authorize('manage', Group::class);
        $user = auth()->user();
        $tree = $user->getTreeAllGroups();
        $permissions = $user->group->permissions;
        $lifetimes = config('smart.users.groups.lifetimes');
        return view('user.formGroup', compact('tree', 'permissions', 'lifetimes'));
    }

    public function editGroup(Group $group)
    {
        $this->authorize('edit', $group);
        $item = $group->load('permissions', 'users', 'ancestors');
        $user = auth()->user();
        $tree = $user->getTreeAllGroups();
        $permissions = $user->group->permissions;
        $lifetimes = config('smart.users.groups.lifetimes');
        return view('user.formGroup', compact('item', 'tree', 'permissions', 'lifetimes'));
    }

    public function saveGroup(SaveGroupRequest $request, Group $group)
    {
        $this->authorize('manage', Group::class);
        $data = $request->validated();
        $attributes = array_only($data, ['name', 'active', 'lifetime']);
        if ( ! $group->exists ) {
            $parent = Group::find($data['parent_id']);
            $group = $parent->children()->create($attributes);
        } else {
            $group->update($attributes);
        }
        if (auth()->user()->can('groups', Permission::class)) {
            $perms = array_key_exists('perms', $data) ? array_keys($data['perms']) : [];
            $group->permissions()->sync($perms);
        }
        return redirect()->route('user.listGroups')->pnotify('Дані збережено', '','success');
    }

    public function deleteGroup(Group $group)
    {
        $this->authorize('delete', $group);
        $group->delete();
        return redirect()->route('user.listGroups')->pnotify('Групу видалено.', '','success');
    }

    public function listUsers(Request $request)
    {
        $this->authorize('manage', User::class);

        $search = $request->get('search');
        $filter_group = $request->get('filter_group');

        $userGroups = auth()->user()->getAllGroups();
        $userGroupsIds = $userGroups->pluck('id');

        $query = User::query();
        $query->with('group.ancestors', 'roles')->whereIn('group_id', $userGroupsIds);
        if( ! empty($search)) {
            $query->where(function($q) use($search){
                $q->where('name', 'like', "%".$search."%");
                $q->orWhere('email', 'like', "%".$search."%");
                $q->orWhere('pib', 'like', "%".$search."%");
            });
        }
        ! empty($filter_group) ? $query->where('group_id', $filter_group) : false;

        $users = $query->paginate(User::PAGINATE_PER_PAGE);
        $userGroups->load('ancestors');

        return view('user.listUsers', compact('users', 'userGroups', 'search', 'filter_group'));
    }

    public function addUser()
    {
        $this->authorize('manage', User::class);
        $groupsTree = auth()->user()->getTreeAllGroups();
        return view('user.formUser', compact('groupsTree'));
    }

    public function editUser(User $user)
    {
        $this->authorize('edit', $user);
        $item = $user->load('roles', 'group.roles');
        $groupsTree = auth()->user()->getTreeAllGroups();
        return view('user.formUser', compact('item', 'groupsTree'));
    }

    public function saveUser(SaveUserRequest $request, User $user)
    {
        $this->authorize('manage', User::class);
        $data = $request->validated();
        $user->fill($data);
        $user->save();
        $roles = array_key_exists('roles', $data) ? $data['roles'] : [];
        $user->roles()->sync($roles);
        return redirect()->route('user.listUsers')->pnotify('Дані збережено', '','success');
    }

    public function deleteUser(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        return redirect()->route('user.listUsers')->pnotify('Користувача видалено.', '','success');
    }

    public function listRoles(Request $request)
    {
        $this->authorize('manage', Role::class);

        $search = $request->get('search');
        $filter_group = $request->get('filter_group');

        $userGroups = auth()->user()->getAllGroups();
        $userGroupsIds = $userGroups->pluck('id');

        $query = Role::query();
        $query->with('group.ancestors','users')->whereIn('group_id', $userGroupsIds);
        ! empty($search) ? $query->where('name', 'like', "%".$search."%") : false;
        ! empty($filter_group) ? $query->where('group_id', $filter_group) : false;

        $roles = $query->paginate(Role::PAGINATE_PER_PAGE);
        ! empty($search) ? $roles->appends(compact('search')) : false;
        ! empty($filter_group) ? $roles->appends(compact('filter_group')) : false;

        $userGroups->load('ancestors');

        return view('user.listRoles', compact('roles', 'userGroups', 'search', 'filter_group'));
    }

    public function addRole()
    {
        $this->authorize('manage', Role::class);
        $groupsTree = auth()->user()->getTreeAllGroups();
        return view('user.formRole', compact('groupsTree'));
    }

    public function saveRole(SaveRoleRequest $request, Role $role)
    {
        $this->authorize('manage', Role::class);
        $data = $request->validated();
        $role->fill($data);
        $role->save();
        $perms = array_key_exists('perms', $data) ? array_keys($data['perms']) : [];
        $role->permissions()->sync($perms);
        return redirect()->route('user.listRoles')->pnotify('Успіх', 'Дані збережено', 'success');
    }

    public function editRole(Role $role)
    {
        $this->authorize('edit', $role);
        $item = $role->load('group.permissions');
        $groupsTree = auth()->user()->getTreeAllGroups();
        return view('user.formRole', compact('item', 'groupsTree'));
    }

    public function deleteRole(Role $role)
    {
        $this->authorize('delete', $role);
        $role->delete();
        return redirect()->route('user.listRoles')->pnotify('Успіх', 'Роль видалено.','success');
    }

    public function getPerms(Group $group, Role $role)
    {
        $group->load('permissions');
        $permissions = $group->permissions;
        $item = $role->load('permissions');
        return view('user.checkboxesPermissions', compact('permissions', 'item'));
    }

    public function getRoles(Group $group)
    {
        $group->load('roles');
        $roles = $group->roles;
        return view('user.selectRoles', compact('roles'));
    }
}
