<div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Brand</th>
                                @foreach ($areas as $area)
                                <th scope="col">{{$area->area_name}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <th scope="row">{{$product->product_name}}</th>
                                @foreach ($areas as $area)
                                <td scope="col">{{$reports->get($area->area_id)?->get($product->product_id)}}%</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
