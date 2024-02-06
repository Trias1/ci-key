<?php

namespace App\Controllers;

class Home extends BaseController
{

    public $keycloak_base_url = 'http://localhost:8080/auth';
    public $keycloak_realm = 'testingphp';
    public $keycloak_client_id = 'phps';
    public $keycloak_client_secret = 'OmvIKxcH5ig2DphGH4eefSNuQX8S2GUX';
    public $scope = 'openid,email,name,profile';

    public function index()
    {
        // Embed JavaScript di bagian footer atau di dalam script tag di view
        $loginScript = $this->getLoginJavascript();
        return view('index', ['loginScript' => $loginScript]);
    }

    public function login()
    {
        // Load view
        $data = []; // Data yang ingin Anda kirim ke view, bisa berupa data-data dari model atau informasi lainnya
        echo view('login', $data);

        // Embed JavaScript di bagian footer atau di dalam script tag di view
        $loginScript = $this->getLoginJavascript();
        echo $loginScript;
    }

    public function dash()
    {
        $userInfo = $this->getCurrentUserInfo();
        $data['userInfo'] = $userInfo;
        return view('dash', $data);
    }

    public function logout()
    {
        // Embed JavaScript di bagian footer atau di dalam script tag di view
        $logoutScript = $this->getLogoutJavascript();
        return view('index', ['logoutScript' => $logoutScript]);
    }

    private function getCurrentUserInfo()
    {
        // Logika untuk mendapatkan informasi pengguna dari sesi atau sumber lainnya
        // Gantilah dengan logika sesuai dengan implementasi autentikasi Anda
        // Contoh sederhana: $userInfo = session('user_info');
        return [
            'preferred_username' => 'JohnDoe',
            'email' => 'john.doe@example.com',
            // Tambahkan informasi pengguna lainnya sesuai kebutuhan
        ];
    }

    private function getLoginJavascript()
    {
        $keycloak_base_url = $this->keycloak_base_url;
        $keycloak_realm = $this->keycloak_realm;
        $keycloak_client_id = $this->keycloak_client_id;

        return "<script>
            // Fungsi untuk mengarahkan ke halaman login Keycloak
            function redirectToKeycloakLogin() {
                var keycloakLoginUrl = '{$keycloak_base_url}/realms/{$keycloak_realm}/protocol/openid-connect/auth?client_id={$keycloak_client_id}&redirect_uri=" . base_url('Home/home') . "&response_type=code&scope=openid';
                window.location.href = keycloakLoginUrl;
            }

            // Menambahkan event listener ke form
            document.getElementById('keycloakLoginForm').addEventListener('submit', function (event) {
                event.preventDefault();
                redirectToKeycloakLogin();
            });
        </script>";
    }

    private function getLogoutJavascript()
    {
        $keycloak_base_url = $this->keycloak_base_url;
        $keycloak_realm = $this->keycloak_realm;

        return "<script>
            // Fungsi untuk mengarahkan ke halaman logout Keycloak
            function redirectToLogoutKeycloak() {
                var keycloakLogoutUrl = '{$keycloak_base_url}/realms/{$keycloak_realm}/protocol/openid-connect/logout';
                window.location.href = keycloakLogoutUrl;
            }

            // Menambahkan event listener ke form
            document.getElementById('keycloakLogoutForm').addEventListener('submit', function (event) {
                event.preventDefault();
                redirectToLogoutKeycloak();
            });
        </script>";
    }
}
