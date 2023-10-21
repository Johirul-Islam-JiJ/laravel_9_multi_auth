@can('role.edit')
    <a href="{{route('roles.edit', encrypt($role->id))}}" class="badge badge-success">{{__('Edit')}}</a>
@endcan
