<?php

namespace App\Http\Controllers;

use DateTime;
use App\Client;
use DateInterval;
use DateTimeZone;
use Carbon\Carbon;
use App\Appointment;
use Illuminate\Http\Request;
use Config;

class AppointmentController extends Controller
{






    public function AnnulerByAdmin( $id)
    {

$appointment=Appointment::find($id)->delete();
 return redirect()->back()->with('success', ' لقد تم إلغاء الموعد بنجاح ' );   



}




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

  /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function Annuler(Request $request)
    {

        $facebook=$request->get('facebook');
        $id=$request->get('id');
$appointment=Appointment::where("ActiveType","1")->where("facebook",$facebook)->first();
 $appointment->delete();
 $client=Client::where("fb_id",$id)->first();
$config=Config::get('app.url');


      $messageData = [
          "recipient" => [
              "id" => $client->fb_id,
          ],
          "message"=>[
            "attachment"=>[
        
              "type"=>"template",
              "payload"=>[
                "template_type"=>"button",
                "text"=>"لقد تم إلغاء موعدك بنجاح ",
                "buttons"=>[
                  [
                    "type"=>"postback",
                    "title"=>" 🛍 إحجز موعد جديد ",
                    "payload"=>"GotoDis",

                  ],
                  [
                    "type"=>"web_url",
                    "url"=>"$config/client/$client->slug",
                    "title"=>" 🎁 رصيدي    ",
                    "webview_height_ratio"=>"tall"

                  ],
                 
                  
                ]
              ]
            ]
          ],
      ];
      $ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token=' . env("FACEBOOK_TOKEN"));
      // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messageData));
      curl_exec($ch);
      curl_close($ch);




    }



    public function actif($id,$num)
    {
    $A=Appointment::find($id);
    $A->ActiveType=$num;
    $A->save();

    return redirect('/rdv')   ; }
    public function index()
    {

        date_default_timezone_set("Africa/Algiers");
$today=date("Y-m-d");
$Tommorow=date('Y-m-d', strtotime($today. ' + 1 day'));
$afterTommorow=date('Y-m-d', strtotime($today. ' + 2 day'));


       $Today_appointments=Appointment::where('ActiveType','>','0')->whereJour($today)->orderBy('debut', 'asc')->get();
       $Tomorow_appointments=Appointment::where('ActiveType','>','0')->whereJour($Tommorow)->orderBy('debut', 'asc')->get();
       $AfterTomoro_appointments=Appointment::where('ActiveType','>','0')->whereJour($afterTommorow)->orderBy('debut', 'asc')->get();



       $Inactif_appointments=Appointment::where('ActiveType','0')->latest()->paginate(5);
    $config=Config::get('botman.facebook.token');
 
 
       return view("rdv")
       ->with('Today_appointments',$Today_appointments)
       ->with('Tomorow_appointments',$Tomorow_appointments)
       ->with('AfterTomoro_appointments',$AfterTomoro_appointments)
       ->with('Inactif_appointments',$Inactif_appointments)
       ->with('config',$config);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        date_default_timezone_set("Africa/Algiers");
        $jour=$request->get('jour');
        $debut=$request->get("debut");
        $fin=$request->get("fin");
      
        $fin = Carbon::createFromFormat('H:i', $fin); 
$fin=$fin->subMinute()->format('H:i');
$counter=0;
$appointments=Appointment::where("jour",$jour)->where("ActiveType",'!=',5)->get();

if ($appointments->count()>0) {

foreach ($appointments as $appointment ) {

  
 
 if ($appointment->debut>=$debut and $appointment->debut<$fin ){
     $counter=$counter+1;
    return back()->with("erreur"," لديك موعد في هاته الفترة من فظلك إختر توقيت آخر ");

}


elseif ($appointment->fin>$debut and $appointment->fin<$fin ){
    $counter=$counter+1;
    return back()->with("erreur"," لديك موعد في هاته الفترة من فظلك إختر توقيت آخر ");

}


      }  

      if ($counter==0) {
        $app=new Appointment();
        $app->facebook="admin";
        $app->type_id="1";
        $app->ActiveType="5";
        $app->client_id="3889";
        $app->jour=$jour;
        $app->debut=$debut;
        $app->fin=$fin;
        $app->fb_id="4845148484484";
        $app->save(); 
    
           
        return back()->with("success","تم حفظ البيانات بنجاح ");
      }
}
else{
    $app=new Appointment();
    $app->facebook="admin";
    $app->type_id="1";
    $app->ActiveType="5";
    $app->client_id="3889";
    $app->jour=$jour;
    $app->debut=$debut;
    $app->fin=$fin;
    $app->fb_id="4845148484484";
    $app->save(); 

       
    return back()->with("success","تم حفظ البيانات بنجاح ");


}



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }
   

    public function deleteFunction(){

         
    }


    public function AddPFunction(){
        date_default_timezone_set("Africa/Algiers");

        $today=date("Y-m-d");

     $appointments=Appointment::where('ActiveType','2')->whereJour($today)->get();


     foreach ($appointments as $appointment) {
         $clients=Client::whereFacebook($appointment->facebook)->get();
     foreach ($clients as $client ) {
         $update = [
         'points'  => $client->points+$appointment->type->point
    ];           $client->update($update);

     }
       
}




$appoints=Appointment::where('ActiveType','1')->whereJour($today)->get();


foreach ($appoints as $appoint) {
    $clients=Client::whereFacebook($appoint->facebook)->get();
foreach ($clients as $client ) {
    $update = [
    'points'  => $client->points-50
];           $client->update($update);

}
  
}

$update = [
    'ActiveType'     => "0"
];
$appointments=Appointment::whereJour($today)->where('ActiveType','1')->orWhere('ActiveType','2')
->update($update);

 
 
 

}



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
