<?php

namespace App\Enums;

enum Urgency: int
{
  case Normal = 0;
  case Instantaneous = 1;
  case Instant = 2;
}
