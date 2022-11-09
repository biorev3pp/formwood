<ul class="step2ul">
    <li class="step2_list bg-secondary">
        <button type="button" class="btn btn-sm btn-primary" onclick="updateCuts({{$sid}})">Save Changes</button>
        <input type="checkbox" class="sidecheckbox top-6 cut_checkbox_all" name="allCutIds" onclick="toggleAllCuts()" value="1" />
    </li>
    @foreach ($cuts as $k => $i)
        <li class="step2_list" id="step2_{{$i->id}}">
            <a href="javascript:;" data-trigger="hover" data-toggle="tooltip" data-placement="top" title="{{ $i->name }}" onclick="selectMatching({{$i->id}})"> {{$k+1}}. {{ $i->name }} </a>
            @if(in_array($i->id, $scuts))
                <input type="checkbox" class="sidecheckbox cut_checkbox" value="{{$i->id}}" name="cutIds" id="cutId{{$i->id}}" checked="checked" onclick="toggleCuts()" />
            @else
                <input type="checkbox" class="sidecheckbox cut_checkbox" value="{{$i->id}}" name="cutIds" id="cutId{{$i->id}}" onclick="toggleCuts()" />
            @endif
        </li>
    @endforeach
</ul>