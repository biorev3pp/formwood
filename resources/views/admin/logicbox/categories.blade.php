<ul class="step5ul">
    <li class="step5_list bg-secondary">
        <button type="button" class="btn btn-sm btn-primary" onclick="updateCategorySizes({{$cid}})">Save Changes</button>
        <input type="checkbox" class="sidecheckbox top-6 categorysize_checkbox_all" name="allCutIds" onclick="toggleAllCategorySizes()" value="1" />
    </li>
    @foreach ($categorysizes as $k => $i)
        <li class="step5_list" id="step5_{{$i->id}}">
            <a href="javascript:;" onclick="selectPanelOptions({{$i->id}})"> {{$k+1}}. {{ $i->name }} </a>
            @if(in_array($i->id, $scategorysizes))
                <input type="checkbox" class="sidecheckbox categorysize_checkbox" value="{{$i->id}}" name="categorysizeIds" id="categorysizeId{{$i->id}}" checked="checked" onclick="toggleCategorySizes()" />
            @else
                <input type="checkbox" class="sidecheckbox categorysize_checkbox" value="{{$i->id}}" name="categorysizeIds" id="categorysizeId{{$i->id}}" onclick="toggleCategorySizes()" />
            @endif
        </li>
    @endforeach
</ul>