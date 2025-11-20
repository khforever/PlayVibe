<?php

namespace App\Enum;

enum OrderStatus: string {
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case CANCELLED = 'cancelled';
    case SHIPPED = 'shipped';
    case DELIVERED = 'delivered';
}
