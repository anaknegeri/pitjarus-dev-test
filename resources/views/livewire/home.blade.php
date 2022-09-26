<div>
    <div class="row justify-content-end">
        <div class="col-auto">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Pilih Area
                </button>
                <div class="dropdown-menu p-2">
                    @foreach ($area as $item)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="check-{{$item->area_id}}"
                            name="areas.{{ $item->area_id }}" value="{{ $item->area_id }}" wire:model="selectedArea"
                            {{ in_array($item->area_id , $selectedArea)? "checked":"" }}>
                        <label class="form-check-label" for="check-{{$item->area_id}}">{{$item->area_name}}</label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-auto">
            <input type="text" name="daterange" class="form-control"
                value="{{$startDate}}- {{$endDate}}" data-start="{{$startDate}}" data-end="{{$endDate}}" readonly />
        </div>
    </div>

    <div class="row my-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="report"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <livewire:table :selectedArea="$selectedArea" />
    </div>
</div>

@push('scripts')
<script>
    let datas = [],
        labels = [];

    var options = {
        series: [{
            name: 'Percentage',
            data: datas
        }],
        chart: {
            height: 350,
            type: 'bar',
        },
        plotOptions: {
            bar: {
                borderRadius: 10,
                dataLabels: {
                    position: 'top',
                },
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val + "%";
            },
            offsetY: -20,
            style: {
                fontSize: '12px',
                colors: ["#304758"]
            }
        },

        xaxis: {
            title: {
                text: 'Nilai',
            },
            categories: labels,
            position: 'bottom',
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            tooltip: {
                enabled: true,
            }
        },
        yaxis: {
            title: {
                text: 'Percentage (%)',
            },
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false,
            },
            labels: {
                show: false,
                formatter: function (val) {
                    return val + "%";
                }
            }

        }
    };


    var chart = new ApexCharts(document.querySelector("#report"), options);
    chart.render();

    Livewire.on('updateData', postId => {
        updateChart(@this.chartData)
    })

    document.addEventListener('livewire:load', function () {
        updateChart(@this.chartData)
    })

    function updateChart(chartData) {
        datas = [];
        labels = [];
        for (const [key, value] of Object.entries(chartData)) {
            labels.push(key)
            datas.push(value)
        }

        chart.updateOptions({
            xaxis: {
                categories: labels
            },
            series: [{
                data: datas
            }],
        });
    }

    const daterange = $('input[name="daterange"]');
    daterange.daterangepicker({
        startDate:daterange.data('start'),
        endDate:  daterange.data('end'),
        locale: {
            format: 'DD/MM/YYYY'
        }
    });

    daterange.on('apply.daterangepicker', function (ev, picker) {
        Livewire.emit('changeDate', $(this).val())
    });

</script>
@endpush
