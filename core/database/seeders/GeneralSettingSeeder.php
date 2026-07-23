<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    public function run(): void
    {
        GeneralSetting::firstOrCreate([], [
            'site_name'           => 'MatrimonyLab',
            'cur_text'            => 'USD',
            'cur_sym'             => '$',
            'base_color'          => 'e74c3c',
            'secondary_color'     => '2ecc71',
            'currency_format'     => 1,
            'paginate_number'     => 12,
            'default_package_id'  => 1,
            'active_template'     => 'basic',
            'kv'                  => 0,
            'ev'                  => 1,
            'en'                  => 1,
            'sv'                  => 0,
            'sn'                  => 0,
            'pn'                  => 1,
            'force_ssl'           => 0,
            'secure_password'     => 0,
            'registration'        => 1,
            'agree'               => 1,
            'multi_language'      => 0,
            'chat_attachment'     => 1,
            'maintenance_mode'    => 0,
            'email_from'          => 'noreply@example.com',
            'email_from_name'     => 'MatrimonyLab',
            'email_template'      => 1,
            'sms_from'            => '',
            'sms_template'        => 1,
            'push_title'          => 'MatrimonyLab',
            'push_template'       => 1,
            'mail_config'         => json_decode('{"name":"php"}'),
            'sms_config'          => json_decode('{"name":"twilio","twilio":{}}'),
            'socialite_credentials' => json_decode('{"google":{"client_id":"","client_secret":"","status":0},"facebook":{"client_id":"","client_secret":"","status":0}}'),
            'firebase_config'     => json_decode('{"apiKey":"","authDomain":"","projectId":"","storageBucket":"","messagingSenderId":"","appId":"","measurementId":""}'),
            'config_progress'     => json_decode('{"general_setting":0,"logo_favicon":0,"seo":0,"notification_template":0,"deposit_method":0,"policy_content":0}'),
            'system_info'         => json_encode(['software' => 'MatrimonyLab', 'version' => '2.3']),
        ]);
    }
}
