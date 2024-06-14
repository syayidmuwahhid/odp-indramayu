<?php
    function success($data, $message)
    {
        $resp = [
            'data' => $data,
            'message' => $message,
            'status' => true
        ];

        return response()->json($resp);
    }

    function fail($message, $errorcode)
    {
        $resp = [
            'data' => null,
            'message' => $message,
            'status' => false
        ];

        return response()->json($resp, $errorcode);
    }
?>
