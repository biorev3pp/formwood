<ul class="step6ul2">
    <li class="step6_list2 bg-secondary">
        <button type="button" class="btn btn-sm btn-primary" onclick="updateThickness({{$sid}})">Save Changes</button>
        <input type="checkbox" class="sidecheckbox top-6 thickness_checkbox_all" name="allThicknessIds" onclick="toggleAllThicknesss()" value="1" />
    </li>
    @foreach ($thickness as $k => $i)
        <li class="step6_list_2" id="step6_2_{{$i->id}}">
            <a href="javascript:;"> {{$k+1}}. {{ $i->name }} </a>
            @if(in_array($i->id, $sthickness))
                <input type="checkbox" class="sidecheckbox thickness_checkbox" value="{{$i->id}}" name="thicknessIds" id="thicknessId{{$i->id}}" checked="checked" onclick="toggleThicknesss()" />
            @else
                <input type="checkbox" class="sidecheckbox thickness_checkbox" value="{{$i->id}}" name="thicknessIds" id="thicknessId{{$i->id}}" onclick="toggleThicknesss()" />
            @endif
        </li>
    @endforeach
</ul>