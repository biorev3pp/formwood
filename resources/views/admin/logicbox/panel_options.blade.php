<div class="w-full">
    <label class="logic-label">
       Panel Substrates
    </label>
    <div class="step-in-50">
        <ul class="step6ul">
            <li class="step6_list bg-secondary">
                <button type="button" class="btn btn-sm btn-primary" onclick="updateSubstrate({{$sid}})">Save Changes</button>
                <input type="checkbox" class="sidecheckbox top-6 substrate_checkbox_all" name="allSubstrateIds" onclick="toggleAllSubstrate()" value="1" />
            </li>
            @foreach ($substrates as $k => $i)
                <li class="step6_list" id="step6_{{$i->id}}">
                    <a href="javascript:;" data-trigger="hover" data-toggle="tooltip" data-placement="top" title="{{ $i->name }}" onclick="selectSubstrate({{$i->id}})"> {{$k+1}}. {{ $i->name }} </a>
                    @if(in_array($i->id, $ssubtrates))
                        <input type="checkbox" class="sidecheckbox substrate_checkbox" value="{{$i->id}}" name="substrateIds" id="substrateId{{$i->id}}" checked="checked" onclick="toggleSubstrate()" />
                    @else
                        <input type="checkbox" class="sidecheckbox substrate_checkbox" value="{{$i->id}}" name="substrateIds" id="substrateId{{$i->id}}" onclick="toggleSubstrate()" />
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
    <label class="logic-label">
        Panel Core Thickness
    </label>
    <div class="step-in-50 logic-subsection-6">
        <p class="text-info w-100 p-1 text-center">Please select any panel panel substrate to view core thickness options</p>
    </div>
</div>