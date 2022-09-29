<div class="w-full">
    @if($category->sheet_type_id == 1)
        <label class="logic-label">Universal Backers for all sizes</label>
    @endif
    <ul class="step7ul">
        @if($category->sheet_type_id != 1)
            <li class="step7_list bg-secondary">
                <button type="button" class="btn btn-sm btn-primary" onclick="updateBackers({{$cid}})">Save Changes</button>
                <input type="checkbox" class="sidecheckbox top-6  backer_checkbox_all" name="allBackerIds" onclick="toggleAllBackers()" value="1" />
            </li>
        @endif
        @foreach ($backers as $k => $i)
            <li class="step7_list" id="step7_{{$i->id}}">
                <a href="javascript:;"> {{$k+1}}. {{ $i->name }} </a>
                @if($category->sheet_type_id != 1)
                    @if(in_array($i->id, $sbackers))
                        <input type="checkbox" class="sidecheckbox  backer_checkbox" value="{{$i->id}}" name="backerIds" id="backerId{{$i->id}}" checked="checked" onclick="toggleBackers()" />
                    @else
                        <input type="checkbox" class="sidecheckbox backer_checkbox" value="{{$i->id}}" name="backerIds" id="backerId{{$i->id}}" onclick="toggleBackers()" />
                    @endif
                @endif
            </li>
        @endforeach
    </ul>
</div>