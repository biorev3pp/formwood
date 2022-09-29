<div class="w-full">
    <label class="logic-label">
       Panel Substrates
    </label>
    <div class="step-in-50">
        <ul class="step6ul">
            @foreach ($substrates as $sk => $si)
                <li class="step6_list" id="step6_{{$si->id}}">
                    <a href="javascript:;" onclick="selectSubstrate({{$si->id}})"> 
                        {{$sk+1}}. {{ $si->name }}
                    </a>
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
