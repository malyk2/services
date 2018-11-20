<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Ролі користувача</label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        @if(count($roles))
            <select class="form-control" name="roles[]" multiple="multiple">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}"  {{ ! empty($item) && $item->roles->contains('id', $role->id) ? 'selected="selected"' : '' }} >{{ $role->name }}</option>
                @endforeach
            </select>
        @else
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Ролі у вибраній групі відсутні</label>
        @endif
    </div>
</div>