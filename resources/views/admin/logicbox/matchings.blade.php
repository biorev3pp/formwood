<ul class="step4ul">
    <li class="step4_list bg-secondary">
        <button type="button" class="btn btn-sm btn-primary" onclick="updateMatchings({{$cid}})">Save Changes</button>
        <input type="checkbox" class="sidecheckbox top-6 matching_checkbox_all" name="allCutIds" onclick="toggleAllMatchings()" value="1" />
    </li>
    @foreach ($matchings as $k => $i)
        <li class="step4_list" id="step4_{{$i->id}}">
            <a href="javascript:;" onclick="selectCategorySize({{$i->id}})"> {{$k+1}}. {{ $i->name }} </a>
            @if(in_array($i->id, $smatchings))
                <input type="checkbox" class="sidecheckbox matching_checkbox" value="{{$i->id}}" name="matchingIds" id="matchingId{{$i->id}}" checked="checked" onclick="toggleMatchings()" />
            @else
                <input type="checkbox" class="sidecheckbox matching_checkbox" value="{{$i->id}}" name="matchingIds" id="matchingId{{$i->id}}" onclick="toggleMatchings()" />
            @endif
        </li>
    @endforeach
</ul>