<?php

use App\Mcp\Servers\AppServer;
use Laravel\Mcp\Facades\Mcp;

// Local server - tidak perlu OAuth
Mcp::local('app', AppServer::class);