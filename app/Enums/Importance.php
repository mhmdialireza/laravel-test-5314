<?php

namespace App\Enums;

use App\Trait\EnumToArray;

enum Importance: int
{
  case Normal = 0;
  case Instantaneous = 1;
  case Instant = 2;

  use EnumToArray;

  public function getLabel(): string
  {
    return match ($this) {
      self::Normal => "معمولی",
      self::Instantaneous => "فوری",
      self::Instant => "آنی",
    };
  }
}
