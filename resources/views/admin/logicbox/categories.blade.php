<div class="w-full">
    @foreach ($categorysizes as $k => $i)
        @if (count($i->sizes) >= 1)
            <label class="logic-label">
                {{ $i->name }}
            </label>
            <ul class="step5ul">
                @foreach ($i->sizes as $sk => $si)
                    <li class="step5_list" id="step5_{{$si->id}}">
                        <a href="javascript:;" onclick="selectSize({{$i->id}}, {{$si->id}})"> 
                            {{$sk+1}}. {{ number_format($si->width) }} x {{ number_format($si->length) }} mm 
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    @endforeach
</div>
