<?php

namespace Reinholdjesse\Core\Livewire\Setting;

use Livewire\Component;
use Reinholdjesse\Core\Models\Setting;

class Index extends Component
{

    public $display_name;
    public $key;
    public $type;
    public $group;

    public $content;

    protected $rules = [
        'display_name' => 'required|unique:settings|string|max:50',
        'key' => 'required|unique:settings|string|max:50',
        'type' => 'required|string|max:25',
        'group' => 'required|string|max:25',
    ];

    protected $validationAttributes = [
        'display_name' => 'Name',
        'key' => 'Key',
        'type' => 'Type',
        'group' => 'Gruppe',
    ];

    public function render()
    {
        $this->content = Setting::orderBy('group', 'asc')
            ->orderBy('order', 'asc')->get();

        return view('component::livewire.setting.index')->layout('component::layouts.dashboard');
    }

    public function createNewSettingEntry()
    {
        $this->validate();

        $setting = new Setting;

        $setting->key = $this->key;
        $setting->display_name = $this->display_name;
        $setting->value = null;
        $setting->type = $this->type;
        $setting->order = Setting::count() + 1;
        $setting->group = $this->group;
        $setting->created_at = date('Y-m-d H:i:s');

        if ($setting->save()) {
            //TODO: flash message ausgeben

            $this->clearValue();
        }
    }

    public function input(string $value, int $id)
    {
        Setting::where('id', $id)->update([
            'value' => $value,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $this->emit('saved');
    }

    public function deleteEntry(Setting $setting)
    {
        if ($setting->delete()) {
            //TODO: flash message ausgeben
        }
    }

    private function clearValue()
    {
        $this->display_name = null;
        $this->key = null;
        $this->type = null;
        $this->group = null;
    }
}
