<?php

namespace App\Enums;

use App\Trait\EnumToArray;
use Illuminate\Database\Eloquent\Collection;

enum Role: int
{
  case User = 0;
  case Supervisor = 1;
  case Manager = 2;

  use EnumToArray;

  public static function managerOrSupervisor($roles): bool
  {
    $roles = $roles->pluck('code')->toArray();
    return in_array(self::Manager->value, $roles) || in_array(self::Supervisor->value, $roles);
  }
}
