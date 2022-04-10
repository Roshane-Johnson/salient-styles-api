<?php

function success($data = [], $message = "success", $status = 200)
{
    return response(["message" => $message, "status" => $status, "data" => $data]);
}


function error($data = [], $message = "error", $status = 500)
{
    return response(["message" => $message, "status" => $status, "data" => $data]);
}
