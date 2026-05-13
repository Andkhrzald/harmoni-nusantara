<?php

use App\Models\ForumMessage;
use Illuminate\Support\Facades\Schedule;

Schedule::command('model:prune', [
    '--model' => [ForumMessage::class],
])->hourly();
