<h4>Features / Permissions </h4>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
        <thead>
            <tr>
                <th class="">S/N</th>
                <th class="">Name</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php
                $sn = 1;
            @endphp
            @foreach ($permissions as $permission)

                <tr>
                    <td>{{ $sn++ }}</td>
                    <td>{{ str_replace('_', ' ', $permission->name) }}</td>
                    <td>
                        <input type="checkbox" {{ in_array($permission->name, $planFeatures) ? 'checked' : '' }}
                            name="checked_permissions[]" value="{{ $permission->id }}" class="form-control">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
