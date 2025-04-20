<?php

namespace App\Enums;

enum BatchType: string
{
    case Interest = "interest";
    case Auction = "auction";
}