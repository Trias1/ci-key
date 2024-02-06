<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Keycloak extends BaseConfig
{
    public $keycloak_base_url = 'http://localhost:8080/auth';
    public $keycloak_realm = 'testingphp';
    public $keycloak_client_id = 'phps';
    public $keycloak_client_secret = 'OmvIKxcH5ig2DphGH4eefSNuQX8S2GUX';
}
