<?php

Broadcast::channel('bid-{id}', function ($user) {
    return $user;
});