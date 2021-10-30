@extends("dashboards.admin.layouts.app")
@section('content')
<div id="tableCheckbox" class="">
    <div class="statbox widget box box-shadow mt-5">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Users</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <form action="{{ url()->current()}}" class="form-row">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="search" placeholder="Search...." value="{{ request()->query("search") }}" />
                </div>
                <div class="form-group col-auto">
                    <select class="form-control" name="role">
                        <option value=""> Select Role</option>
                        @foreach ($roles as $role)
                        <option value="{{$role}}" {{ request()->query("role") == $role ? "selected" : "" }}>{{$role}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-auto">
                    <select class="form-control" name="plan">
                        <option value=""> Select Plan</option>
                        @foreach ($plans as $plan)
                        <option value="{{$plan->name}}" {{ request()->query("plan") == $plan->name ? "selected" : "" }}>{{$plan->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-auto">
                    <button class="btn btn-primary btn-sm" type="submit">Filter</button>
                </div>

            </form>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                    <thead>
                        <tr>
                            <th class="">S/N</th>
                            <th class="checkbox-column">
                                <label class="new-control new-checkbox checkbox-primary" style="height: 18px; margin: 0 auto;">
                                    <input type="checkbox" class="new-control-input todochkbox" id="todoAll">
                                    <span class="new-control-indicator"></span>
                                </label>
                            </th>
                            <th class="">Name</th>
                            <th class="">Email</th>
                            <th class="">Role</th>
                            <th class="">Active Plan</th>
                            <th class="">Joined On</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $sn++ }}</td>
                            <td class="checkbox-column">
                                <label class="new-control new-checkbox checkbox-primary" style="height: 18px; margin: 0 auto;">
                                    <input type="checkbox" class="new-control-input todochkbox" id="todo-1">
                                    <span class="new-control-indicator"></span>
                                </label>
                            </td>
                            <td>{{ $user->names() }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->activePlan()->plan_name }}</td>
                            <td>{{ $user->created_at }}</td>

                            <td class="text-center">
                                <ul class="table-controls">
                                    <li><a href="{{ route('admin.users.show', $user->id) }}" class="mr-2" data-toggle="tooltip" data-placement="top" title="Settings"><i data-feather="settings"></i></a> </li>
                                    <li><a href="{{ route('admin.users.edit', $user->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i>
                                                <i data-feather="edit-2" class="text-info"></i></a></li>
                                    <li class="mt-2">
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this record?')">
                                            @csrf
                                            @method('DELETE')

                                            @if (isDev())
                                            <a href="{{ route('admin.users.imitate', $user->id) }}" class="mr-2" onclick="return confirm('Are you sure you want to login as this user?')" data-toggle="tooltip" data-placement="top" title="Edit"><i>
                                                    <i data-feather="eye" class="text-dark"></i></a>
                                            @endif

                                            <button type="submit" data-feather="trash-2" class="text-danger" onClick="$(this).parent().trigger('submit')"></button>
                                        </form>
                                    </li>
                                </ul>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
                {!! $users->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
</div>
@endsection
