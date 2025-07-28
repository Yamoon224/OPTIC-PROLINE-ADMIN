<?php

namespace App\Enums;

enum PaymentMethodEnum: string
{
    case CreditCard = 'credit_card';
    case MobileMoney = 'mobile_money';
    case BankTransfer = 'bank_transfer';
}
