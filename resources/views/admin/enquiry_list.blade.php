@if(count($records) >= 1)
    @foreach ($records as $key => $record)
        <tr id="row{{$record->id}}">
            <td>{{ $key+1 }}. <input type="checkbox" class="bulk_checkbox" id="record{{$record->id}}" value="{{$record->id}}" name="bulk_record_id" /></td>
            <td>
                {{ ucwords($record->name) }}
                <br>
                @if($record->company)
                    <small class="ml-25 text-primary font-weight-bold text-uppercase"> - {{ $record->company }}</small>
                @else
                    <small class="ml-25 text-danger font-weight-medium"> - No company defined</small>
                @endif
            </td>
            <td>
                <b>E:</b> {{ ($record->email)?$record->email:'--' }}
                <br>
                <b>P:</b> {{ ($record->phone)?$record->phone:'--' }}
            </td>
            <td>
                @if($record->address_line1) 
                    {{ $record->address_line1 }}, 
                @endif
                @if($record->address_line2) 
                    {{ $record->address_line2 }},<br>
                @endif
                @if($record->city)
                    {{ $record->city }}, 
                @endif
                @if($record->state)
                    {{ $record->state }},<br>
                @endif
                @if($record->country)
                    {{ $record->country }}, 
                @endif
                @if($record->postal_code)
                    Zip Code: {{ $record->postal_code }}
                @endif
            </td>
            <td class="text-center">
                <a class="btn btn-outline-primary font-weight-bold btn-sm" href="javascript:void(0);" onclick="viewEstimate({{$record->id}})">
                    {{ $record->products_count }}
                </a>
            </td>
            <td>
                {{ date('jS M Y', strtotime($record->created_at)) }}
            </td>
            <td class="text-center">
                <a class="table-icon-btn text-danger" href="javascript:void(0);" title="Delete" onclick="deleteSwal({{$record->id}})">
                    <i class="ft-trash-2"></i>
                </a>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="6">
            <p class="text-danger p-0 m-0">
                No inquiries found till date.
            </p>
        </td>
    </tr>
@endif