<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Доступи
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        @if(count($permissions))
            @foreach($permissions->groupBy('type') as $type => $perms)
                <label class="control-label col-md-3" for="first-name">{{ $type }}
                </label>
                </br>
                <ul class="list-unstyled col-md-9">
                @foreach($perms as $perm)
                    <li>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="flat" name="perms[{{ $perm->id }}]" {{ ! empty($item) && $item->permissions->contains('id', $perm->id) ? 'checked' : '' }} value="true"> {{ $perm->display_name }}
                            </label>
                        </div>
                    </li>
                @endforeach
                </ul>
            @endforeach
        @else
            <label class="control-label col-md-6 col-sm-6 col-xs-12">Доступи у вибраній групі відсутні</label>
        @endif
    </div>
</div>