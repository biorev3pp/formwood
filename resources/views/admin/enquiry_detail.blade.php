<div>
    <table class="table table-bordered table-striped full-out">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Company</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Zip Code</th>
                <th>Country</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> {{ $estimate->name }} </td>
                <td> {{ $estimate->email }} </td>
                <td> {{ $estimate->phone }} </td>
                <td> {{ $estimate->company }} </td>
                <td> 
                    {{ $estimate->address_line1 }} <br>
                    {{ $estimate->address_line2 }}
                </td>
                <td> {{ $estimate->city }} </td>
                <td> {{ $estimate->state }} </td>
                <td> {{ $estimate->postal_code }} </td>
                <td> {{ $estimate->country }} </td>
            </tr>
        </tbody>
    </table>
    <table class="table table-bordered table-striped full-out">
        <thead>
            <tr>
                <th width="50%">Remark</th>
                <th>Attachments</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ ($estimate->remarks)?$estimate->remarks:'-- No remarks added --' }}</td>
                <td>
                    @if($estimate->attachments)
                        @foreach (explode(',', $estimate->attachments) as $attach)
                            <a target="_blank" href="{{asset('attachments/'.$attach)}}" class="btn btn-sm btn-outline-primary m-25">
                                {{ $attach }}
                            </a>
                        @endforeach
                    @else
                        <p>-- No attachments --</p>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

    <div>
        <h5 class="font-weight-bold text-dark text-uppercase">Products</h5>
        <table class="table table-bordered table-striped full-out">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Size</th>
                    <th>Species</th>
                    <th>Cut</th>
                    <th>Quality</th>
                    <th>Matching</th>
                    <th>Substrate</th>
                    <th>Thickness</th>
                    <th>Backer</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                <tr>
                    <td> {{ ($product->sheet_type_id)?$product->category->name:'--' }} </td>
                    <td> {{ ($product->custom_width || $product->custom_length)
                            ? 'Custom Size: '.number_format($product->custom_width).' x '.number_format($product->custom_length).' Inch'
                            : (($product->size_id >= 1)? $product->size->width.' x '.$product->size->length.' Inch' :' -- ' ) }} </td>
                    <td> {{ ($product->species_id)?$product->specie->name:'--' }} </td>
                    <td> {{ ($product->cut_id)?$product->cut->name:'--' }} </td>
                    <td> {{ ($product->quality_id)?$product->quality->name:'--' }} </td>
                    <td> {{ ($product->matching_id)?$product->matching->name:'--' }} </td>
                    <td> {{ ($product->substrate_id)?$product->substrate->name:'--' }} </td>
                    <td> {{ ($product->thickness_id)?$product->thickness->name:'--' }} </td>
                    <td> {{ ($product->backer_id)?$product->backer->name:'--' }} </td>
                    <td> {{ $product->qty }} </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10">
                        <p class="text-weight-medium text-danger">No product added</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>