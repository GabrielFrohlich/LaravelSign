<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateAuthorityController extends Controller
{
    public function test(Request $request)
    {
        $file_path = Storage::disk('local')->path('teste.conf');
        
        $pkey = openssl_pkey_new([
            'digest_alg' => 'sha1',
            'private_key_bits' => 4096,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
            'encrypt_key' => 'teste',
            'encrypt_key_cipher' => OPENSSL_CIPHER_AES_256_CBC
        ]);

        openssl_pkey_export($pkey, $string, passphrase: 'teste');

        $pubkey = openssl_pkey_get_details($pkey)['key'];

        $dn = [
            'countryName' => 'BR',
            'organizationName' => 'Teste',
            'commonName' => 'Teste RootCA'
        ];

        $csr = openssl_csr_new(
            $dn,
            $pkey,
            [
                'digest_alg' => 'sha1',
                'req_extensions' => 'v4_req',
                'config' => $file_path,
                'private_key_bits' => 4096,
                'private_key_type' => OPENSSL_KEYTYPE_RSA,
                'encrypt_key' => 'teste',
                'encrypt_key_cipher' => OPENSSL_CIPHER_AES_256_CBC
            ]
        );

        $x509 = openssl_csr_sign($csr, null, $pkey, 365, [
            'digest_alg' => 'sha256',
            'x509_extensions' => 'v4_ca',
            'config' => $file_path,
            'private_key_bits' => 4096,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
            'encrypt_key' => 'teste',
            'encrypt_key_cipher' => OPENSSL_CIPHER_AES_256_CBC
        ]);

        openssl_csr_export($csr, $csrout);

        openssl_x509_export($x509, $certout);

        dd($string, $pubkey, $csrout, $certout);
    }
}
