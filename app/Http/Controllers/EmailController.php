<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\SearchRequest;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Repositories\ImageRepository;
use App\Email;
use App\Report;
use App\Webug;
use App\File;
use Carbon\Carbon;
class EmailController extends Controller
{


    protected $repository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ImageRepository $repository)
    {
        $this->middleware('auth', ['except' => ['track2','track']]);
        $this->repository = $repository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        return view('home');
    }


    /**
     * Show the form for composer email.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request)
    {
        // $mail = Report::find(1);
        // $user = Email::find(1);

        // var_dump($user->user);

      $id = $request->route()->parameter('id', -1);
      if($id > 0)
      {
        $drafts = Email::find($id);
        return view('mail.create', ['drafts' => $drafts]);
      }
      return view('mail.create');

    }

    /**
     * Send email.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function send(EmailRequest $request, ImageRepository $repository)
    {
        
      //   try
      //   {

      //   $mail = new PHPMailer();
      //   $mail->STMPDebug = 1;
      //   $mail->IsSMTP();
      //   $mail->CharSet = 'utf-8';
      //   $mail->Host = 'smtp.gmail.com';
      //   $mail->Port = 587;
      //   $mail->SMTPAuth = true;
      //   $mail->SMTPSecure = 'tls';
      //   $mail->IsHTML(true);

      //   $mail->Username = 'paulido92@gmail.com';
      //   $mail->Password = 'IdP#i@gm.com';
      //   $mail->From = 'paulido92@gmail.com';
      //   $mail->FromName = 'paulido92';

      //   $mail->AddAddress($request->get('receiver_addr'));
      //   $mail->Subject = $request->get('subject');
        // $message_body = $request->get('body');
        // $track_code = md5(rand());

        // $message_body .= '<img src="{{route(blank, $track_code)}}" width="1" height="1" border="0" alt=""/>';
      //   //$mail->MsgHTML($message_body);
      //   $status = 0;
      //   echo "trying send";
      //   if($mail->send())
      //   {
        //     echo 'passed';
        //     Email::create([
        //         'address' => $request->get('address'),
        //         'subject' => $request->get('subject'),
        //         'body' => $request->get('body'),
        //     ]);
        //     $status = 1;

        // }
        // else
        // {
        //    $status = 2;
        // }
      //   $mail->Body = $message_body;

      // }
      // catch(Exception $e){
      //   echo $e->getMessage();
      // }



      $mail = new PHPMailer(true);
        
     try {
        //Server settings

        //$mail->SMTPDebug = 2;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'paulido92@gmail.com';                     // SMTP username
        $mail->Password   = 'IdP#i@gm.com95@';                               // SMTP password
        $mail->SMTPSecure = 'tls';         // Enable TLS enryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $mail->smtpConnect([
          'ssl' => [
              'verify_peer' => false,
              'verify_peer_name' => false,
              'allow_self_signed' => true
          ]
      ]);

        //Recipients
        $mail->setFrom('paulido92@gmail.com');
        //$mail->setFrom(Auth()->user()->mail_addr);
        $mail->addAddress($request->get('receiver_addr'));     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

        // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $request->get('subject');
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $body = $request->get('body');
        $track_code = md5(rand());
        $base_url = 'https://idomailer.herokuapp.com/';
        //$base_url = 'http://localhost/';
        // $body .= '<img src="{{route(blank, $track_code)}}" width="1" height="1" border="0" alt=""/>';

        $body .= '<b> Paul </b> <img src="'.$base_url.$track_code.'/webbug.php" width="1" height="1" border="0" alt=""/>';
        $mail->Body = $body;
        $mail->send(); //send the the mail

        $mail = Email::create([
            'sender_addr' => Auth()->user()->email,
            'subject' => $request->get('subject'),
            'body' => $request->get('body'),
            'status' => 'sent',
        ]);

        // $files = [];
        // if($request->hasfile('files'))
        //  {

        //   // var_dump($_POST['choix']);
        //   // var_dump($_FILES['filesnames']);
        //   // echo '-------------------------------------------\n';
        //   var_dump($_FILES['files']);
        //   // foreach($_POST['choix'] as $key => $value)
        //   // {
        //   //   echo $value;
        //   // }
        //     // foreach($request->file('files') as $file)
        //     // {
        //     //     $name = time().rand(1,100).'.'.$file->extension();
        //     //     $file->move(public_path('files'), $name);  
        //     //     $files = $name;
                
        //     // }
        //     // // saving each attachment
        //     //     File::create([
        //     //       'name' => json_encode($files),
        //     //       'email_id' => $mail->id,
        //     //     ]);
            
        // }
        // if(!empty($request->get('file'))) // if there is attachement
        // {
        //        $mailu = Email::find($mail->id);
        //        $filename = $imageRepository->upload($request, 'images/attachments');
        //        $mailu->attachement = $filename;
        //        $mailu->update();
        // }
        // if(isset($request->files))
        // {
        //     $filenames = [];   //contain all saved attachment uplopaded
        //     foreach($request->files as $file)
        //     {
        //       $filenames = $repository->store($file);
        //     }
        //     $filename = $repository->store($file);
              Report::create([
                  'email_id' => $mail->id,
                  'receiver_addr' => $request->get('receiver_addr'),
                  'track_code' =>$track_code,
                  'status' => 'sent',
              ]); 

              
            
        // }
        $request->session()->flash('success','Sent Success');

        

    } 
    catch (Exception $e) 
    {
        
        $mail = Email::create([
            'sender_addr' => $request->get('receiver_addr'),
            'subject' => $request->get('subject'),
            'body' => $request->get('body'),
            'status' => 'drafts',
        ]);

        // if(!empty($request->get('file'))) // if there is attachement
        // {
        //        $mailu = Email::find($mail->id);
        //        $filename = $imageRepository->upload($request, 'images/attachments');
        //        $mailu->attachement = $filename;
        //        $mailu->update();
        // }
        $request->session()->flash('failed','Sent Failed');
    }
    return view('mail.create');
}


    
    /**
     * determine if user has open the mail
     *
     * @param  mixed $request
     * @return void
     */
    public function track(Request $request)
    {

        
        //$count = count($report);

        if (!empty($_SERVER['REMOTE_ADDR'])) 
        {
          
          $track_code = $request->route()->parameter('id');
          $report = Report::where('track_code', $track_code)->first();
 
            if(!empty($report)) // tracked mail exists
          {
              $report->clics = $report->clics+1;
              if($report->clics == 1) //mail has not opened yet
              {
                  $report->open_date = Carbon::now(); //setting open date
              }
              $report->update();

          }
          else // tracked mail dosen't exist(perhaps it has been droped)
          {
              $temp = 0;
          }

        }

        
    }  
    public function track2(Request $request)
    {

        
        //$count = count($report);

        $fullpath  = $_SERVER['REQUEST_URI'];
        $filename  = basename($fullpath);
        $ip        = $_SERVER["REMOTE_ADDR"];
        $useragent = $_SERVER["HTTP_USER_AGENT"];
        Webug::create([
          'fullpath' => $fullpath,
          'filename' => $filename,
          'ip' => $ip,
          'agent' => $useragent,
        ]);
        $track_code = $request->route()->parameter('id');
        echo $track_code;
                
    }  

    public function sent()
    {
        
        // $mails = Auth()->user()->sentMail;
        // foreach ($mails as $mail) {
        //   var_dump($mail->report);
        // }
        return view('home', ['mails'=>Auth()->user()->sent,'box_name' => 'OutBox']);
        // var_dump(Auth()->user()->sentMail);
    }

    public function received()
    {

         return view('home', ['mails'=>Auth()->user()->received,'box_name' => 'InBox']);
    }

    public function read(Request $request)
    {

         $id = $request->route()->parameter('id');
         $mail = Email::find($id);

         return view('mail.read', ['mail' => $mail,'box_name' => 'Read Box']);
    }

    public function drafts()
    {
      
       return view('mail.drafts',['drafts' => Auth()->user()->drafts]);
    }


    public function trash()
    {
      $trashs = Email::where('status','del')->get();
       return view('mail.trash',['trashs' => Auth()->user()->drafts]);
    }

    public function test()
    {
      echo 'hello';
      // $beacons = Webug::all();
      // echo 'printing variables';
      //   foreach ($beacons as $beacon) {

      //     echo 'fullpath: '.$beacon ->fullpath. ' ip: '.$beacon->ip. ' agent: '.$beacon->agent;
      //   }
    }

    

    public function SentDelete(Request $request){

         Email::whereIn('id',explode(",",$request->get('data')))->delete();
         return redirect()->route('mail.sent');   

      }
    public function draftsDelete(Request $request){

         Email::whereIn('id',explode(",",$request->get('data')))->delete();
         return redirect()->route('mail.drafts');

      }
    public function trashDelete(Request $request){

         Email::whereIn('id',explode(",",$request->get('data')))->forceDelete();
         return redirect()->route('mail.trash');

      }

      public function forceDelete(Request $request){

        Email::whereIn('id',explode(",",$request->get('data')))->forceDelete();
          return view('draft', ['drafts'=>Auth()->user()->drafts,'box_name' => 'OutBox']);  
        }
      public function report(Request $request, $id){
  
            
            return view('report', ['report' => Report::find($id)]);  
    
      }

      public function search(SearchRequest $request)
      {

         $type = ['sent', 'drafts'];
         $id = $request->get('type');
         if(in_array($id, $type))
         {  // search in sent mail or drafts
              $contcts = Auth()->user()->contact; //get user contacts
              $report = Auth()->user()->report; //get report contacts
              $emails = Auth()->user()->email; //get report contacts
             
              $report = Report::where('receiver_addr', Auth()->user()->email)
              ->Where('subject', 'like', '%' . Input::get('serach') . '%')->get()
              ->orWhere('body', 'like', '%' . Input::get('serach') . '%')->get();
              

              if($id === 'sent')
              {
                  $mails = Email::where('sender_addr', Auth::user()->email)->get();
                  return view('mail.sent', ['mails'=>Auth()->user()->sent,'box_name' => 'OutBox']);
              }
              else
              {
                $mails = Email::where('sender_addr', Auth::user()->email)->get();
                return view('mail.drafts', ['mails'=>Auth()->user()->drafts,'box_name' => 'OutBox']);
              }
        }

        else
        {
          return view('mail.sent', ['mails'=>Auth()->user()->sent,'box_name' => 'OutBox']);
        }

         
           
      }
      


}