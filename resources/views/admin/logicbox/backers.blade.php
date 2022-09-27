<ul class="step7ul">
    <li class="step7_list bg-secondary">
        <button type="button" class="btn btn-sm btn-primary" onclick="updateBackers({{$cid}})">Save Changes</button>
        <input type="checkbox" class="sidecheckbox top-6    _checkbox_all" name="allCutIds" onclick="toggleAllBackers()" value="1" />
    </li>
    @foreach ($backers as $k => $i)
        <li class="step7_list" id="step7_{{$i->id}}">
            <a href="javascript:;"> {{$k+1}}. {{ $i->name }} </a>
            @if(in_array($i->id, $sbackers))
                <input type="checkbox" class="sidecheckbox  _checkbox" value="{{$i->id}}" name="backerIds" id="backerId{{$i->id}}" checked="checked" onclick="toggleBackers()" />
            @else
                <input type="checkbox" class="sidecheckbox backer_checkbox" value="{{$i->id}}" name="backerIds" id="backerId{{$i->id}}" onclick="toggleBackers()" />
            @endif
        </li>
    @endforeach
</ul>