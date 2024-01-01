<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CryptoControllers extends Controller
{
    public function process(Request $request)
    {
        // Log permintaan dari klien
        Log::info('Data yang diterima dari klien: ' . json_encode($request->all()));

        $key = $request->input('key');
        $data = $request->input('data');
        $operation = $request->input('operation');
        $encBit = $request->input('encBit');

        try {
            if (!in_array($encBit, ['128', '192', '256'])) {
                // Bit enkripsi tidak valid
                Log::error('Bit enkripsi tidak valid: ' . $encBit);
                return response()->json(['error' => 'Invalid encryption bit']);
            }

            if ($operation === 'encrypt') {
                $encryptedData = $this->encryptData($data, $key, $encBit);
                $responses = ['result' => $encryptedData, 'key' => $key, 'encBit' => $encBit];
            } elseif ($operation === 'decrypt') {
                $decryptedData = $this->decryptData($data, $key, $encBit);
                $responses = ['result' => $decryptedData, 'key' => $key, 'encBit' => $encBit];
            } else {
                // Operasi tidak valid
                Log::error('Operasi tidak valid: ' . $operation);
                return response()->json(['error' => 'Invalid operation']);
            }

            // Log respons yang akan dikirim ke klien
            Log::info('Respon yang akan dikirim ke klien: ' . json_encode($responses));

            if ($request->ajax()) {
                // Jika permintaan dari AJAX, kirim respons JSON
                return response()->json($responses);
            } else {
                // Jika permintaan bukan dari AJAX, kirim respons HTML
                return view('aes', $responses);
            }
        } catch (\Exception $e) {
            // Catat kesalahan untuk debugging
            Log::error('Kesalahan saat memproses permintaan: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    private function encryptData($data, $key, $encBit)
    {
        $method = 'aes-' . $encBit . '-cbc';

        // Gunakan AES untuk enkripsi
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));
        $encryptedData = openssl_encrypt($data, $method, $key, 0, $iv);
        return base64_encode($encryptedData . '::' . $iv);
    }

    private function decryptData($data, $key, $encBit)
    {
        $method = 'aes-' . $encBit . '-cbc';

        // Gunakan AES untuk dekripsi
        list($encryptedData, $iv) = explode('::', base64_decode($data), 2);
        return openssl_decrypt($encryptedData, $method, $key, 0, $iv);
    }
}
