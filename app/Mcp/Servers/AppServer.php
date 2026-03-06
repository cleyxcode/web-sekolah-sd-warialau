<?php

namespace App\Mcp\Servers;

use App\Mcp\Tools\GetDataTool;
use App\Mcp\Tools\CreateDataTool;
use App\Mcp\Tools\UpdateDataTool;
use App\Mcp\Tools\DeleteDataTool;
use App\Mcp\Tools\GetReportTool;
use App\Mcp\Tools\SendNotificationTool;
use App\Mcp\Tools\BusinessLogicTool;
use Laravel\Mcp\Server;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Attributes\Instructions;

#[Name('App Server')]
#[Instructions('Server ini menyediakan akses ke data, laporan, notifikasi, dan logika bisnis aplikasi.')]
class AppServer extends Server
{
    protected array $tools = [
        GetDataTool::class,
        CreateDataTool::class,
        UpdateDataTool::class,
        DeleteDataTool::class,
        GetReportTool::class,
        SendNotificationTool::class,
        BusinessLogicTool::class,
    ];
}