<?php

namespace App\Conversations;


use App\Type;
use DateTime;
use App\Client;
use DateTimeZone;
use Carbon\Carbon;
use App\Appointment;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Config;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;

class ExampleConversation extends Conversation
{
  

 
    public function test()



{    
    $this->say('Message');
}



    public function askType()

    
    { 
        $this->somme=0;
        $this->total=0;
        $this->debut=0;
        $this->temps=0;
        $this->date=date("l");
        if ($this->date=='Friday') {
            $this->debut="09:00";
            $this->mx="15:00";
            $this->mi="12:00";
            $this->total="600";
        }elseif($this->date=='Saturday'){
             $this->total="720";
             $this->debut="09:00";
             $this->mx="13:00";
             $this->mi="12:00";   
        }else{
            $this->total="360";
            $this->debut="16:00";
            $this->mx="13:00";
            $this->mi="12:00";
        }
date_default_timezone_set("Africa/Algiers");
        $this->max=date("Y-m-d ").$this->mx.":00";
        $this->max=date("Y-m-d H:i:s",strtotime(date($this->max)));
        $this->min=date("Y-m-d ").$this->mi.":00";
        $this->min=date("Y-m-d H:i:s",strtotime(date($this->min)));

$Tos=Appointment::where('ActiveType','1')->latest('created_at')->first();

    $this->now=date("Y-m-d H:i:s");
if($Tos){

    if ($this->now>$Tos->temps) {
        $this->temps= $this->now;
        $this->mgg=date("H:i",strtotime(date($this->temps)));

    } 
               
      }
            else {
                $this->debut=date("Y-m-d ").$this->debut.":00";

                $this->debut=date("Y-m-d H:i:s", strtotime(date($this->debut)));


                if ($this->now>$this->debut) {
                    $this->temps=$this->now;
                    $seconds = 15*60;
                    $this->temps=date("Y-m-d H:i:s", (strtotime(date($this->temps)) + $seconds));
                    $this->mgg=date("H:i",strtotime(date($this->temps)));

                } 
                             else {

                $this->temps=$this->debut;
                $this->mgg=date("H:i",strtotime(date($this->temps)));

            }}


            if ($this->min < $this->temps &&  $this->temps < $this->max) {
                $this->temps=$this->max;
                $this->mgg=date("H:i",strtotime(date($this->temps)));

                
              }
    $this->say(' ??? ???????? ???????????? ???? ??????????  '.  $this->mgg);
    $question = Question::create("?????????? ???????????? ")
    ->addButtons([
                Button::create(' ??? ??????????')->value('yes'),
                Button::create(' ??? ??????????')->value('no')]);
                return $this->ask($question, function (Answer $answer) {
                    $this->reponse=$answer->getValue();
                    if ($answer->isInteractiveMessageReply()) {
                    if ($this->reponse==="yes") {
                       $this->stepTwo();}
                    else{ $this->say('?????? ???? ?????????? ?????????? ??????????  ');
                            }
                    }
                });




                
                  
      
       
    }


    public function stepTwo()
    {


 
       
        $this->config=Config::get('app.url');


        
      $client=Client::whereFacebook($this->facebook)->first();
          
                $app=new Appointment();
                $app->facebook=$this->facebook;
                $app->type_id=intval($this->type);
                $app->ActiveType="1";
                $app->client_id=$client->id;
                $app->temps=$this->temps;
                $app->fb_id=$this->fb_id;
                $app->save(); 
                $this->say('???????? ????  '.$this->facebook);
                $this->say('?????? ???? ?????? ?????????? ?????????? ');
                $DbUsername=Client::whereFacebook($this->facebook)->first();

                $this->say(ButtonTemplate::create(' ??? ???????? ????????????  '.$this->mgg)
                ->addButton(ElementButton::create(' ???? ?????????? ?????????????? ????????????')
                ->url($this->config.'/client/'.$DbUsername->slug)
            
                )
                ->addButton(ElementButton::create(' ???? ??????????')
                ->url($this->config.'/client/'.$DbUsername->slug)
                )
            );
               
            
    
    }
    /**
     * Start the conversation
     */
    public function run()
    
    {

        $this->test();




       return;

        $this->askType();
    }
}
