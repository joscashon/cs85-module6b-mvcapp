<?php
namespace User\Cs85Module6bMvcapp\Controllers;

use User\Cs85Module6bMvcapp\Models\Run;

class RunController {
    public function show() {
        // Start with runs from session or empty array
        $runs = isset($_SESSION['runs']) ? $_SESSION['runs'] : [];

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $date = isset($_POST['date']) ? htmlspecialchars($_POST['date']) : date('Y-m-d');
            $miles = isset($_POST['miles']) ? floatval($_POST['miles']) : 0;
            $minutes = isset($_POST['minutes']) ? intval($_POST['minutes']) : 0;
            $seconds = isset($_POST['seconds']) ? intval($_POST['seconds']) : 0;

            // Basic validation
            if ($miles > 0 && $minutes >= 0 && $seconds >= 0 && $seconds < 60) {
                $runs[] = [
                    'miles' => $miles,
                    'minutes' => $minutes,
                    'seconds' => $seconds,
                    'date' => $date
                ];
                $_SESSION['runs'] = $runs;
            }
        }

        $run = new Run($runs);
        include __DIR__ . '/../../Views/run_view.php';
    }
}