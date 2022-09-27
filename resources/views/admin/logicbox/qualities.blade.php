<ul class="step3ul">
    <li class="step3_list bg-secondary">
        <button type="button" class="btn btn-sm btn-primary" onclick="updateQualities({{$cid}})">Save Changes</button>
        <input type="checkbox" class="sidecheckbox top-6 quality_checkbox_all" name="allQualityIds" onclick="toggleAllQualities()" value="1" />
    </li>
    @foreach ($qualities as $k => $i)
        <li class="step3_list" id="step3_{{$i->id}}">
            {{$k+1}}. {{ $i->name }} 
            @if(in_array($i->id, $squalities))
                <input type="checkbox" class="sidecheckbox quality_checkbox" value="{{$i->id}}" name="qualityIds" id="qualityId{{$i->id}}" checked="checked" onclick="toggleQualities()" />
            @else
                <input type="checkbox" class="sidecheckbox quality_checkbox" value="{{$i->id}}" name="qualityIds" id="qualityId{{$i->id}}" onclick="toggleQualities()" />
            @endif
        </li>
    @endforeach
</ul>