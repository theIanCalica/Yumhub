<?php

return [
  'sk' => env('STRIPE_SK'),
  'pk' => env("STRIPE_PK"),
  'webhook_secret' => env("WEBHOOK_SK"),
];
