<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller as BaseController;

class ApiController extends BaseController {

    public function boot() {
        $this->initQueue();
        return response()->json([
            'message' => 'System started succesfully.'
        ]);
    }

    public function enqueue() {
        //sort & insert logic
    }

    public function dequeue() {
        $data = $this->getQueue();
        array_shift($data->queue);
        $this->editQueue($data);
        return response()->json([
            'message' => 'Dequeued successfully'
        ]);
    }

    public function listQueue() {
        $data = $this->getQueue();
        return response()->json([
            'queue' => $data->queue
        ]);
    }

    public function showOptions() {
        return response()->json([
            'methods' => 'GET, POST, PUT, DELETE, OPTIONS'
        ]);
    }

    private function initQueue() {
        $queue = fopen(dirname(__DIR__, 3).'/resources/data.json', 'w');
        fwrite($queue, '{"queue": []}');
        fclose($queue);
    }

    private function editQueue($info) {
        $queue = fopen(dirname(__DIR__, 3).'/resources/data.json', 'w');
        fwrite($queue, json_encode($info));
        fclose($queue);
    }

    private function getQueue() {
        return json_decode(file_get_contents(dirname(__DIR__, 3).'/resources/data.json'));
    }

}
