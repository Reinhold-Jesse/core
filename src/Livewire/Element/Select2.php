<?php

namespace Reinholdjesse\Components\Livewire\Element;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Select2 extends Component
{
    public $table;

    public $event;

    public $filter;

    public $order;

    public $list;

    public $selected;

    public $name;

    public $search;

    public $add_function;

    public $key;

    public function mount(string $table, string $event, string $order, string $filter, int $selected = null, bool $add_function = false, $key = null)
    {
        $this->table = $table;
        $this->event = $event;
        $this->order = $order;
        $this->filter = $filter;
        $this->selected = $selected;
        $this->add_function = $add_function;
        $this->key = $key;

        $this->getDatabaseList();

        if (isset($selected) && ! empty($selected)) {
            foreach ($this->list as $value) {
                if ($value->id == $selected) {
                    $this->name = $value->name;
                }
            }
        }
    }

    public function render()
    {
        $this->search();

        return view('component::livewire.element.select2');
    }

    public function select(int $id, string $name)
    {
        if ($this->selected === $id) {
            $this->selected = null;
            $this->name = null;
        } else {
            $this->selected = $id;
            $this->name = $name;
        }

        $this->clearSearch();
        $this->emitEvent();
    }

    public function add()
    {
        $this->search = trim($this->search);
        if ($this->add_function === true && ! DB::table($this->table)->where('name', $this->search)->exists() && ! empty($this->search)) {
            $this->selected = DB::table($this->table)->insertGetId([
                'name' => $this->search,
            ]);

            $this->name = $this->search;
            $this->clearSearch();
            $this->emitEvent();
        } else {
            $this->selected = DB::table($this->table)->where('name', $this->search)->pluck('id')->first();

            if ($this->selected) {
                $this->name = $this->search;
                $this->clearSearch();
                $this->emitEvent();
            } else {
                $this->clearSearch();
            }
        }
    }

    public function clear()
    {
        $this->selected = null;
        $this->name = null;
        $this->emitEvent();
    }

    private function getDatabaseList()
    {
        $filter = explode(',', $this->filter);
        $filter_row = $filter[0];

        if ($filter[1] === 'NULL') {
            $filter_val = null;
        } else {
            $filter_val = $filter[1];
        }

        $this->list = DB::table($this->table)->where($filter_row, $filter_val)->orderBy($this->order, 'asc')->get()->toArray();
    }

    private function search()
    {
        if (! empty($this->search)) {
            $this->list = DB::table($this->table)->where('name', 'LIKE', '%'.trim($this->search).'%')->orderBy('name', 'asc')->get()->toArray();
        } else {
            $this->getDatabaseList();
        }
    }

    private function clearSearch()
    {
        $this->search = '';
    }

    private function emitEvent()
    {
        $this->emit($this->event, $this->selected, $this->key);
    }
}
