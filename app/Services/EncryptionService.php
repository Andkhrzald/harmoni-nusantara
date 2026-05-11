<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;

class EncryptionService
{
    public function encryptMessage(string $message): string
    {
        return Crypt::encryptString($message);
    }

    public function decryptMessage(string $encryptedMessage): string
    {
        return Crypt::decryptString($encryptedMessage);
    }

    public function isEncrypted(string $message): bool
    {
        try {
            Crypt::decryptString($message);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
