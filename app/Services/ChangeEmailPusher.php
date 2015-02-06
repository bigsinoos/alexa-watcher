<?php namespace AlexaWatcher\Services;

use Carbon\Carbon;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Collection;

class ChangeEmailPusher implements ChangePusherInterface{

    /**
     * @var Mailer
     */
    protected $mailer;

    /**
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Push changes
     *
     * @param $before
     * @param $after
     * @param $site
     * @param Collection $pushables
     * @return void
     */
    public function push($before, $after, $site, Collection $pushables)
    {
        foreach($pushables as $pushable)
        {
            if(is_null($pushable->getEmail())) continue;

            $now = Carbon::now()->toDateString();

            $this->mailer->send(
                'emails.notify',
                ['entity' => $pushable, 'site' => $site, 'from' => $before, 'to' => $after],
                function($message) use($pushable, $now){

                    $message->to($pushable->getEmail())->subject('AlexaWatcher [' . $now . ']') ;

                }
            );
        }
    }
}