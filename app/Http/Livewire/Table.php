<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ReportProduct;
use App\Models\StoreArea;
use Carbon\Carbon;
use Livewire\Component;

class Table extends Component {
    public $products, $areas, $startDate, $endDate;
    public $reports      = [];
    public $selectedArea = [];

    protected $listeners = ['updateData', 'changeDate'];

    public function mount($selectedArea) {
        $this->selectedArea = $selectedArea;
    }

    public function render() {
        $this->products = Product::all();
        $areas          = new StoreArea;
        $reports        = new ReportProduct;

        $selectedArea = $this->selectedArea;

        if (!empty($selectedArea)) {
            $areas = $areas->whereIn('area_id', $selectedArea);

            $reports = $reports->whereHas('store', function ($query) use ($selectedArea) {
                $query->whereIn('area_id', $selectedArea);
            });
        }

        if (!empty($this->startDate) && !empty($this->endDate)) {
            $reports = $reports->whereBetween('tanggal', [$this->startDate, $this->endDate]);
        }

        $reports = $reports->get();

        foreach ($reports as $report) {
            $this->reports[] = [
                'product_id'   => $report->product_id,
                'product_name' => $report->product->product_name,
                'store_id'     => $report->store_id,
                'store_name'   => $report->store->store_name,
                'area_id'      => $report->store->area->area_id,
                'area_name'    => $report->store->area->area_name,
                'compliance'   => $report->compliance,
                'tanggal'      => $report->tanggal,
            ];
        }

        $this->reports = collect($this->reports)->groupBy('area_id')->map(function ($item) {
            return collect($item)->groupBy('product_id')->map(function ($item) {
                return collect($item)->sum("compliance") / count($item) * 100;
            });
        });

        $this->areas = $areas->get();

        return view('livewire.table');
    }

    public function updateData($selectedArea) {
        $this->selectedArea = $selectedArea;
    }

    public function changeDate($date) {
        $date = explode(' - ', $date);

        $this->startDate = Carbon::createFromFormat("d/m/Y", trim($date[0]))->format('Y-m-d');
        $this->endDate   = Carbon::createFromFormat("d/m/Y", trim($date[1]))->format('Y-m-d');
    }
}
