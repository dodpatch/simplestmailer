@extends('layouts.main')
<meta name="csrf-token" content="{{csrf_token()}}">
@section('topbar')
<x-topbars.topbarlte>
</x-topbarlte>
@endsection
@section('notification')
<style>
    .overlay{
        display: none;
        position: fixed;
        width: 100%;
        height: 20%;
        top: 0;
        left: 0;
        z-index: 999;
        background: rgba(255,255,255,0.8) url("/images/loader2.gif") center no-repeat;
    }
    /* Make spinner image visible when body element has the loading class */
    body.loading .overlay{
        display: block;
    }
</style>
<div class="overlay"></div>
@endsection
@section('content')
<style>
.fa-check-double{
  color:grey;
}
</style>

 <!-- Main content -->
 <section class="content">
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">{{__($box_name)}}</h3>

              <div class="card-tools">
                
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm btn-delete"><i class="far fa-trash-alt"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fas fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm btn-reload"><i class="fas fa-sync-alt"></i></button>
                <div class="float-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.float-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  <?php
                  $i = 0;
                  ?>
                  @foreach($mails as $mail)
                  @foreach($mail->report as $report)
                  <?php
                    $color = 'grey';
                    if($report->clics > 0 )
                      $color = 'green';
                  ?>
                  <tr>
                    <td>
                      <div class="icheck-primary">
                        <input type="checkbox" class="checkbox" value="" id="check{{++$i}}" data-id="{{$mail->id}}">
                        <label for="check{{$i}}"></label>
                      </div>
                    </td>
                    <td class="mailbox-star"><a href="#"><i class="fas fa-check-double 1x" style="color:{{$color}}"></i></a></td>
                    <?php if(!is_object($report->receiverUser)){
                          $report->receiverUser = new \App\User();
                          $report->receiverUser->name = 'inconnu';
                    }
                    ?>
                      <td class="mailbox-name"><a href="read-mail.html">{{$report->receiverUser->name. ' | ' .$report->receiver_addr}}</a></td>
                   
                    <td class="mailbox-subject email-truncated"><b>{{$mail->subject}}</b> - {{$mail->body}}
                    </td>
                    <td class="mailbox-attachment"></td>
                    <td><button type="button" class="btn btn-default btn-sm btn-report"><a href="{{route('mail.report', $report->id)}}"><i class="far fa-envelope-open"></i></a></button></td>
                    <td class="mailbox-date">{{time_ago($mail->created_at)}}</td>
                  </tr>
                  @endforeach
                  @endforeach
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="far fa-trash-alt"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fas fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm btn-reload"><i class="fas fa-sync-alt"></i></button>
                <div class="float-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.float-right -->
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <form id="delform" method="POST" action="{{route('mail.sent.delete')}}">
         @csrf
         <input type="hidden" name="data" id="data" value="">
      </form>
    </section>

@endsection


@section('script')

<script>
  $(function () {
    //Enable check and uncheck all functionality
    $('.checkbox-toggle').click(function () {
      var clicks = $(this).data('clicks')
      if (clicks) {
        //Uncheck all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
        $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
      } else {
        //Check all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
        $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
      }
      $(this).data('clicks', !clicks)
    })

    //Handle starring for glyphicon and font awesome
    $('.mailbox-star').click(function (e) {
      e.preventDefault()
      //detect type
      var $this = $(this).find('a > i')
      var glyph = $this.hasClass('glyphicon')
      var fa    = $this.hasClass('fa')

      //Switch states
      if (glyph) {
        $this.toggleClass('glyphicon-star')
        $this.toggleClass('glyphicon-star-empty')
      }

      if (fa) {
        $this.toggleClass('fa-star')
        $this.toggleClass('fa-star-o')
      }
    })
  })
</script>

<script>
  //send ajax reload request
  $(function(){
    $(document).on('click', '.btn-reload', function(e){
      e.preventDefault();
      $.ajax({
        url:'/home/sent',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        method:'get',
        success:function(data){
            //alert('success');
            location.reload();
        },
        error:function(xhr)
        {
            //alert('failed');
        }
      });
    });
  });
</script>

<script>
//handle loader while reloading
// Add remove loading class on body element depending on Ajax request status
$(document).on({
  ajaxStart: function(){
      $("body").addClass("loading"); 
  },
  ajaxStop: function(){ 
      $("body").removeClass("loading"); 
  }    
});
</script>

<script type="text/javascript">
//  handle checkbox and mail delete

    $(document).ready(function () {
        $('.btn-delete').on('click', function(e) {

            var idsArr = [];  

            $(".checkbox:checked").each(function() {  

                idsArr.push($(this).attr('data-id'));

            });  



            if(idsArr.length <=0)  

            {  

                alert("Please select atleast one record to delete.");  

            }  else {  


                if(confirm("Are you sure, you want to delete the selected categories?"))
                {  
                   $('#data').attr('value', idsArr);
                   $('#delform').submit();
                }  

            }  

        });

    });

</script>
<script src="{{asset('js/truncate.js')}}"></script>
<script src="{{asset('dist/js/demo.js')}}"></script>
<script type="text/javascript">

	Truncate({
		className:"email-truncated",
		char : 130,
    truncateBy :"  ...",
		numOfTruncateBy : 1

	});
</script>

<script>
//set search form action 
$('#search').change(function(){
  // alert('changed');
  
})
</script>
<script>
$(document).ready(function(){
   $('#input-type').attr('value', 'sent');
  //  alert('changed');
})
</script>
@endsection