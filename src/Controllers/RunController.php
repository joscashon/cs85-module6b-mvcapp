<?php
namespace User\Cs85Module6bMvcapp\Controllers;

use User\Cs85Module6bMvcapp\Models\Run;

class RunController {
    public function show() {
        $runs = [
            ['miles' => 3.5, 'minutes' => 32, 'seconds' => 15, 'date' => date('Y-m-d')],
            ['miles' => 2.0, 'minutes' => 20, 'seconds' => 0, 'date' => date('Y-m-d', strtotime('-1 day'))],
            ['miles' => 4.0, 'minutes' => 40, 'seconds' => 30, 'date' => date('Y-m-d', strtotime('-2 days'))],
        ];
        $run = new Run($runs);
        include __DIR__ . '/../../Views/run_view.php';
    }
}