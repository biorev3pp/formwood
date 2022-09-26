<ul class="step6ul">
    <li class="step6_list bg-secondary">
        <button type="button" class="btn btn-sm btn-primary" onclick="updatePanelOptions({{$cid}})">Save Changes</button>
        <input type="checkbox" class="sidecheckbox top-6    _checkbox_all" name="allCutIds" onclick="toggleAllPanelOptions()" value="1" />
    </li>
    @foreach ($panel_options as $k => $i)
        <li class="step6_list" id="step6_{{$i->id}}">
            <a href="javascript:;" onclick="selectBackers({{$i->id}})"> {{$k+1}}. {{ $i->name }} </a>
            @if(in_array($i->id, $spanel_options))
                <input type="checkbox" class="sidecheckbox panel_option_checkbox" value="{{$i->id}}" name="panel_optionIds" id="panel_optionId{{$i->id}}" checked="checked" onclick="togglePanelOptions()" />
            @else
                <input type="checkbox" class="sidecheckbox panel_option_checkbox" value="{{$i->id}}" name="panel_optionIds" id="panel_optionId{{$i->id}}" onclick="togglePanelOptions()" />
            @endif
        </li>
    @endforeach
</ul>