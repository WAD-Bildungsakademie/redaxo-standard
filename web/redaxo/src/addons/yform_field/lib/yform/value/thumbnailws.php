<?php

class rex_yform_value_thumbnailws extends rex_yform_value_abstract
{
    public function postFormAction(): void
    {
        $sourceField = $this->getElement(1);
        $sourceUrl = $this->params['value_pool']['email'][$sourceField];
        $targetField = $this->getElement(2);
        $apiKey = $this->getElement(3);
        $query['url'] = $sourceUrl;
        $apiUrl = "https://api.thumbnail.ws/api/$apiKey/thumbnail/get?" . http_build_query($query);

        dump($sourceField, $targetField, $apiKey, $apiUrl);

        try {
            $socket = rex_socket::factoryUrl($apiUrl);
            $response = $socket->doGet();

            if (!$response->isOk()) {
                dump($response, 'Fehler bei der API-Anfrage.');
            }

            $result = $response->getBody();
            $response = json_decode($result, true);

            dump($response);
            $this->params['value_pool']['email'][$targetField] = json_encode($response);
        } catch (rex_socket_exception $e) {
            dump('Fehler bei der API-Anfrage: ' . $e->getMessage());
        }
    }

    public function getDescription(): string
    {
        return 'action|thumbnailws|source_url_field|target_field|api_key';
    }
    
    public function getDefinitions(): array
    {
        return [
            'type' => 'value',
            'name' => 'thumbnailws',
            'values' => [
                'name' => ['type' => 'name',    'label' => rex_i18n::msg('yform_values_defaults_name')],
                'label' => ['type' => 'text',    'label' => rex_i18n::msg('yform_values_defaults_label')],
                'source_field' => ['type' => 'text',    'label' => rex_i18n::msg('yform_values_thumbnailws_source_field')],
                'target_field' => ['type' => 'text',    'label' => rex_i18n::msg('yform_values_thumbnailws_target_field')],
                'api_key' => ['type' => 'text',    'label' => rex_i18n::msg('yform_values_thumbnailws_api_key')],
            ],
            'description' => rex_i18n::msg('yform_values_showvalue_extended_description'),
            'db_type' => ['text', 'varchar(191)', 'mediumtext', 'longtext'],
        ];
    }
}
