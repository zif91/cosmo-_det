<?php

namespace EvolutionCMS\Main\Services;

use Illuminate\Support\Facades\DB;

class LeadService
{
    /**
     * Сохраняет заявку, шлёт уведомления на почту и в Telegram.
     *
     * @param array $input name, phone, car, services, source, booking
     * @return array ['ok' => bool, 'errors' => array]
     */
    public function handle(array $input): array
    {
        $name  = mb_substr(trim((string) ($input['name'] ?? '')), 0, 100);
        $phone = mb_substr(trim((string) ($input['phone'] ?? '')), 0, 32);

        $errors = [];
        if ($name === '') {
            $errors['name'] = 'Укажите имя';
        }
        if (!preg_match('~^[+\d][\d\s()\-]{6,}$~u', $phone)) {
            $errors['phone'] = 'Укажите корректный телефон';
        }
        if ($errors) {
            return ['ok' => false, 'errors' => $errors];
        }

        $lead = [
            'name'       => $name,
            'phone'      => $phone,
            'car'        => mb_substr(trim((string) ($input['car'] ?? '')), 0, 150),
            'services'   => mb_substr(trim((string) ($input['services'] ?? '')), 0, 500),
            'booking'    => mb_substr(trim((string) ($input['booking'] ?? '')), 0, 200),
            'source'     => mb_substr(trim((string) ($input['source'] ?? '')), 0, 200),
            'ip'         => mb_substr((string) ($_SERVER['REMOTE_ADDR'] ?? ''), 0, 45),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        DB::table('site_leads')->insert($lead);

        $this->notifyEmail($lead);
        $this->notifyTelegram($lead);

        return ['ok' => true, 'errors' => []];
    }

    protected function buildText(array $lead): string
    {
        $lines = ['Новая заявка с сайта ' . evo()->getConfig('site_name')];
        $map   = [
            'name'     => 'Имя',
            'phone'    => 'Телефон',
            'car'      => 'Автомобиль',
            'services' => 'Интересует',
            'booking'  => 'Запись',
            'source'   => 'Источник',
        ];

        foreach ($map as $key => $label) {
            if (!empty($lead[$key])) {
                $lines[] = $label . ': ' . $lead[$key];
            }
        }

        return implode("\n", $lines);
    }

    protected function notifyEmail(array $lead): void
    {
        $to = evo()->getConfig('client_lead_email');
        if (!$to) {
            return;
        }

        try {
            $mail = evo()->getMail();
            $mail->addAddress($to);
            $mail->setFrom(
                'noreply@' . (parse_url(evo()->getConfig('site_url'), PHP_URL_HOST) ?: 'localhost'),
                evo()->getConfig('client_org_name', 'Site')
            );
            $mail->Subject = 'Заявка с сайта: ' . $lead['name'] . ' ' . $lead['phone'];
            $mail->Body    = $this->buildText($lead);
            $mail->IsHTML(false);
            $mail->send();
        } catch (\Throwable $e) {
            evo()->logEvent(0, 2, 'Lead mail error: ' . $e->getMessage(), 'LeadService');
        }
    }

    protected function notifyTelegram(array $lead): void
    {
        $token = evo()->getConfig('client_lead_telegram_token');
        $chat  = evo()->getConfig('client_lead_telegram_chat');
        if (!$token || !$chat) {
            return;
        }

        try {
            (new \GuzzleHttp\Client(['timeout' => 5]))->post(
                'https://api.telegram.org/bot' . $token . '/sendMessage',
                ['form_params' => ['chat_id' => $chat, 'text' => $this->buildText($lead)]]
            );
        } catch (\Throwable $e) {
            evo()->logEvent(0, 2, 'Lead telegram error: ' . $e->getMessage(), 'LeadService');
        }
    }
}
