<?php

namespace Reinholdjesse\Components\Controllers;

use App\Http\Controllers\Controller;

class ComponentesViewController extends Controller
{
    public $listeOfElements = [];

    public $path = '../resources/views/components';

    public function index()
    {
        $content = $this->listDir($this->path);

        // print '<pre>';
        // print_r($content);
        // print '</pre>';

        return view('component::welcome', compact('content'));
    }

    private function listDir($path)
    {
        $liste = [];

        if (file_exists($path)) {
            foreach (scandir($path) as $index => $element) {
                if ($element != '..' && $element != '.') {
                    $temp = [];
                    if (is_dir($path . '/' . $element)) {
                        $temp['name'] = $element;
                        $temp['date'] = $this->listDir($path . '/' . $element);
                    } else {
                        $temp = str_replace('.blade.php', '', $element);
                    }
                    $liste[] = $temp;
                }
            }

            return $liste;
        } else {
            return false;
        }

    }

}
