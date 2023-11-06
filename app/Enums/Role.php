<?php

namespace App\Enums;

enum Role: int
{
  case User = 0;
  case Supervisor = 1;
  case Manager = 2;
}
