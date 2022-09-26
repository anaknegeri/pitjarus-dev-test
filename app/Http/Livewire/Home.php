<?php

namespace App\Http\Livewire;

use App\Models\ReportProduct;
use App\Models\StoreArea;
use Carbon\Carbon;
use Livewire\Component;

class Home extends Component {

    public $area, $startDate, $endDate;
    public $selectedArea = [];
    public $chartData    = [];
    protected $listeners = ['changeDate'];

    public function mount() {
        $report             = ReportProduct::orderBy('tanggal', 'ASC')->get();
        $this->selectedArea = StoreArea::get()->pluck('area_id')->toArray();
        $this->startDate    = $report->first()->tanggal->format('d/m/Y');
        $this->endDate      = $report->last()->tanggal->format('d/m/Y');
    }

    public function render() {
        $this->area = StoreArea::all();

        $selectedarea = $this->selectedArea;
        $reports      = [];
        $reportData   = new ReportProduct();

        if (!empty($selectedarea)) {
            $reportData = $reportData->whereHas('store', function ($query) use ($selectedarea) {
                $query->whereIn('area_id', $selectedarea);
            });
        }

        $startDate  = Carbon::createFromFormat("d/m/Y", $this->startDate)->format('Y-m-d');
        $endDate    = Carbon::createFromFormat("d/m/Y", $this->endDate)->format('Y-m-d');
        $reportData = $reportData->whereBetween('tanggal', [$startDate, $endDate]);

        $reportData = $reportData->get();

        foreach ($reportData as $report) {
            $reports[] = [
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
        $reports = collect($reports)->groupBy('area_name')->map(function ($item) {
            return round(collect($item)->sum("compliance") / count($item) * 100, 1);
        });

        $this->chartData = $reports;

        return view('livewire.home');
    }

    public function updatedSelectedArea() {
        $this->emit('updateData', $this->selectedArea);
    }

    public function changeDate($date) {
        $date = explode(' - ', $date);

        $this->startDate = trim($date[0]);
        $this->endDate   = trim($date[1]);
        $this->updatedSelectedArea();
    }
}
